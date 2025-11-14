#!/bin/bash

# ═══════════════════════════════════════════════════════════════════════════════
# LUVEX.TECH - Deployment & Management Script
# ═══════════════════════════════════════════════════════════════════════════════
# Features:
# - Automated Deployment
# - Database & File Backups
# - Health Checks
# - Log Viewing
# - Rollback Functionality
# ═══════════════════════════════════════════════════════════════════════════════

set -e  # Exit on error

# ───────────────────────────────────────────────────────────────────────────────
# Configuration
# ───────────────────────────────────────────────────────────────────────────────
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_NAME="luvex"
BACKUP_DIR="${SCRIPT_DIR}/backups"
DATE=$(date +%Y%m%d_%H%M%S)

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# ───────────────────────────────────────────────────────────────────────────────
# Helper Functions
# ───────────────────────────────────────────────────────────────────────────────
log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

check_env() {
    if [ ! -f "${SCRIPT_DIR}/.env" ]; then
        log_error ".env file not found!"
        log_info "Please copy .env.example to .env and configure it:"
        log_info "  cp .env.example .env"
        log_info "  nano .env"
        exit 1
    fi
}

check_docker() {
    if ! command -v docker &> /dev/null; then
        log_error "Docker is not installed!"
        exit 1
    fi

    if ! command -v docker-compose &> /dev/null && ! docker compose version &> /dev/null; then
        log_error "Docker Compose is not installed!"
        exit 1
    fi
}

# ───────────────────────────────────────────────────────────────────────────────
# Backup Functions
# ───────────────────────────────────────────────────────────────────────────────
backup_database() {
    log_info "Creating database backup..."

    mkdir -p "${BACKUP_DIR}"

    local backup_file="${BACKUP_DIR}/luvex_db_${DATE}.sql"

    docker exec luvex-mysql mysqldump \
        -u root \
        -p"${MYSQL_ROOT_PASSWORD}" \
        --single-transaction \
        --quick \
        --lock-tables=false \
        "${MYSQL_DATABASE}" > "${backup_file}"

    gzip "${backup_file}"

    log_success "Database backup created: ${backup_file}.gz"
}

backup_files() {
    log_info "Creating file backup (uploads, plugins)..."

    mkdir -p "${BACKUP_DIR}"

    local backup_file="${BACKUP_DIR}/luvex_files_${DATE}.tar.gz"

    docker run --rm \
        -v luvex-website_wordpress_uploads:/uploads:ro \
        -v luvex-website_wordpress_plugins:/plugins:ro \
        -v "${BACKUP_DIR}:/backup" \
        alpine:latest \
        tar czf "/backup/luvex_files_${DATE}.tar.gz" -C / uploads plugins

    log_success "File backup created: ${backup_file}"
}

cleanup_old_backups() {
    local retention_days="${BACKUP_RETENTION_DAYS:-7}"
    log_info "Cleaning up backups older than ${retention_days} days..."

    find "${BACKUP_DIR}" -name "luvex_*" -type f -mtime +"${retention_days}" -delete

    log_success "Old backups cleaned up"
}

# ───────────────────────────────────────────────────────────────────────────────
# Deployment Functions
# ───────────────────────────────────────────────────────────────────────────────
deploy() {
    log_info "Starting deployment..."

    check_env
    check_docker

    # Source .env for backup functions
    source "${SCRIPT_DIR}/.env"

    # Create backup before deployment
    if docker ps -q -f name=luvex-mysql | grep -q .; then
        backup_database
        backup_files
    else
        log_warning "Containers not running, skipping backup"
    fi

    # Pull latest images
    log_info "Pulling latest Docker images..."
    docker-compose -f "${SCRIPT_DIR}/docker-compose.yml" pull

    # Start/Restart containers
    log_info "Starting containers..."
    docker-compose -f "${SCRIPT_DIR}/docker-compose.yml" up -d

    # Wait for services to be healthy
    log_info "Waiting for services to be healthy..."
    sleep 10

    # Check health
    health_check

    # Cleanup old backups
    cleanup_old_backups

    log_success "Deployment completed successfully!"
    log_info "Access your site at: https://luvex.tech"
}

