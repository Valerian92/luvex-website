#!/bin/bash

# ═══════════════════════════════════════════════════════════════════════════════
# LUVEX.TECH - Student App Integration Setup Script
# ═══════════════════════════════════════════════════════════════════════════════
# Purpose: Automate the setup of WordPress database sharing for student app
# Author: WordPress DevOps Agent
# Usage: ./setup-student-app-integration.sh
# ═══════════════════════════════════════════════════════════════════════════════

set -e  # Exit on error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
DB_CONTAINER="luvex-mysql"
EXTERNAL_USER="external_app"
EXTERNAL_PASSWORD="SecurePassword123!"  # CHANGE THIS IN PRODUCTION!
DB_NAME="luvex_production"

# Function to print colored messages
print_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Function to check if command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# ═══════════════════════════════════════════════════════════════════════════════
# STEP 1: Pre-flight Checks
# ═══════════════════════════════════════════════════════════════════════════════
print_info "Starting Student App Integration Setup..."
echo ""

# Check if Docker is installed
if ! command_exists docker; then
    print_error "Docker is not installed. Please install Docker first."
    exit 1
fi

# Check if docker-compose is installed
if ! command_exists docker-compose; then
    print_error "docker-compose is not installed. Please install docker-compose first."
    exit 1
fi

# Check if .env file exists
if [ ! -f .env ]; then
    print_error ".env file not found. Please create it from .env.example"
    echo "Run: cp .env.example .env"
    exit 1
fi

print_success "Pre-flight checks passed"
echo ""

# ═══════════════════════════════════════════════════════════════════════════════
# STEP 2: Create Docker Networks
# ═══════════════════════════════════════════════════════════════════════════════
print_info "Creating Docker networks..."

# Create luvex-network if it doesn't exist
if ! docker network inspect luvex-network >/dev/null 2>&1; then
    docker network create luvex-network
    print_success "Created luvex-network"
else
    print_warning "luvex-network already exists (OK)"
fi

# Create db-shared network if it doesn't exist
if ! docker network inspect db-shared >/dev/null 2>&1; then
    docker network create db-shared
    print_success "Created db-shared network"
else
    print_warning "db-shared network already exists (OK)"
fi

echo ""

# ═══════════════════════════════════════════════════════════════════════════════
# STEP 3: Start MySQL Container
# ═══════════════════════════════════════════════════════════════════════════════
print_info "Starting MySQL container..."

# Start only MySQL service
docker-compose up -d mysql

print_info "Waiting for MySQL to be healthy (this may take 30 seconds)..."
COUNTER=0
MAX_TRIES=30
until docker exec $DB_CONTAINER mysqladmin ping -h localhost --silent >/dev/null 2>&1 || [ $COUNTER -eq $MAX_TRIES ]; do
    printf "."
    sleep 1
    COUNTER=$((COUNTER+1))
done
echo ""

if [ $COUNTER -eq $MAX_TRIES ]; then
    print_error "MySQL did not become healthy within expected time"
    print_info "Check logs with: docker-compose logs mysql"
    exit 1
fi

print_success "MySQL is healthy and ready"
echo ""

# ═══════════════════════════════════════════════════════════════════════════════
# STEP 4: Restore Database (if backup exists)
# ═══════════════════════════════════════════════════════════════════════════════
print_info "Checking for database backup..."

if [ -f "backups/backup.sql" ]; then
    print_info "Found backup.sql - importing database..."

    # Import SQL file
    docker exec -i $DB_CONTAINER mysql -u root -p${MYSQL_ROOT_PASSWORD} $DB_NAME < backups/backup.sql

    print_success "Database imported successfully"
elif [ -f "backups/backup.sql.gz" ]; then
    print_info "Found backup.sql.gz - importing compressed database..."

    # Import compressed SQL file
    gunzip -c backups/backup.sql.gz | docker exec -i $DB_CONTAINER mysql -u root -p${MYSQL_ROOT_PASSWORD} $DB_NAME

    print_success "Database imported successfully"
else
    print_warning "No database backup found in backups/ directory"
    print_info "Place your backup.sql or backup.sql.gz in the backups/ directory and run this script again"
fi

echo ""

# ═══════════════════════════════════════════════════════════════════════════════
# STEP 5: Restore WordPress Files (if backup exists)
# ═══════════════════════════════════════════════════════════════════════════════
print_info "Checking for WordPress files backup..."

