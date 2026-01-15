# WordPress Migration: Bitnami to Docker

**Complete step-by-step guide for migrating WordPress from Bitnami to Docker**

---

## 📋 Overview

This guide walks you through:
- **Source:** Bitnami WordPress (Ubuntu Server, Google Marketplace)
- **Target:** Docker-based WordPress Stack (luvex-website)
- **Time Required:** 1-2 hours
- **Difficulty:** Intermediate

**What Changes:**
```
Bitnami Stack                    →    Docker Stack
├── Apache/Nginx                 →    Nginx (Container: luvex-nginx)
├── PHP                          →    PHP 8.2-FPM (Container: luvex-wordpress)
├── MySQL/MariaDB                →    MySQL 8.0 (Container: luvex-mysql)
└── WordPress Files              →    WordPress 6.4 (Container volumes)
```

---

## ✅ Pre-Migration Checklist

### Required Access
- [ ] SSH access to Bitnami server
- [ ] SSH access to Docker VPS server
- [ ] WordPress admin credentials
- [ ] Sufficient disk space (2x current site size)

### Required Information (Gather from Bitnami)

```bash
# 1. Database credentials from wp-config.php
cat /opt/bitnami/wordpress/wp-config.php | grep "^define('DB"

# 2. Site URL
cat /opt/bitnami/wordpress/wp-config.php | grep WP_SITEURL

# 3. Database size
mysql -u root -p -e "SELECT table_schema AS 'Database', \
  ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS 'Size (MB)' \
  FROM information_schema.tables \
  WHERE table_schema='bitnami_wordpress';"

# 4. WordPress files size
du -sh /opt/bitnami/wordpress/
```

**Write down these values:**
- Database Name: `____________________`
- Database User: `____________________`
- Database Password: `____________________`
- Old Domain: `____________________`
- New Domain: `luvex.tech`

---

## 📦 Step 1: Create Backup (Bitnami Server)

### 1.1 Export Database

```bash
# SSH to Bitnami server
ssh bitnami@YOUR_BITNAMI_IP

# Navigate to home directory
cd ~

# Export database (replace bitnami_wordpress with your actual DB name)
mysqldump -u root -p bitnami_wordpress > luvex-backup-$(date +%Y%m%d-%H%M%S).sql

# Verify backup
ls -lh luvex-backup-*.sql
head -20 luvex-backup-*.sql
# Should show: -- MySQL dump 10.13  Distrib...

# Compress for faster transfer
gzip luvex-backup-*.sql
```

**✓ Checkpoint:** You should now have `luvex-backup-YYYYMMDD-HHMMSS.sql.gz` in your home directory.

### 1.2 Export WordPress Files

```bash
# Still on Bitnami server
cd /opt/bitnami

# Create tar.gz of WordPress directory
tar -czf ~/luvex-files-$(date +%Y%m%d-%H%M%S).tar.gz wordpress/

# Verify backup
ls -lh ~/luvex-files-*.tar.gz

# Test archive integrity
tar -tzf ~/luvex-files-*.tar.gz | head -20
```

**✓ Checkpoint:** You should now have `luvex-files-YYYYMMDD-HHMMSS.tar.gz` in your home directory.

### 1.3 Transfer Backups to Docker Server

**From your local machine:**

```bash
# Download from Bitnami server
scp bitnami@BITNAMI_IP:~/luvex-backup-*.sql.gz ./
scp bitnami@BITNAMI_IP:~/luvex-files-*.tar.gz ./

# Upload to Docker server
scp luvex-backup-*.sql.gz root@DOCKER_SERVER_IP:/tmp/
scp luvex-files-*.tar.gz root@DOCKER_SERVER_IP:/tmp/
```

**Alternative: Direct transfer (faster)**

```bash
# On Docker server
ssh root@DOCKER_SERVER_IP

# Pull directly from Bitnami
scp bitnami@BITNAMI_IP:~/luvex-backup-*.sql.gz /tmp/
scp bitnami@BITNAMI_IP:~/luvex-files-*.tar.gz /tmp/

# Verify files
ls -lh /tmp/luvex-*
```

**✓ Checkpoint:** Backup files are now on Docker server in `/tmp/`

---

## 🐳 Step 2: Prepare Docker Environment

### 2.1 Verify Docker Setup