# ───────────────────────────────────────────────────────────────────────────────
# Management Functions
# ───────────────────────────────────────────────────────────────────────────────
start() {
    log_info "Starting containers..."
    docker-compose -f "${SCRIPT_DIR}/docker-compose.yml" up -d
    log_success "Containers started"
}

stop() {
    log_info "Stopping containers..."
    docker-compose -f "${SCRIPT_DIR}/docker-compose.yml" stop
    log_success "Containers stopped"
}

restart() {
    log_info "Restarting containers..."
    docker-compose -f "${SCRIPT_DIR}/docker-compose.yml" restart
    log_success "Containers restarted"
}

status() {
    log_info "Container status:"
    docker-compose -f "${SCRIPT_DIR}/docker-compose.yml" ps
}

health_check() {
    log_info "Running health checks..."

    local all_healthy=true

    # Check MySQL
    if docker exec luvex-mysql mysqladmin ping -h localhost --silent; then
        log_success "MySQL is healthy"
    else
        log_error "MySQL is unhealthy"
        all_healthy=false
    fi

    # Check WordPress
    if docker exec luvex-wordpress php-fpm-healthcheck 2>/dev/null || docker ps -f name=luvex-wordpress --format "{{.Status}}" | grep -q "healthy\|Up"; then
        log_success "WordPress is healthy"
    else
        log_error "WordPress is unhealthy"
        all_healthy=false
    fi

    # Check Nginx
    if docker exec luvex-nginx nginx -t 2>&1 | grep -q "successful"; then
        log_success "Nginx configuration is valid"
    else
        log_error "Nginx configuration is invalid"
        all_healthy=false
    fi

    if [ "$all_healthy" = true ]; then
        log_success "All services are healthy!"
    else
        log_error "Some services are unhealthy!"
        exit 1
    fi
}

logs() {
    local service="${1:-}"

    if [ -z "$service" ]; then
        log_info "Showing all logs (Ctrl+C to exit)..."
        docker-compose -f "${SCRIPT_DIR}/docker-compose.yml" logs -f
    else
        log_info "Showing logs for ${service} (Ctrl+C to exit)..."
        docker-compose -f "${SCRIPT_DIR}/docker-compose.yml" logs -f "$service"
    fi
}

shell() {
    local service="${1:-wordpress}"
    log_info "Opening shell in ${service} container..."
    docker exec -it "luvex-${service}" /bin/sh
}

# ───────────────────────────────────────────────────────────────────────────────
# Database Management
# ───────────────────────────────────────────────────────────────────────────────
db_import() {
    local sql_file="$1"

    if [ -z "$sql_file" ] || [ ! -f "$sql_file" ]; then
        log_error "Please provide a valid SQL file path"
        log_info "Usage: $0 db-import /path/to/backup.sql"
        exit 1
    fi

    check_env
    source "${SCRIPT_DIR}/.env"

    log_warning "This will overwrite the current database!"
    read -p "Are you sure? (yes/no): " confirm

    if [ "$confirm" != "yes" ]; then
        log_info "Import cancelled"
        exit 0
    fi

    log_info "Importing database from ${sql_file}..."

    # Decompress if gzipped
    if [[ "$sql_file" == *.gz ]]; then
        gunzip -c "$sql_file" | docker exec -i luvex-mysql mysql -u root -p"${MYSQL_ROOT_PASSWORD}" "${MYSQL_DATABASE}"
    else
        docker exec -i luvex-mysql mysql -u root -p"${MYSQL_ROOT_PASSWORD}" "${MYSQL_DATABASE}" < "$sql_file"
    fi

    log_success "Database imported successfully"
}

db_export() {
    check_env
    source "${SCRIPT_DIR}/.env"
    backup_database
}

