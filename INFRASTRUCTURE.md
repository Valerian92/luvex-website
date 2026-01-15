# LUVEX.TECH - WordPress Infrastructure Documentation

## Deployment Information

**Deployment erfolgt über zentrale Infrastructure Scripts:**
```bash
cd /opt/infrastructure-ops
./master-deploy.sh
# Option 7: Luvex WordPress
```

**Logs anzeigen:**
```bash
cd /opt/infrastructure-ops
./backend-logs.sh
# Option 7: Luvex WordPress
```

---

## Architecture Overview

- **Deployment Path:** `/opt/apps/luvex-website`
- **Domain:** https://luvex.tech
- **Stack:** Nginx → WordPress → MySQL
- **SSL/TLS:** Terminiert durch Nginx Reverse Proxy

---

## Container Configuration

### 1. MySQL Database (luvex-mysql)

**Image:** `mysql:8.0`

**Container Name:** `luvex-mysql`

**Environment Variables:**
```
MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD}
MYSQL_DATABASE=${MYSQL_DATABASE}
MYSQL_USER=${MYSQL_USER}
MYSQL_PASSWORD=${MYSQL_PASSWORD}
```

**Volumes:**
- `mysql_data:/var/lib/mysql` - Database persistent storage

**Networks:**
- `db-shared` (external) - Shared database access
- `luvex-network` (external) - Internal WordPress stack

**Health Check:**
```bash
mysqladmin ping -h localhost -u root -p${MYSQL_ROOT_PASSWORD}
```

**Restart Policy:** `unless-stopped`

---

### 2. WordPress Application (luvex-wordpress)

**Image:** `wordpress:6.4-php8.2-fpm`

**Container Name:** `luvex-wordpress`

**Dependencies:**
- `luvex-mysql` (database must be healthy)

**Environment Variables:**
```
WORDPRESS_DB_HOST=luvex-mysql:3306
WORDPRESS_DB_USER=${MYSQL_USER}
WORDPRESS_DB_PASSWORD=${MYSQL_PASSWORD}
WORDPRESS_DB_NAME=${MYSQL_DATABASE}
WORDPRESS_TABLE_PREFIX=${WP_TABLE_PREFIX:-wp_}
WORDPRESS_DEBUG=${WP_DEBUG:-false}
```

**Volumes:**
- `wordpress_data:/var/www/html` - WordPress core files
- `wordpress_uploads:/var/www/html/wp-content/uploads` - Media uploads
- `wordpress_plugins:/var/www/html/wp-content/plugins` - WordPress plugins

**Networks:**
- `luvex-network` (external) - Internal WordPress stack

**Restart Policy:** `unless-stopped`

---

### 3. Nginx Reverse Proxy (luvex-nginx)

**Image:** `nginx:alpine`

**Container Name:** `luvex-nginx`

**Dependencies:**
- `luvex-wordpress` (WordPress must be running)

**Ports:**
- `80:80` - HTTP (redirects to HTTPS)
- `443:443` - HTTPS

**Volumes:**
- `./nginx/nginx.conf:/etc/nginx/nginx.conf:ro` - Nginx configuration
- `./nginx/ssl:/etc/nginx/ssl:ro` - SSL certificates
- `wordpress_data:/var/www/html:ro` - WordPress files (read-only)

**Networks:**
- `luvex-network` (external) - Internal WordPress stack

**Restart Policy:** `unless-stopped`

---

## Docker Networks

### luvex-network
- **Type:** External
- **Purpose:** Internal communication between WordPress, MySQL, and Nginx
- **Creation:** `docker network create luvex-network`

### db-shared
- **Type:** External
- **Purpose:** Shared database access for external applications (e.g., UV Simulation Student App)
- **Creation:** `docker network create db-shared`

**Important:** Both networks MUST be created before deployment and configured as `external: true` in docker-compose.yml to avoid warnings.

---

## Docker Volumes

All volumes are Docker-managed (not bind mounts):

- `luvex-website_mysql_data` - MySQL database files
- `luvex-website_wordpress_data` - WordPress core installation
- `luvex-website_wordpress_uploads` - Media library uploads
- `luvex-website_wordpress_plugins` - Installed WordPress plugins

**List volumes:**
```bash
docker volume ls | grep luvex-website
```

**Inspect volume:**
```bash
docker volume inspect luvex-website_mysql_data
docker volume inspect luvex-website_wordpress_data
```

---

## Environment Variables

All environment variables are stored in `.env` file:

```env
# MySQL Configuration
MYSQL_ROOT_PASSWORD=<secure-root-password>
MYSQL_DATABASE=luvex_production
MYSQL_USER=wordpress
MYSQL_PASSWORD=<secure-user-password>

# WordPress Configuration
WP_TABLE_PREFIX=wp_
WP_DEBUG=false
```

**Security Note:** `.env` file is gitignored and must be created manually on deployment server.

---

## External Services

**None** - WordPress is fully self-contained with local MySQL database.

**Database Sharing:**
- MySQL is accessible via `db-shared` network for external apps
- Connection: `luvex-mysql:3306`
- Credentials: Same as `MYSQL_USER` and `MYSQL_PASSWORD`

---

## Health Checks

### Container Status
```bash
docker ps | grep -E "(luvex-mysql|luvex-wordpress|luvex-nginx)"
```

All three containers should show "Up" status.

### Database Connectivity
```bash
docker exec luvex-mysql mysql -u root -p${MYSQL_ROOT_PASSWORD} -e "SHOW DATABASES;"
```

Should list databases including the WordPress database.

### WordPress Tables
```bash
docker exec luvex-mysql mysql -u root -p${MYSQL_ROOT_PASSWORD} -e "USE ${MYSQL_DATABASE}; SHOW TABLES;"
```

Should show WordPress tables (wp_posts, wp_users, etc.).

### Website Accessibility
```bash
curl -I https://luvex.tech
```

Should return HTTP 200 or 301/302.

### WordPress Files
```bash
docker exec luvex-wordpress ls -lh /var/www/html/
```

Should show WordPress core files (wp-config.php, index.php, wp-content/, etc.).

### Uploads Directory
```bash
docker exec luvex-wordpress ls -lh /var/www/html/wp-content/uploads/
```

Should show upload directories (organized by year/month).

### Themes and Plugins
```bash
docker exec luvex-wordpress ls -1 /var/www/html/wp-content/themes/
docker exec luvex-wordpress ls -1 /var/www/html/wp-content/plugins/
```

Should list installed themes and plugins.

---

## Backup and Restore

### Creating Backups

#### Database Backup
```bash
# Using root credentials
docker exec luvex-mysql mysqldump -u root -p${MYSQL_ROOT_PASSWORD} ${MYSQL_DATABASE} > backup-$(date +%Y%m%d-%H%M%S).sql

# Using regular user credentials
docker exec luvex-mysql mysqldump -u ${MYSQL_USER} -p${MYSQL_PASSWORD} ${MYSQL_DATABASE} > backup-$(date +%Y%m%d-%H%M%S).sql
```

#### WordPress Files Backup
```bash
# Full WordPress backup
docker exec luvex-wordpress tar -czf /tmp/wordpress-backup.tar.gz -C /var/www/html .
docker cp luvex-wordpress:/tmp/wordpress-backup.tar.gz ./backup-wordpress-$(date +%Y%m%d-%H%M%S).tar.gz
docker exec luvex-wordpress rm /tmp/wordpress-backup.tar.gz

# Uploads only backup
docker exec luvex-wordpress tar -czf /tmp/uploads-backup.tar.gz -C /var/www/html/wp-content/uploads .
docker cp luvex-wordpress:/tmp/uploads-backup.tar.gz ./backup-uploads-$(date +%Y%m%d-%H%M%S).tar.gz
docker exec luvex-wordpress rm /tmp/uploads-backup.tar.gz
```

### Restoring from Backup

#### Database Restore
```bash
# Using root credentials
cat /path/to/backup-database.sql | docker exec -i luvex-mysql mysql -u root -p${MYSQL_ROOT_PASSWORD}

# Using regular user credentials
cat /path/to/backup-database.sql | docker exec -i luvex-mysql mysql -u ${MYSQL_USER} -p${MYSQL_PASSWORD} ${MYSQL_DATABASE}
```

#### WordPress Files Restore
```bash
# Copy backup to container
docker cp /path/to/backup-wordpress.tar.gz luvex-wordpress:/tmp/

# Extract and set permissions
docker exec luvex-wordpress tar -xzf /tmp/backup-wordpress.tar.gz -C /var/www/html/
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/
docker exec luvex-wordpress rm /tmp/backup-wordpress.tar.gz
```

#### Uploads Restore (if separate backup)
```bash
docker cp /path/to/backup-uploads.tar.gz luvex-wordpress:/tmp/
docker exec luvex-wordpress tar -xzf /tmp/backup-uploads.tar.gz -C /var/www/html/wp-content/uploads/
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/wp-content/uploads/
docker exec luvex-wordpress rm /tmp/backup-uploads.tar.gz
```