```bash
# SSH to Docker server
ssh root@DOCKER_SERVER_IP

# Check Docker
docker --version
docker-compose --version
docker ps

# Navigate to deployment directory
cd /opt/apps/luvex-website
```

### 2.2 Create External Networks

```bash
# Create required networks
docker network create luvex-network 2>/dev/null || echo "✓ luvex-network exists"
docker network create db-shared 2>/dev/null || echo "✓ db-shared exists"

# Verify
docker network ls | grep -E "(luvex-network|db-shared)"
```

**✓ Checkpoint:** Both networks should be listed.

### 2.3 Configure Environment Variables

```bash
cd /opt/apps/luvex-website

# Copy example to .env
cp .env.example .env

# Generate secure passwords
echo "=== COPY THESE PASSWORDS ==="
echo "Root Password: $(openssl rand -base64 32)"
echo "User Password: $(openssl rand -base64 32)"
echo "==========================="

# Edit .env
nano .env
```

**Update these values in `.env`:**

```env
# IMPORTANT: Use YOUR database name from Bitnami backup
MYSQL_DATABASE=bitnami_wordpress    # ← Replace with your actual DB name!

# Use generated passwords from above
MYSQL_ROOT_PASSWORD=<paste-generated-root-password>
MYSQL_PASSWORD=<paste-generated-user-password>

# Keep these as-is
MYSQL_USER=wordpress
WP_TABLE_PREFIX=wp_
WP_DEBUG=false
```

**Save and exit** (Ctrl+X, Y, Enter in nano)

```bash
# Set secure permissions
chmod 600 .env

# Verify
ls -l .env
# Should show: -rw------- (600)
```

**✓ Checkpoint:** `.env` file is configured with your database name and secure passwords.

### 2.4 Start Docker Containers

```bash
cd /opt/apps/luvex-website

# Start containers
docker-compose up -d

# Wait for MySQL to initialize (important!)
echo "Waiting 60 seconds for MySQL to be ready..."
sleep 60

# Check containers
docker ps | grep luvex
```

**Expected output:**
```
luvex-mysql       Up 1 minute (healthy)
luvex-wordpress   Up 1 minute
luvex-nginx       Up 1 minute
```

**✓ Checkpoint:** All three containers are running.

---

## 💾 Step 3: Restore Database

### 3.1 Prepare Database

```bash
# Source .env to load passwords
cd /opt/apps/luvex-website
source .env

# Create database and user
docker exec luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD <<EOF
CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';
GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'%';
FLUSH PRIVILEGES;
EOF

# Verify database exists
docker exec luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD -e "SHOW DATABASES;" | grep $MYSQL_DATABASE
```

**✓ Checkpoint:** Database is created.

### 3.2 Import Backup

```bash
# Decompress backup
cd /tmp
gunzip luvex-backup-*.sql.gz

# Import database (this may take several minutes)
echo "Importing database... (this may take a while)"
cat luvex-backup-*.sql | docker exec -i luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE

# Check for errors
echo $?
# Should print: 0 (success)
```

**✓ Checkpoint:** Database import completed without errors.

### 3.3 Verify Import

```bash
# Check tables exist
docker exec luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD -e "USE $MYSQL_DATABASE; SHOW TABLES;"

# Should show WordPress tables:
# wp_commentmeta
# wp_comments
# wp_options
# wp_postmeta
# wp_posts
# wp_terms
# wp_termmeta
# wp_term_relationships
# wp_term_taxonomy
# wp_usermeta
# wp_users

# Check row counts
docker exec luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD -e "
USE $MYSQL_DATABASE;
SELECT 'posts' AS table_name, COUNT(*) AS rows FROM wp_posts
UNION ALL SELECT 'users', COUNT(*) FROM wp_users
UNION ALL SELECT 'options', COUNT(*) FROM wp_options;
"
```

**✓ Checkpoint:** All WordPress tables exist with data.

---

## 📁 Step 4: Restore WordPress Files

### 4.1 Extract Backup

```bash
# Create temp extraction directory
mkdir -p /tmp/wordpress-extract
cd /tmp/wordpress-extract

# Extract backup
tar -xzf /tmp/luvex-files-*.tar.gz

# Verify extraction
ls -lah wordpress/
# Should show: wp-admin/, wp-content/, wp-includes/, etc.
```