# ───────────────────────────────────────────────────────────────────────────────
# Rollback Function
# ───────────────────────────────────────────────────────────────────────────────
rollback() {
    log_warning "Available backups:"
    ls -lh "${BACKUP_DIR}"/luvex_db_*.sql.gz 2>/dev/null || log_error "No backups found"

    echo ""
    read -p "Enter backup date (YYYYMMDD_HHMMSS): " backup_date

    local db_backup="${BACKUP_DIR}/luvex_db_${backup_date}.sql.gz"

    if [ ! -f "$db_backup" ]; then
        log_error "Backup not found: ${db_backup}"
        exit 1
    fi

    log_warning "This will restore the database to ${backup_date}"
    read -p "Are you sure? (yes/no): " confirm

    if [ "$confirm" != "yes" ]; then
        log_info "Rollback cancelled"
        exit 0
    fi

    db_import "$db_backup"
    restart

    log_success "Rollback completed!"
}

# ───────────────────────────────────────────────────────────────────────────────
# SSL Certificate Management
# ───────────────────────────────────────────────────────────────────────────────
ssl_setup() {
    log_info "Setting up SSL certificate with Let's Encrypt..."
    log_warning "Make sure DNS is already pointing to this server!"

    read -p "Domain (e.g., luvex.tech): " domain
    read -p "Email for Let's Encrypt: " email

    if [ -z "$domain" ] || [ -z "$email" ]; then
        log_error "Domain and email are required"
        exit 1
    fi

    log_info "Obtaining SSL certificate for ${domain}..."

    docker run -it --rm \
        -v /etc/letsencrypt:/etc/letsencrypt \
        -v /var/www/certbot:/var/www/certbot \
        certbot/certbot certonly \
        --webroot \
        --webroot-path=/var/www/certbot \
        --email "$email" \
        --agree-tos \
        --no-eff-email \
        -d "$domain" \
        -d "www.${domain}"

    log_success "SSL certificate obtained!"
    log_info "Restarting Nginx..."
    docker-compose -f "${SCRIPT_DIR}/docker-compose.yml" restart nginx
}

# ───────────────────────────────────────────────────────────────────────────────
# Main Script
# ───────────────────────────────────────────────────────────────────────────────
show_help() {
    cat << EOF
═══════════════════════════════════════════════════════════════════════════════
LUVEX.TECH Deployment & Management Script
═══════════════════════════════════════════════════════════════════════════════

Usage: $0 [command] [options]

DEPLOYMENT:
  deploy              Full deployment (backup + restart + health check)
  start               Start all containers
  stop                Stop all containers
  restart             Restart all containers
  status              Show container status

MONITORING:
  health              Run health checks on all services
  logs [service]      Show logs (all or specific service: wordpress, nginx, mysql)
  shell [service]     Open shell in container (default: wordpress)

DATABASE:
  db-export           Export database to backup
  db-import <file>    Import database from SQL file
  rollback            Restore from backup (interactive)

BACKUP:
  backup-db           Create database backup only
  backup-files        Create files backup only

SSL:
  ssl-setup           Set up SSL certificate with Let's Encrypt

EXAMPLES:
  $0 deploy                      # Full deployment
  $0 logs wordpress              # Show WordPress logs
  $0 db-import backup.sql.gz     # Import database
  $0 rollback                    # Restore from backup

═══════════════════════════════════════════════════════════════════════════════
EOF
}

# Parse command
case "${1:-}" in
    deploy)
        deploy
        ;;
    start)
        start
        ;;
    stop)
        stop
        ;;
    restart)
        restart
        ;;
    status)
        status
        ;;
    health)
        health_check
        ;;
    logs)
        logs "$2"
        ;;
    shell)
        shell "$2"
        ;;
    db-export)
        check_env
        source "${SCRIPT_DIR}/.env"
        db_export
        ;;
    db-import)
        db_import "$2"
        ;;
    rollback)
        rollback
        ;;
    backup-db)
        check_env
        source "${SCRIPT_DIR}/.env"
        backup_database
        ;;
    backup-files)
        check_env
        source "${SCRIPT_DIR}/.env"
        backup_files
        ;;
    ssl-setup)
        ssl_setup
        ;;
    help|--help|-h)
        show_help
        ;;
    *)
        log_error "Unknown command: ${1:-}"
        echo ""
        show_help
        exit 1
        ;;
esac
