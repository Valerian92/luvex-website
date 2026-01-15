# LUVEX.TECH - Fresh Deployment Guide

## Overview

This guide provides step-by-step instructions for performing a clean WordPress deployment on `/opt/apps/luvex-website` with backup restore capabilities.

## Network Configuration Fix

The deployment now correctly handles external Docker networks, eliminating this warning:

```
WARN[0000] a network with name luvex-network exists but was not created for project "luvex-website".
Set `external: true` to use an existing network
```

**Status:** ✅ Fixed - Networks are configured as `external: true` in docker-compose.yml

## Architecture

- **Reverse Proxy:** Nginx with SSL/TLS termination
- **Application:** WordPress 6.4 with PHP 8.2 FPM
- **Database:** MySQL 8.0
- **Networks:**
  - `luvex-network` (internal WordPress stack)
  - `db-shared` (external app access to database)

## Prerequisites

1. Docker and Docker Compose installed
2. Access to `/opt/apps/luvex-website` directory
3. Backup files ready (if restoring from backup):
   - Database SQL dump
   - WordPress files tarball
   - Uploads directory (optional separate backup)
4. External networks created:
   ```bash
   docker network create luvex-network 2>/dev/null || true
   docker network create db-shared 2>/dev/null || true
   ```

## Deployment Steps

### Step 1: Navigate to Deployment Directory

```bash
cd /opt/apps/luvex-website
```

### Step 2: Run Fresh Deployment Script

```bash
chmod +x scripts/deploy-fresh.sh
./scripts/deploy-fresh.sh
```

This script will:
- Stop and remove old containers
- Clean up old volumes
- Verify docker-compose.yml configuration
- Start fresh containers with new volumes
- Display container status and logs

### Step 3: Restore from Backup (Manual)

After the fresh deployment, restore your backup:

#### 3a. Database Restore

```bash
# Using root credentials
cat /path/to/backup-database.sql | docker exec -i luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD

# OR using regular user credentials
cat /path/to/backup-database.sql | docker exec -i luvex-mysql mysql -u $MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE
```

#### 3b. WordPress Files Restore

```bash
# Copy backup to container
docker cp /path/to/backup-wordpress-files.tar.gz luvex-wordpress:/tmp/

# Extract and set permissions
docker exec luvex-wordpress tar -xzf /tmp/backup-wordpress-files.tar.gz -C /var/www/html/
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/
docker exec luvex-wordpress rm /tmp/backup-wordpress-files.tar.gz
```

#### 3c. Uploads Restore (if separate backup)

```bash
docker cp /path/to/uploads-backup.tar.gz luvex-wordpress:/tmp/
docker exec luvex-wordpress tar -xzf /tmp/uploads-backup.tar.gz -C /var/www/html/wp-content/uploads/
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/wp-content/uploads/
docker exec luvex-wordpress rm /tmp/uploads-backup.tar.gz
```

### Step 4: Verify Deployment

```bash
chmod +x scripts/verify-deployment.sh
./scripts/verify-deployment.sh
```

This script performs comprehensive checks:
1. Container Status (all containers running)
2. Network Configuration (no warnings)
3. Website Accessibility (HTTP response)
4. WordPress Core Files (wp-config.php, index.php)
5. Uploads Directory (file count)
6. Themes Directory (themes present)
7. Plugins Directory (plugins present)
8. Database Connection (tables accessible)
9. Docker Volumes (all volumes present)
10. Docker Networks (both networks exist)

## Container Names

- **MySQL:** `luvex-mysql`
- **WordPress:** `luvex-wordpress`
- **Nginx:** `luvex-nginx`

## Volume Names

- `luvex-website_mysql_data` - MySQL database files
- `luvex-website_wordpress_data` - WordPress core files
- `luvex-website_wordpress_uploads` - Media uploads
- `luvex-website_wordpress_plugins` - WordPress plugins

## Network Names

- `luvex-network` - Internal WordPress stack network (external: true)
- `db-shared` - Shared database access network (external: true)

## Troubleshooting

### Containers Not Starting

```bash
# Check container logs
docker logs luvex-mysql --tail 100
docker logs luvex-wordpress --tail 100
docker logs luvex-nginx --tail 100

# Check container status
docker ps -a | grep luvex
```

### Website Not Accessible

```bash
# Test direct Nginx access
curl -I http://localhost

# Check Nginx configuration
docker exec luvex-nginx nginx -t

# Check Traefik routing (if using Traefik)
docker logs traefik --tail 50 | grep luvex
```

### Database Issues

```bash
# Check MySQL connection
docker exec luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD -e "SHOW DATABASES;"

# Check WordPress database
docker exec luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD -e "USE $MYSQL_DATABASE; SHOW TABLES;"

# Check database logs
docker logs luvex-mysql --tail 100
```

### Network Warnings Persist

```bash
# Verify network configuration in docker-compose.yml
grep -A 3 "^networks:" docker-compose.yml

# Should show:
# networks:
#   luvex-network:
#     external: true
#     name: luvex-network
#   db-shared:
#     external: true
#     name: db-shared

# Check network status
docker network inspect luvex-network
docker network inspect db-shared
```

### Permission Issues

```bash
# Fix WordPress file permissions
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/
docker exec luvex-wordpress find /var/www/html -type d -exec chmod 755 {} \;
docker exec luvex-wordpress find /var/www/html -type f -exec chmod 644 {} \;
```

## Manual Commands

### Stop Deployment

```bash
cd /opt/apps/luvex-website
docker-compose down
```

### Start Deployment

```bash
cd /opt/apps/luvex-website
docker-compose up -d
```

### Restart Services

```bash
docker-compose restart wordpress
docker-compose restart nginx
```

### Create Backup

```bash
# Database backup
docker exec luvex-mysql mysqldump -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE > backup-$(date +%Y%m%d-%H%M%S).sql

# WordPress files backup
docker exec luvex-wordpress tar -czf /tmp/wordpress-backup.tar.gz -C /var/www/html .
docker cp luvex-wordpress:/tmp/wordpress-backup.tar.gz ./backup-wordpress-$(date +%Y%m%d-%H%M%S).tar.gz
docker exec luvex-wordpress rm /tmp/wordpress-backup.tar.gz
```

## Success Criteria

After successful deployment and verification:

- ✅ All containers running (luvex-mysql, luvex-wordpress, luvex-nginx)
- ✅ Website accessible at https://luvex.tech
- ✅ Admin panel accessible at https://luvex.tech/wp-admin
- ✅ No network warnings in docker-compose output
- ✅ Database restored with all tables
- ✅ WordPress files restored (themes, plugins, uploads)
- ✅ All verification checks passed

## Infrastructure Feedback

After successful deployment, report to the infrastructure team:

```
✅ WordPress Fresh-Deploy erfolgreich!

- Path: /opt/apps/luvex-website
- Domain: https://luvex.tech
- Networks: luvex-network + db-shared (external: true)
- Volumes: luvex-website_mysql_data, luvex-website_wordpress_data,
          luvex-website_wordpress_uploads, luvex-website_wordpress_plugins
- Backup: Erfolgreich restored
- Status: Alle Checks grün
```

## Additional Resources

- [Docker Compose Documentation](https://docs.docker.com/compose/)
- [WordPress Docker Image](https://hub.docker.com/_/wordpress)
- [MySQL Docker Image](https://hub.docker.com/_/mysql)
- [Nginx Docker Image](https://hub.docker.com/_/nginx)