### 4.2 Copy Files to Container

**Option A: Copy only wp-content (recommended)**

This preserves themes, plugins, and uploads while using the fresh WordPress core from Docker:

```bash
# Copy wp-content directory
docker cp /tmp/wordpress-extract/wordpress/wp-content luvex-wordpress:/var/www/html/

# Verify
docker exec luvex-wordpress ls -lah /var/www/html/wp-content/
```

**Option B: Copy everything (if you have customizations)**

```bash
# Stop WordPress container first
docker-compose stop wordpress

# Copy all files
docker cp /tmp/wordpress-extract/wordpress/. luvex-wordpress:/var/www/html/

# Start WordPress container
docker-compose start wordpress
```

**✓ Checkpoint:** Files are copied to container.

### 4.3 Fix Permissions

```bash
# Set correct ownership
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/

# Set directory permissions
docker exec luvex-wordpress find /var/www/html -type d -exec chmod 755 {} \;

# Set file permissions
docker exec luvex-wordpress find /var/www/html -type f -exec chmod 644 {} \;

# Secure wp-config.php
docker exec luvex-wordpress chmod 600 /var/www/html/wp-config.php

# Verify
docker exec luvex-wordpress ls -lah /var/www/html/ | head -10
# Should show: drwxr-xr-x www-data www-data
```

**✓ Checkpoint:** Permissions are set correctly.

### 4.4 Verify Files

```bash
# Check themes
docker exec luvex-wordpress ls -1 /var/www/html/wp-content/themes/

# Check plugins
docker exec luvex-wordpress ls -1 /var/www/html/wp-content/plugins/

# Check uploads
docker exec luvex-wordpress ls -1 /var/www/html/wp-content/uploads/

# Count upload files
docker exec luvex-wordpress find /var/www/html/wp-content/uploads -type f | wc -l
```

**✓ Checkpoint:** Themes, plugins, and uploads are present.

---

## ⚙️ Step 5: Update Configuration

### 5.1 Update wp-config.php

The wp-config.php from Bitnami has hardcoded values. We need to update it:

```bash
# Edit wp-config.php
docker exec -it luvex-wordpress nano /var/www/html/wp-config.php
```

**Find and replace these lines:**

```php
// OLD (Bitnami values):
define('DB_NAME', 'bitnami_wordpress');
define('DB_USER', 'bn_wordpress');
define('DB_PASSWORD', 'old_password');
define('DB_HOST', 'localhost');

// NEW (Docker values - get from .env):
define('DB_NAME', 'bitnami_wordpress');        // Keep the same as backup!
define('DB_USER', 'wordpress');                // From .env
define('DB_PASSWORD', 'your_new_password');    // From .env MYSQL_PASSWORD
define('DB_HOST', 'luvex-mysql:3306');         // Docker container name
```

**Or use environment variables (better):**

```php
define('DB_NAME', getenv('WORDPRESS_DB_NAME'));
define('DB_USER', getenv('WORDPRESS_DB_USER'));
define('DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD'));
define('DB_HOST', getenv('WORDPRESS_DB_HOST'));
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
```

**Save and exit** (Ctrl+X, Y, Enter)

**✓ Checkpoint:** wp-config.php is updated with new database credentials.

### 5.2 Update WordPress Salts

Generate new security salts:

```bash
# Get new salts from WordPress API
curl https://api.wordpress.org/secret-key/1.1/salt/
```

Copy the output and paste into wp-config.php, replacing the existing AUTH_KEY, SECURE_AUTH_KEY, etc. lines.

```bash
# Edit wp-config.php again
docker exec -it luvex-wordpress nano /var/www/html/wp-config.php

# Replace the section between:
# /**#@+
# * Authentication Unique Keys and Salts.
# ...
# /**#@-*/

# With the new salts from API
```

**✓ Checkpoint:** WordPress salts are updated.

### 5.3 Update Site URLs

If your domain changed (e.g., from old-domain.com to luvex.tech):

**Check current URL:**
```bash
docker exec luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE -e "
SELECT option_value FROM wp_options WHERE option_name IN ('siteurl', 'home');
"
```