---

## Troubleshooting

### Problem: Containers Not Starting

**Check logs:**
```bash
docker logs luvex-mysql --tail 100
docker logs luvex-wordpress --tail 100
docker logs luvex-nginx --tail 100
```

**Common causes:**
- Missing environment variables in `.env`
- Port conflicts (80/443 already in use)
- Missing external networks (luvex-network, db-shared)

### Problem: Database Connection Failed

**Symptoms:** WordPress shows "Error establishing database connection"

**Checks:**
```bash
# Verify MySQL is running
docker ps | grep luvex-mysql

# Test database connection
docker exec luvex-mysql mysql -u ${MYSQL_USER} -p${MYSQL_PASSWORD} -e "USE ${MYSQL_DATABASE}; SELECT 1;"

# Check environment variables
docker exec luvex-wordpress env | grep WORDPRESS_DB
```

**Solutions:**
- Verify `MYSQL_USER` and `MYSQL_PASSWORD` in `.env`
- Ensure database exists: `SHOW DATABASES;`
- Wait for MySQL to fully start (can take 30-60 seconds)

### Problem: Website Shows 502 Bad Gateway

**Symptoms:** Nginx returns 502 error

**Checks:**
```bash
# Verify WordPress container is running
docker ps | grep luvex-wordpress

# Check Nginx upstream configuration
docker exec luvex-nginx cat /etc/nginx/nginx.conf | grep upstream

# Test direct WordPress-FPM connection
docker exec luvex-nginx nc -zv luvex-wordpress 9000
```

**Solutions:**
- Restart WordPress: `docker-compose restart wordpress`
- Check PHP-FPM is listening: `docker exec luvex-wordpress netstat -ln | grep 9000`
- Verify WordPress container health

### Problem: SSL/TLS Certificate Errors

**Symptoms:** Browser shows certificate warnings

**Checks:**
```bash
# Verify SSL certificates exist
docker exec luvex-nginx ls -lh /etc/nginx/ssl/

# Check certificate validity
docker exec luvex-nginx openssl x509 -in /etc/nginx/ssl/luvex.tech.crt -noout -dates

# Test SSL configuration
docker exec luvex-nginx nginx -t
```

**Solutions:**
- Renew SSL certificates if expired
- Verify certificate files are mounted correctly
- Check Nginx SSL configuration in nginx.conf

### Problem: Permission Denied Errors

**Symptoms:** WordPress can't write files (uploads, plugins, themes)

**Checks:**
```bash
# Check file ownership
docker exec luvex-wordpress ls -lh /var/www/html/wp-content/

# Check current user
docker exec luvex-wordpress whoami
```

**Solutions:**
```bash
# Fix all WordPress permissions
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/

# Fix directory permissions
docker exec luvex-wordpress find /var/www/html -type d -exec chmod 755 {} \;

# Fix file permissions
docker exec luvex-wordpress find /var/www/html -type f -exec chmod 644 {} \;
```

### Problem: Network Warnings on Startup

**Symptoms:**
```
WARN[0000] a network with name luvex-network exists but was not created for project
```

**Check configuration:**
```bash
# Verify networks are marked as external
grep -A 5 "^networks:" docker-compose.yml
```

**Should show:**
```yaml
networks:
  luvex-network:
    external: true
    name: luvex-network
  db-shared:
    external: true
    name: db-shared
```

**Solutions:**
- Ensure `external: true` is set for both networks
- Verify networks exist: `docker network ls | grep luvex`
- Create if missing: `docker network create luvex-network`

### Problem: High Memory Usage

**Symptoms:** Server running out of memory

**Checks:**
```bash
# Check container resource usage
docker stats --no-stream

# Check MySQL memory
docker exec luvex-mysql mysql -u root -p${MYSQL_ROOT_PASSWORD} -e "SHOW VARIABLES LIKE 'innodb_buffer_pool_size';"
```

**Solutions:**
- Adjust MySQL memory settings in docker-compose.yml
- Enable WordPress caching plugin
- Optimize database queries
- Consider upgrading server resources

### Problem: Database Is Corrupted

**Symptoms:** MySQL crashes or shows corruption errors

**Checks:**
```bash
# Check MySQL error log
docker logs luvex-mysql --tail 200 | grep -i error

# Check database tables
docker exec luvex-mysql mysqlcheck -u root -p${MYSQL_ROOT_PASSWORD} --all-databases
```

