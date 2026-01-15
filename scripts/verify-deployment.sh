#!/bin/bash

# ═══════════════════════════════════════════════════════════════════════════════
# LUVEX.TECH - Deployment Verification Script
# ═══════════════════════════════════════════════════════════════════════════════
# Purpose: Comprehensive verification after deployment and backup restore
# ═══════════════════════════════════════════════════════════════════════════════

# Color codes for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Deployment directory
DEPLOY_DIR="/opt/apps/luvex-website"

# Check counter
CHECKS_PASSED=0
CHECKS_FAILED=0

echo -e "${BLUE}═══════════════════════════════════════════════════════════════════════════════${NC}"
echo -e "${BLUE}LUVEX.TECH - Deployment Verification${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════════════════════════════════${NC}"

# ───────────────────────────────────────────────────────────────────────────────
# Check 1: Container Status
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Check 1: Container Status${NC}"

MYSQL_STATUS=$(docker ps --filter "name=luvex-mysql" --format "{{.Status}}" | grep -c "Up" || echo "0")
WORDPRESS_STATUS=$(docker ps --filter "name=luvex-wordpress" --format "{{.Status}}" | grep -c "Up" || echo "0")
NGINX_STATUS=$(docker ps --filter "name=luvex-nginx" --format "{{.Status}}" | grep -c "Up" || echo "0")

if [ "$MYSQL_STATUS" -eq 1 ] && [ "$WORDPRESS_STATUS" -eq 1 ] && [ "$NGINX_STATUS" -eq 1 ]; then
    echo -e "${GREEN}✓ All containers are running${NC}"
    docker ps --filter "name=luvex" --format "table {{.Names}}\t{{.Status}}"
    ((CHECKS_PASSED++))
else
    echo -e "${RED}✗ Some containers are not running!${NC}"
    docker ps -a --filter "name=luvex" --format "table {{.Names}}\t{{.Status}}"
    ((CHECKS_FAILED++))
fi

# ───────────────────────────────────────────────────────────────────────────────
# Check 2: Network Warnings
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Check 2: Network Configuration (checking for warnings)${NC}"

cd "$DEPLOY_DIR" || exit 1
NETWORK_OUTPUT=$(docker-compose up -d 2>&1)

if echo "$NETWORK_OUTPUT" | grep -q "WARN.*network with name.*exists but was not created"; then
    echo -e "${RED}✗ Network warning detected!${NC}"
    echo "$NETWORK_OUTPUT" | grep "WARN"
    echo -e "${YELLOW}Fix: Ensure networks have 'external: true' in docker-compose.yml${NC}"
    ((CHECKS_FAILED++))
else
    echo -e "${GREEN}✓ No network warnings (external: true configured correctly)${NC}"
    ((CHECKS_PASSED++))
fi

# ───────────────────────────────────────────────────────────────────────────────
# Check 3: Website Accessibility
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Check 3: Website Accessibility${NC}"

HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" -L https://luvex.tech 2>/dev/null || echo "000")

if [ "$HTTP_CODE" -eq 200 ] || [ "$HTTP_CODE" -eq 301 ] || [ "$HTTP_CODE" -eq 302 ]; then
    echo -e "${GREEN}✓ Website is accessible (HTTP $HTTP_CODE)${NC}"
    ((CHECKS_PASSED++))
else
    echo -e "${RED}✗ Website not accessible (HTTP $HTTP_CODE)${NC}"
    ((CHECKS_FAILED++))
fi

# ───────────────────────────────────────────────────────────────────────────────
# Check 4: WordPress Files
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Check 4: WordPress Core Files${NC}"

WP_CONFIG=$(docker exec luvex-wordpress test -f /var/www/html/wp-config.php && echo "exists" || echo "missing")
WP_INDEX=$(docker exec luvex-wordpress test -f /var/www/html/index.php && echo "exists" || echo "missing")

if [ "$WP_CONFIG" == "exists" ] && [ "$WP_INDEX" == "exists" ]; then
    echo -e "${GREEN}✓ WordPress core files present${NC}"
    ((CHECKS_PASSED++))
else
    echo -e "${RED}✗ WordPress core files missing!${NC}"
    echo "   wp-config.php: $WP_CONFIG"
    echo "   index.php: $WP_INDEX"
    ((CHECKS_FAILED++))
fi

# ───────────────────────────────────────────────────────────────────────────────
# Check 5: Uploads Directory
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Check 5: Uploads Directory${NC}"

UPLOADS_COUNT=$(docker exec luvex-wordpress sh -c 'find /var/www/html/wp-content/uploads -type f 2>/dev/null | wc -l' || echo "0")

if [ "$UPLOADS_COUNT" -gt 0 ]; then
    echo -e "${GREEN}✓ Uploads directory has files ($UPLOADS_COUNT files)${NC}"
    docker exec luvex-wordpress ls -lh /var/www/html/wp-content/uploads/ 2>/dev/null | head -10
    ((CHECKS_PASSED++))
else
    echo -e "${YELLOW}⚠ Uploads directory is empty${NC}"
    echo "   If you restored a backup, this might indicate an issue"
    ((CHECKS_FAILED++))
fi