**Update URLs:**
```bash
# Replace OLD_DOMAIN with your old domain, or use the URL shown above
docker exec luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE -e "
UPDATE wp_options SET option_value='https://luvex.tech' WHERE option_name='siteurl';
UPDATE wp_options SET option_value='https://luvex.tech' WHERE option_name='home';
"

# Verify
docker exec luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE -e "
SELECT option_name, option_value FROM wp_options WHERE option_name IN ('siteurl', 'home');
"
```

**If you have WP-CLI (advanced):**
```bash
# Search and replace ALL occurrences of old domain
docker exec luvex-wordpress wp search-replace \
  'http://old-domain.com' 'https://luvex.tech' \
  --allow-root --skip-columns=guid

docker exec luvex-wordpress wp search-replace \
  'https://old-domain.com' 'https://luvex.tech' \
  --allow-root --skip-columns=guid
```

**✓ Checkpoint:** Site URLs are updated to luvex.tech.

### 5.4 Clear Caches

```bash
# Remove cache files
docker exec luvex-wordpress rm -rf /var/www/html/wp-content/cache/* 2>/dev/null || true
docker exec luvex-wordpress rm -rf /var/www/html/wp-content/uploads/cache/* 2>/dev/null || true

# If you have WP-CLI:
docker exec luvex-wordpress wp cache flush --allow-root 2>/dev/null || true
docker exec luvex-wordpress wp transient delete --all --allow-root 2>/dev/null || true
```

### 5.5 Restart Containers

```bash
cd /opt/apps/luvex-website
docker-compose restart

# Wait for services to be ready
echo "Waiting 30 seconds for services..."
sleep 30

# Check status
docker ps | grep luvex
```

**✓ Checkpoint:** All containers restarted successfully.

---

## ✅ Step 6: Verify Migration

### 6.1 Container Health

```bash
# All containers should be "Up"
docker ps --filter "name=luvex" --format "table {{.Names}}\t{{.Status}}"

# Check logs for errors
docker logs luvex-mysql --tail 30
docker logs luvex-wordpress --tail 30
docker logs luvex-nginx --tail 30
```

### 6.2 Website Accessibility

```bash
# Test HTTP response
curl -I http://localhost
# or if DNS is updated:
curl -I https://luvex.tech

# Test homepage content
curl -s http://localhost | grep "<title>"
# Should show your site title
```

### 6.3 WordPress Admin Login

1. Open browser: `https://luvex.tech/wp-admin` (or `http://SERVER_IP/wp-admin`)
2. Log in with your existing WordPress admin credentials
3. Dashboard should load without errors

**If login fails:**
```bash
# Reset admin password
docker exec luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE -e "
UPDATE wp_users SET user_pass=MD5('NewPassword123!') WHERE user_login='admin';
"

# Or with WP-CLI:
docker exec luvex-wordpress wp user update admin \
  --user_pass='NewPassword123!' \
  --allow-root
```

### 6.4 Content Verification Checklist

In WordPress admin, verify:

- [ ] Dashboard loads without errors
- [ ] Posts → All Posts shows your posts
- [ ] Pages → All Pages shows your pages
- [ ] Media Library shows images
- [ ] Media Library images load (click to view)
- [ ] Appearance → Themes shows active theme
- [ ] Plugins → Installed Plugins shows all plugins
- [ ] Users → All Users shows all users
- [ ] Settings → General shows correct Site URL

On frontend (visit `https://luvex.tech`):

- [ ] Homepage loads correctly
- [ ] Images display properly
- [ ] Navigation menus work
- [ ] Internal links work
- [ ] Search functionality works
- [ ] Contact forms work (if applicable)
- [ ] Mobile layout works

**✓ Checkpoint:** All verifications passed!

---

## 🎯 Step 7: Final Steps

### 7.1 Create Fresh Backup

```bash
cd /opt/apps/luvex-website

# Database backup
docker exec luvex-mysql mysqldump -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE > /backup/luvex-migrated-$(date +%Y%m%d).sql

# Files backup
docker exec luvex-wordpress tar -czf /tmp/wordpress-backup.tar.gz -C /var/www/html .
docker cp luvex-wordpress:/tmp/wordpress-backup.tar.gz /backup/luvex-files-migrated-$(date +%Y%m%d).tar.gz
docker exec luvex-wordpress rm /tmp/wordpress-backup.tar.gz
```

### 7.2 Update DNS (if not done)

Point your domain to the new Docker server:

**In your domain registrar/DNS provider:**
- Update A Record: `luvex.tech` → `NEW_SERVER_IP`
- Update A Record: `www.luvex.tech` → `NEW_SERVER_IP`

DNS propagation can take 1-48 hours.

### 7.3 Security Updates

```bash
# Change WordPress admin password (via admin panel)
# Update all plugins (via admin panel)
# Update theme (via admin panel)

# Or with WP-CLI:
docker exec luvex-wordpress wp core update --allow-root
docker exec luvex-wordpress wp plugin update --all --allow-root
docker exec luvex-wordpress wp theme update --all --allow-root
```

### 7.4 Test SSL/HTTPS

Once DNS is propagated:

```bash
curl -I https://luvex.tech
# Should show: HTTP/2 200 OK

# Verify redirect HTTP → HTTPS
curl -I http://luvex.tech
# Should show: 301 Moved Permanently
# Location: https://luvex.tech
```

### 7.5 Cleanup

```bash
# Remove backup files from temp
rm -rf /tmp/wordpress-extract
rm /tmp/luvex-backup-*.sql
rm /tmp/luvex-files-*.tar.gz

# Optional: Remove old MIGRATION_OLD.md.backup
cd /opt/apps/luvex-website
rm MIGRATION_OLD.md.backup
```

---

## 🔧 Troubleshooting

### Problem: "Error establishing database connection"

**Check database credentials:**
```bash
source .env
docker exec luvex-mysql mysql -u $MYSQL_USER -p$MYSQL_PASSWORD -e "SHOW DATABASES;"
```

**Verify wp-config.php:**
```bash
docker exec luvex-wordpress grep "^define('DB_" /var/www/html/wp-config.php
```

**Recreate user:**
```bash
source .env
docker exec luvex-mysql mysql -u root -p$MYSQL_ROOT_PASSWORD <<EOF
DROP USER IF EXISTS '$MYSQL_USER'@'%';
CREATE USER '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';
GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'%';
FLUSH PRIVILEGES;
EOF
```

### Problem: Images not loading (404 errors)

**Check uploads directory:**
```bash
docker exec luvex-wordpress ls -lah /var/www/html/wp-content/uploads/
docker exec luvex-wordpress find /var/www/html/wp-content/uploads -type f | wc -l
```

**Fix permissions:**
```bash
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/wp-content/uploads/
docker exec luvex-wordpress chmod -R 755 /var/www/html/wp-content/uploads/
```

### Problem: Permalinks broken (404 on posts)

**Flush rewrite rules:**
```bash
# With WP-CLI:
docker exec luvex-wordpress wp rewrite flush --allow-root

# Or via admin panel:
# Settings → Permalinks → Save Changes (no changes needed, just click Save)
```

### Problem: Plugins not working

**Reactivate plugins:**
```bash
# Deactivate all
docker exec luvex-wordpress wp plugin deactivate --all --allow-root

# Reactivate
docker exec luvex-wordpress wp plugin activate --all --allow-root

# Or selective activation:
docker exec luvex-wordpress wp plugin list --allow-root
docker exec luvex-wordpress wp plugin activate plugin-name --allow-root
```

---

## 📞 Getting Help

If you need assistance:

1. **Check logs:**
   ```bash
   docker logs luvex-mysql --tail 100
   docker logs luvex-wordpress --tail 100
   docker logs luvex-nginx --tail 100
   ```

2. **Use infrastructure scripts:**
   ```bash
   cd /opt/infrastructure-ops
   ./backend-logs.sh
   # Option 7: Luvex WordPress
   ```

3. **Review documentation:**
   - `INFRASTRUCTURE.md` - Complete infrastructure reference
   - `.env.example` - Environment variable documentation

---

## 🎉 Migration Complete!

**Congratulations!** Your WordPress site is now running on Docker.

**Benefits of Docker setup:**
- ✅ Better security (isolated containers)
- ✅ Easier backups (volume snapshots)
- ✅ Faster deployments (reproducible)
- ✅ Better resource management
- ✅ Easier scaling

**Next steps:**
- Set up automated backups
- Configure monitoring
- Install security plugins
- Optimize performance
- Decommission Bitnami server (after testing period)

**Keep the Bitnami server running for 1-2 weeks as a backup, then decommission it once you're confident everything works perfectly!**