**Solutions:**
```bash
# Repair tables
docker exec luvex-mysql mysqlcheck -u root -p${MYSQL_ROOT_PASSWORD} --auto-repair --all-databases

# If severely corrupted, restore from backup
cat /path/to/backup.sql | docker exec -i luvex-mysql mysql -u root -p${MYSQL_ROOT_PASSWORD}
```

---

## Monitoring and Logs

### View Real-time Logs

**All services:**
```bash
cd /opt/apps/luvex-website
docker-compose logs -f
```

**Specific service:**
```bash
docker logs -f luvex-mysql
docker logs -f luvex-wordpress
docker logs -f luvex-nginx
```

**Via Infrastructure Scripts:**
```bash
cd /opt/infrastructure-ops
./backend-logs.sh
# Option 7: Luvex WordPress
```

### Log Locations

**MySQL logs:**
- Container: `/var/log/mysql/`
- Docker logs: `docker logs luvex-mysql`

**WordPress logs:**
- Container: `/var/www/html/wp-content/debug.log` (if WP_DEBUG=true)
- Docker logs: `docker logs luvex-wordpress`

**Nginx logs:**
- Container: `/var/log/nginx/access.log` and `/var/log/nginx/error.log`
- Docker logs: `docker logs luvex-nginx`

---

## Performance Optimization

### WordPress Caching

Consider installing caching plugins:
- WP Super Cache
- W3 Total Cache
- Redis Object Cache (requires separate Redis container)

### Database Optimization

```bash
# Optimize all tables
docker exec luvex-mysql mysqlcheck -u root -p${MYSQL_ROOT_PASSWORD} --optimize --all-databases

# Clean up old revisions (via wp-cli if installed)
docker exec luvex-wordpress wp post delete $(wp post list --post_type='revision' --format=ids) --force
```

### Image Optimization

- Install image optimization plugins (Smush, ShortPixel)
- Use WebP format for images
- Implement lazy loading

---

## Security Considerations

### Database Security

- Strong passwords in `.env` file
- No root access from external networks
- Regular security updates for MySQL image

### WordPress Security

- Keep WordPress, themes, and plugins updated
- Use security plugins (Wordfence, Sucuri)
- Disable XML-RPC if not needed
- Limit login attempts
- Use strong admin passwords

### Nginx Security

- SSL/TLS only (no plain HTTP)
- Security headers configured
- Rate limiting enabled
- Regular certificate renewal

### File Permissions

```bash
# Recommended permissions
docker exec luvex-wordpress find /var/www/html -type d -exec chmod 755 {} \;
docker exec luvex-wordpress find /var/www/html -type f -exec chmod 644 {} \;
docker exec luvex-wordpress chmod 600 /var/www/html/wp-config.php
```

---

## Useful Commands

### Restart Services
```bash
docker-compose restart wordpress
docker-compose restart mysql
docker-compose restart nginx
```

### Stop All Services
```bash
cd /opt/apps/luvex-website
docker-compose down
```

### Start All Services
```bash
cd /opt/apps/luvex-website
docker-compose up -d
```

### Access Container Shell
```bash
docker exec -it luvex-wordpress bash
docker exec -it luvex-mysql bash
docker exec -it luvex-nginx sh
```

### Database Access
```bash
docker exec -it luvex-mysql mysql -u root -p${MYSQL_ROOT_PASSWORD}
```

### Clear WordPress Cache
```bash
docker exec luvex-wordpress rm -rf /var/www/html/wp-content/cache/*
```

---

## Integration with Infrastructure

This WordPress deployment is managed by central infrastructure scripts:

- **Deployment:** `/opt/infrastructure-ops/master-deploy.sh` (Option 7)
- **Logs:** `/opt/infrastructure-ops/backend-logs.sh` (Option 7)
- **Monitoring:** Integrated with infrastructure monitoring
- **Backups:** Automated via infrastructure backup scripts

For infrastructure-related issues, consult the infrastructure-ops repository documentation.

---

## Maintenance Schedule

### Daily
- Monitor container health via infrastructure scripts
- Check disk space usage

### Weekly
- Review application logs for errors
- Check for WordPress/plugin updates

### Monthly
- Create full backup (database + files)
- Review and optimize database
- Check SSL certificate expiry
- Security audit (updates, vulnerabilities)

### Quarterly
- Performance optimization review
- Capacity planning review
- Disaster recovery test

---

## Support and Contacts

For infrastructure issues, contact the Infrastructure Team via the infrastructure-ops repository.

For WordPress-specific issues:
1. Check this documentation first
2. Review container logs
3. Test health checks
4. Contact infrastructure team with findings