# ───────────────────────────────────────────────────────────────────────────────
# Check 6: Themes
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Check 6: Themes Directory${NC}"

THEMES_COUNT=$(docker exec luvex-wordpress sh -c 'ls -1 /var/www/html/wp-content/themes 2>/dev/null | wc -l' || echo "0")

if [ "$THEMES_COUNT" -gt 0 ]; then
    echo -e "${GREEN}✓ Themes present ($THEMES_COUNT themes)${NC}"
    docker exec luvex-wordpress ls -1 /var/www/html/wp-content/themes 2>/dev/null
    ((CHECKS_PASSED++))
else
    echo -e "${RED}✗ No themes found!${NC}"
    ((CHECKS_FAILED++))
fi

# ───────────────────────────────────────────────────────────────────────────────
# Check 7: Plugins
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Check 7: Plugins Directory${NC}"

PLUGINS_COUNT=$(docker exec luvex-wordpress sh -c 'ls -1 /var/www/html/wp-content/plugins 2>/dev/null | wc -l' || echo "0")

if [ "$PLUGINS_COUNT" -gt 0 ]; then
    echo -e "${GREEN}✓ Plugins present ($PLUGINS_COUNT plugins)${NC}"
    docker exec luvex-wordpress ls -1 /var/www/html/wp-content/plugins 2>/dev/null
    ((CHECKS_PASSED++))
else
    echo -e "${YELLOW}⚠ No plugins found (fresh install might have none)${NC}"
    # Don't count this as a failure
    ((CHECKS_PASSED++))
fi

# ───────────────────────────────────────────────────────────────────────────────
# Check 8: Database Connection
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Check 8: Database Connection${NC}"

DB_TABLES=$(docker exec luvex-mysql mysql -u root -p"${MYSQL_ROOT_PASSWORD:-rootpassword}" -e "USE ${MYSQL_DATABASE:-luvex_production}; SHOW TABLES;" 2>/dev/null | wc -l || echo "0")

if [ "$DB_TABLES" -gt 1 ]; then
    echo -e "${GREEN}✓ Database accessible with $((DB_TABLES-1)) tables${NC}"
    ((CHECKS_PASSED++))
else
    echo -e "${RED}✗ Database empty or not accessible!${NC}"
    ((CHECKS_FAILED++))
fi

# ───────────────────────────────────────────────────────────────────────────────
# Check 9: Volumes
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Check 9: Docker Volumes${NC}"

echo -e "${BLUE}Current volumes:${NC}"
docker volume ls | grep luvex-website

VOLUME_COUNT=$(docker volume ls | grep -c luvex-website || echo "0")

if [ "$VOLUME_COUNT" -ge 2 ]; then
    echo -e "${GREEN}✓ Required volumes present ($VOLUME_COUNT volumes)${NC}"
    ((CHECKS_PASSED++))
else
    echo -e "${RED}✗ Missing volumes!${NC}"
    ((CHECKS_FAILED++))
fi

# ───────────────────────────────────────────────────────────────────────────────
# Check 10: Networks
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${YELLOW}Check 10: Docker Networks${NC}"

LUVEX_NETWORK=$(docker network inspect luvex-network >/dev/null 2>&1 && echo "exists" || echo "missing")
DB_SHARED_NETWORK=$(docker network inspect db-shared >/dev/null 2>&1 && echo "exists" || echo "missing")

if [ "$LUVEX_NETWORK" == "exists" ] && [ "$DB_SHARED_NETWORK" == "exists" ]; then
    echo -e "${GREEN}✓ Both networks present (luvex-network, db-shared)${NC}"
    ((CHECKS_PASSED++))
else
    echo -e "${RED}✗ Missing networks!${NC}"
    echo "   luvex-network: $LUVEX_NETWORK"
    echo "   db-shared: $DB_SHARED_NETWORK"
    ((CHECKS_FAILED++))
fi

# ───────────────────────────────────────────────────────────────────────────────
# Final Summary
# ───────────────────────────────────────────────────────────────────────────────
echo -e "\n${BLUE}═══════════════════════════════════════════════════════════════════════════════${NC}"
echo -e "${BLUE}Verification Summary${NC}"
echo -e "${BLUE}═══════════════════════════════════════════════════════════════════════════════${NC}"

echo -e "\n${GREEN}Checks Passed: $CHECKS_PASSED${NC}"
echo -e "${RED}Checks Failed: $CHECKS_FAILED${NC}"

if [ "$CHECKS_FAILED" -eq 0 ]; then
    echo -e "\n${GREEN}✓ All checks passed! Deployment is healthy.${NC}"
    echo -e "\n${YELLOW}Next steps:${NC}"
    echo "1. Test website: https://luvex.tech"
    echo "2. Test admin login: https://luvex.tech/wp-admin"
    echo "3. Verify restored content and functionality"
    exit 0
else
    echo -e "\n${RED}✗ Some checks failed. Please review the issues above.${NC}"
    echo -e "\n${YELLOW}Troubleshooting:${NC}"
    echo "1. Check container logs: docker logs luvex-mysql && docker logs luvex-wordpress"
    echo "2. Verify backup restore completed successfully"
    echo "3. Check environment variables in .env file"
    echo "4. Review docker-compose.yml configuration"
    exit 1
fi