if [ -f "backups/final_backup.tar.gz" ]; then
    print_info "Found final_backup.tar.gz - extracting..."

    # Extract to temp directory
    mkdir -p backups/temp_restore
    tar -xzf backups/final_backup.tar.gz -C backups/temp_restore

    print_info "Copying files to Docker volumes..."

    # Start WordPress container to mount volumes
    docker-compose up -d wordpress
    sleep 5

    # Copy uploads
    if [ -d "backups/temp_restore/wp-content/uploads" ]; then
        docker cp backups/temp_restore/wp-content/uploads/. luvex-wordpress:/var/www/html/wp-content/uploads/
        print_success "WordPress uploads restored"
    fi

    # Copy plugins
    if [ -d "backups/temp_restore/wp-content/plugins" ]; then
        docker cp backups/temp_restore/wp-content/plugins/. luvex-wordpress:/var/www/html/wp-content/plugins/
        print_success "WordPress plugins restored"
    fi

    # Set correct permissions
    docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/wp-content
    docker exec luvex-wordpress chmod -R 755 /var/www/html/wp-content/uploads
    docker exec luvex-wordpress chmod -R 755 /var/www/html/wp-content/plugins

    # Clean up
    rm -rf backups/temp_restore

    print_success "WordPress files restored successfully"
else
    print_warning "No WordPress files backup found (final_backup.tar.gz)"
    print_info "Place your backup in the backups/ directory and run this script again"
fi

echo ""

# ═══════════════════════════════════════════════════════════════════════════════
# STEP 6: Create External Database User
# ═══════════════════════════════════════════════════════════════════════════════
print_info "Creating external database user for student app..."

# Execute SQL script to create external user
docker exec -i $DB_CONTAINER mysql -u root -p${MYSQL_ROOT_PASSWORD} < setup-external-db-user.sql

print_success "External database user 'external_app' created"
echo ""

# ═══════════════════════════════════════════════════════════════════════════════
# STEP 7: Verify Database Connectivity
# ═══════════════════════════════════════════════════════════════════════════════
print_info "Testing external database access..."

# Test connection from external container
RESULT=$(docker run --rm --network db-shared mysql:8.0 \
    mysql -h wp-db -u $EXTERNAL_USER -p$EXTERNAL_PASSWORD \
    -e "SELECT COUNT(*) FROM ${DB_NAME}.wp_users;" 2>&1 || true)

if echo "$RESULT" | grep -q "COUNT"; then
    print_success "External database access verified!"
    echo "   Test query result: $RESULT"
else
    print_error "External database access test failed"
    echo "   Error: $RESULT"
    print_info "This might be OK if wp_users table doesn't exist yet"
fi

echo ""

# ═══════════════════════════════════════════════════════════════════════════════
# STEP 8: Start All Services
# ═══════════════════════════════════════════════════════════════════════════════
print_info "Starting all WordPress services..."

docker-compose up -d

print_success "All services started"
echo ""

# ═══════════════════════════════════════════════════════════════════════════════
# STEP 9: Health Check
# ═══════════════════════════════════════════════════════════════════════════════
print_info "Running health check..."

docker-compose ps

echo ""
print_success "Setup complete! 🎉"
echo ""

# ═══════════════════════════════════════════════════════════════════════════════
# Print Summary
# ═══════════════════════════════════════════════════════════════════════════════
echo "═══════════════════════════════════════════════════════════════════════════════"
echo "STUDENT APP DATABASE CONNECTION DETAILS"
echo "═══════════════════════════════════════════════════════════════════════════════"
echo ""
echo "Network Configuration:"
echo "  Network Name:    db-shared"
echo "  Database Host:   wp-db"
echo "  Database Port:   3306"
echo ""
echo "Database Credentials:"
echo "  Database:        $DB_NAME"
echo "  Username:        $EXTERNAL_USER"
echo "  Password:        $EXTERNAL_PASSWORD"
echo "  Privileges:      SELECT only (read-only)"
echo ""
echo "⚠️  IMPORTANT: Change the password in production!"
echo ""
echo "Next Steps:"
echo "  1. Update the password in setup-external-db-user.sql"
echo "  2. Provide these credentials to the App Developer Agent"
echo "  3. Ensure student app container joins 'db-shared' network"
echo ""
echo "═══════════════════════════════════════════════════════════════════════════════"
