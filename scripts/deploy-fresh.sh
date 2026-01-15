#!/bin/bash

# ═══════════════════════════════════════════════════════════════════════════════
# LUVEX.TECH - Fresh Deployment Script
# ═══════════════════════════════════════════════════════════════════════════════
# Purpose: Clean deployment on /opt/apps/luvex-website with backup restore
# Networks: luvex-network + db-shared (external: true) - NO WARNINGS!
# ═══════════════════════════════════════════════════════════════════════════════

set -e  # Exit on error

# Color codes for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Deployment directory
DEPLOY_DIR="/opt/apps/luvex-website"

echo -e "${BLUE}═══════════════════════════════════════════════════════════════════════════════${NC}"
echo -e "${BLUE}LUVEX.TECH - Fresh Deployment${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════════════════════════════════${NC}"

# ───────────────────────────────────────────────────────────────────────────────
# Step 1: Cleanup old containers and volumes
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Step 1: Cleaning up old containers and volumes...${NC}"

cd "$DEPLOY_DIR" || exit 1

echo "Stopping and removing old containers..."
docker-compose down -v --remove-orphans

echo "Removing old volumes (if they exist)..."
docker volume rm luvex-tech_mysql_data 2>/dev/null || true
docker volume rm luvex-tech_wordpress_data 2>/dev/null || true
docker volume rm luvex-website_mysql_data 2>/dev/null || true
docker volume rm luvex-website_wordpress_data 2>/dev/null || true
docker volume rm luvex-website_wordpress_uploads 2>/dev/null || true
docker volume rm luvex-website_wordpress_plugins 2>/dev/null || true

echo -e "${GREEN}✓ Cleanup completed${NC}"

# ───────────────────────────────────────────────────────────────────────────────
# Step 2: Verify docker-compose.yml configuration
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Step 2: Verifying docker-compose.yml configuration...${NC}"

if ! grep -q "external: true" docker-compose.yml; then
    echo -e "${RED}✗ ERROR: Networks not configured as external!${NC}"
    echo "Please ensure networks section has 'external: true'"
    exit 1
fi

echo -e "${GREEN}✓ Configuration verified (networks are external)${NC}"

# ───────────────────────────────────────────────────────────────────────────────
# Step 3: Fresh Deploy
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Step 3: Starting fresh containers...${NC}"

docker-compose up -d

echo "Waiting for services to be ready (15 seconds)..."
sleep 15

echo -e "${GREEN}✓ Containers started${NC}"

# ───────────────────────────────────────────────────────────────────────────────
# Step 4: Check container status
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Step 4: Checking container status...${NC}"

echo -e "\n${BLUE}Container Status:${NC}"
docker ps --filter "name=luvex" --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"

echo -e "\n${BLUE}MySQL Logs (last 30 lines):${NC}"
docker logs luvex-mysql --tail 30

echo -e "\n${BLUE}WordPress Logs (last 30 lines):${NC}"
docker logs luvex-wordpress --tail 30

# ───────────────────────────────────────────────────────────────────────────────
# Step 5: Backup Restore Instructions
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${BLUE}═══════════════════════════════════════════════════════════════════════════════${NC}"
echo -e "${BLUE}Step 5: Backup Restore (MANUAL)${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════════════════════════════════${NC}"

echo -e "\n${YELLOW}To restore from backup, run the following commands:${NC}"
echo -e "\n${GREEN}1. Database Restore:${NC}"
echo "   cat /path/to/backup-database.sql | docker exec -i luvex-mysql mysql -u \$MYSQL_USER -p\$MYSQL_PASSWORD \$MYSQL_DATABASE"

echo -e "\n${GREEN}2. WordPress Files Restore:${NC}"
echo "   # Copy backup to container"
echo "   docker cp /path/to/backup-wordpress-files.tar.gz luvex-wordpress:/tmp/"
echo ""
echo "   # Extract and set permissions"
echo "   docker exec luvex-wordpress tar -xzf /tmp/backup-wordpress-files.tar.gz -C /var/www/html/"
echo "   docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/"
echo "   docker exec luvex-wordpress rm /tmp/backup-wordpress-files.tar.gz"

echo -e "\n${GREEN}3. Uploads Restore (if separate backup):${NC}"
echo "   docker cp /path/to/uploads-backup.tar.gz luvex-wordpress:/tmp/"
echo "   docker exec luvex-wordpress tar -xzf /tmp/uploads-backup.tar.gz -C /var/www/html/wp-content/uploads/"
echo "   docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/wp-content/uploads/"

echo -e "\n${BLUE}═══════════════════════════════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}✓ Fresh deployment completed!${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════════════════════════════════${NC}"

echo -e "\n${YELLOW}Next steps:${NC}"
echo "1. Restore backup using the commands above"
echo "2. Run verification: ./scripts/verify-deployment.sh"
echo "3. Test website: https://luvex.tech"
echo "4. Test admin login: https://luvex.tech/wp-admin"
