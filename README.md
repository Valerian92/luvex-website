# 🔬 LUVEX.TECH - UV Technology Website

> Professional WordPress theme with Docker-based deployment for LUVEX.TECH

---

## 🚀 Quick Start

### **For Developers (Local Development)**

```bash
# Clone repository
git clone https://github.com/Valerian92/luvex-website.git
cd luvex-website

# Setup environment
cp .env.example .env
nano .env  # Configure your credentials

# Start Docker containers
./deploy.sh start

# Check status
./deploy.sh status
```

### **For DevOps (Production Deployment)**

**📖 Read these first:**

1. **[DEPLOYMENT.md](./DEPLOYMENT.md)** - Complete deployment guide
2. **[MIGRATION.md](./MIGRATION.md)** - Migration checklist (Google Cloud → Hostinger)
3. **[SESSION_INFO.md](./SESSION_INFO.md)** - Quick reference for Claude Code sessions

**Deployment command:**
```bash
./deploy.sh deploy
```

---

## 📋 What's in this Repository?

### **WordPress Theme**
Custom WordPress theme for LUVEX.TECH with:
- ✅ Custom page templates
- ✅ Hero animations (Photons, Globe, Hexagons, UV Spectrum)
- ✅ Mobile-optimized navigation
- ✅ Professional footer with multiple menus
- ✅ UV technology-focused design

### **Docker Infrastructure**
Production-ready Docker setup:
- ✅ WordPress 6.4+ (PHP 8.2 FPM)
- ✅ MySQL 8.0
- ✅ Nginx (Reverse Proxy + SSL)
- ✅ Let's Encrypt SSL automation
- ✅ Automated backups
- ✅ Health checks

---

## 🏗️ Architecture

```
Host Nginx (srv1117211)
    ↓
Docker Nginx (Port 8080/8443)
    ↓
WordPress PHP-FPM (Port 9000)
    ↓
MySQL 8.0 (Port 3306)
```

**Isolated Docker Network:** Completely separated from other applications (e.g., Lunaria Shopify App)

---

## 📁 Repository Structure

```
luvex-website/
├── docker-compose.yml          # Docker orchestration
├── deploy.sh                   # Management script
├── .env.example                # Environment variables template
│
├── nginx/
│   └── luvex.conf             # Nginx production config
│
├── assets/
│   ├── css/                   # Stylesheets
│   ├── js/                    # JavaScript (hero animations, etc.)
│   └── images/                # Theme images
│
├── *.php                       # WordPress theme files
│   ├── functions.php          # Theme functions
│   ├── header.php             # Header template
│   ├── footer.php             # Footer template
│   ├── front-page.php         # Homepage
│   └── page-*.php             # Custom page templates
│
└── docs/
    ├── DEPLOYMENT.md          # Full deployment guide
    ├── MIGRATION.md           # Migration checklist
    └── SESSION_INFO.md        # Claude Code reference
```

---

## 🛠️ Management Commands

The `deploy.sh` script provides all essential operations:

### **Deployment**
```bash
./deploy.sh deploy              # Full deployment (backup + restart + health check)
./deploy.sh start               # Start containers
./deploy.sh stop                # Stop containers
./deploy.sh restart             # Restart containers
```

### **Monitoring**
```bash
./deploy.sh status              # Container status
./deploy.sh health              # Health checks
./deploy.sh logs                # View all logs
./deploy.sh logs wordpress      # WordPress logs only
```

### **Database**
```bash
./deploy.sh db-export           # Export database
./deploy.sh db-import file.sql  # Import database
./deploy.sh rollback            # Restore from backup
```

### **SSL**
```bash
./deploy.sh ssl-setup           # Setup Let's Encrypt certificate
```

**Full command list:**
```bash
./deploy.sh help
```

---

## 📚 Documentation

| Document | Purpose |
|----------|---------|
| **[DEPLOYMENT.md](./DEPLOYMENT.md)** | Complete deployment guide with architecture, troubleshooting, security |
| **[MIGRATION.md](./MIGRATION.md)** | Step-by-step migration checklist (Google Cloud → Hostinger) |
| **[SESSION_INFO.md](./SESSION_INFO.md)** | Quick reference for Claude Code (context for AI sessions) |

---

## 🔒 Security Features

✅ **Docker Security:**
- Alpine Linux images (minimal attack surface)
- Isolated network (no communication with other apps)
- Non-root containers
- Read-only mounts where possible

✅ **WordPress Hardening:**
- XML-RPC disabled
- Directory listing disabled
- PHP execution in uploads blocked
- wp-config.php protected

✅ **Nginx Security Headers:**
- HSTS (HTTP Strict Transport Security)
- X-Frame-Options (Clickjacking protection)
- X-Content-Type-Options (MIME sniffing protection)
- Content Security Policy (CSP)

✅ **SSL/TLS:**
- TLS 1.2 & 1.3 only
- Modern cipher suites (Mozilla Intermediate)
- OCSP Stapling

---

## 🌐 Production Server

**Host:** root@srv1117211 (Hostinger)
**Domain:** https://luvex.tech
**Location:** `/opt/apps/luvex-tech/`

**Shares server with:**
- Lunaria Shopify App (`/opt/apps/production/`) - completely isolated

---

## 🧪 Technology Stack

| Component | Version | Purpose |
|-----------|---------|---------|
| WordPress | 6.4+ | CMS |
| PHP | 8.2 FPM | Runtime |
| MySQL | 8.0 | Database |
| Nginx | Alpine | Webserver + Reverse Proxy |
| Docker | Latest | Containerization |
| Let's Encrypt | - | SSL Certificates |

---

## 📦 Theme Features

### **Hero Animations (Conditional Loading)**
- **Homepage:** Photon animation + 3D Globe (Three.js)
- **UV Curing:** Interactive particle animation
- **UV Consulting:** Hexagon network animation
- **UV-C Disinfection:** Virus particle animation
- **UV Knowledge:** UV spectrum visualization

### **Custom Page Templates**
- About, Contact, Booking
- UV Consulting, UV-C Disinfection, UV Curing
- LED UV Systems, Mercury UV Lamps
- Case Studies, Technical Papers, News

### **Responsive Navigation**
- Mobile menu with toggle
- Dropdown support
- Footer menus (Services, Technologies, Resources, Company, Legal)

---

## 🔧 Development

### **Local Setup**

```bash
# 1. Clone repo
git clone https://github.com/Valerian92/luvex-website.git
cd luvex-website

# 2. Configure environment
cp .env.example .env
nano .env

# 3. Start containers
./deploy.sh start

# 4. Access WordPress
# http://localhost:8080 (or configure custom domain)
```

### **Theme Development**

The theme is mounted as a **read-only volume** in Docker:
```yaml
volumes:
  - ./:/var/www/html/wp-content/themes/luvex:ro
```

**Changes to theme files are reflected immediately** (no rebuild needed).

### **CSS/JS Cache Busting**

The theme uses file modification time for cache busting:
```php
$version = filemtime($file_path);
wp_enqueue_style('luvex-main', $url, [], $version);
```

Changes to CSS/JS are automatically reflected (no manual version bumping).

---

## 📞 Support

**For deployment issues:**
1. Check `./deploy.sh logs`
2. Run `./deploy.sh health`
3. See [DEPLOYMENT.md](./DEPLOYMENT.md) → Troubleshooting section

**For migration help:**
- See [MIGRATION.md](./MIGRATION.md)

---

## 📄 License

Proprietary - LUVEX GmbH

---

**Version:** 1.0
**Last Updated:** 2025-01-12
**Maintained by:** Valerian92
