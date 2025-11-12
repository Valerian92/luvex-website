# 🚀 LUVEX.TECH - Production Deployment Guide

> **Für nachfolgende Sessions:** Dieses Dokument beschreibt die komplette Docker-basierte WordPress-Infrastruktur für luvex.tech

---

## 📋 Inhaltsverzeichnis

1. [Architektur-Übersicht](#architektur-übersicht)
2. [Technologie-Stack](#technologie-stack)
3. [Verzeichnis-Struktur](#verzeichnis-struktur)
4. [Erstmalige Installation](#erstmalige-installation)
5. [Migration von Google Cloud](#migration-von-google-cloud)
6. [Deploy-Script Kommandos](#deploy-script-kommandos)
7. [Troubleshooting](#troubleshooting)
8. [Wartung & Backups](#wartung--backups)
9. [Sicherheit](#sicherheit)

---

## 🏗️ Architektur-Übersicht

### **Gesamtbild: Server srv1117211**

```
srv1117211 (Hostinger/Hetzner)
│
├── /opt/apps/production/          ← Lunaria Shopify App (getrennt!)
│   ├── backend/ (Python Flask)
│   ├── docker-compose.yml
│   └── nginx.conf
│
└── /opt/apps/luvex-tech/          ← LUVEX.TECH (diese Installation)
    ├── docker-compose.yml
    ├── nginx/luvex.conf
    ├── deploy.sh
    └── .env
```

### **Docker-Architektur für LUVEX.TECH**

```
┌─────────────────────────────────────────────────────────────────┐
│  Host-Nginx (auf srv1117211)                                    │
│  ├── Port 80/443 → luvex.tech                                   │
│  └── Reverse Proxy → Docker Nginx (Port 8080/8443)              │
└─────────────────────────────────────────────────────────────────┘
                             │
                             ▼
┌─────────────────────────────────────────────────────────────────┐
│  Docker Network: luvex-network (isoliert von Lunaria!)          │
│                                                                  │
│  ┌──────────────┐      ┌──────────────┐      ┌──────────────┐  │
│  │   Nginx      │ ───▶ │  WordPress   │ ───▶ │    MySQL     │  │
│  │  (Alpine)    │      │  PHP 8.2 FPM │      │     8.0      │  │
│  │  Port 8080   │      │  Port 9000   │      │  Port 3306   │  │
│  │  Port 8443   │      │              │      │              │  │
│  └──────────────┘      └──────────────┘      └──────────────┘  │
│        │                      │                      │          │
│        │                      │                      │          │
│   ┌────▼──────────────────────▼──────────────────────▼────┐    │
│   │          Docker Volumes (Persistent Storage)          │    │
│   │  - wordpress_data  (WordPress Core)                   │    │
│   │  - wordpress_uploads  (Media Files)                   │    │
│   │  - wordpress_plugins  (Plugins)                       │    │
│   │  - mysql_data  (Database)                             │    │
│   └───────────────────────────────────────────────────────┘    │
└─────────────────────────────────────────────────────────────────┘
```

### **Wichtige Konzepte**

✅ **Isolation:** Luvex und Lunaria nutzen separate Docker Networks (keine Konflikte!)
✅ **Reverse Proxy:** Host-Nginx (Port 80/443) → Docker-Nginx (Port 8080/8443) → WordPress
✅ **Persistenz:** Alle wichtigen Daten (DB, Uploads, Plugins) in Docker Volumes
✅ **SSL/TLS:** Let's Encrypt Zertifikate auf Host-System (`/etc/letsencrypt`)

---

## 🛠️ Technologie-Stack

| Komponente | Version | Image | Zweck |
|------------|---------|-------|-------|
| **WordPress** | 6.4+ | `wordpress:6.4-php8.2-fpm-alpine` | CMS + PHP-FPM |
| **MySQL** | 8.0 | `mysql:8.0` | Datenbank |
| **Nginx** | Latest | `nginx:alpine` | Webserver + Reverse Proxy |
| **PHP** | 8.2 | (in WordPress Image) | WordPress Runtime |
| **Let's Encrypt** | - | `certbot/certbot` | SSL-Zertifikate |

### **Warum diese Wahl?**

- **Alpine Linux:** Minimal, sicher, schnell (< 50 MB Images)
- **PHP-FPM:** Bessere Performance als mod_php
- **MySQL 8.0:** Moderner, sicherer, schneller als MariaDB
- **Nginx:** Leichtgewichtig, perfekt für Reverse Proxy

---

## 📁 Verzeichnis-Struktur

```
/opt/apps/luvex-tech/
├── docker-compose.yml           # Docker Orchestrierung
├── .env                         # Environment Variables (NICHT ins Git!)
├── .env.example                 # Template für .env
├── deploy.sh                    # Deployment & Management Script
├── DEPLOYMENT.md                # Diese Dokumentation
│
├── nginx/
│   └── luvex.conf              # Nginx Production Config
│
├── backups/                     # Automatische Backups (DB + Files)
│   ├── luvex_db_20250112_120000.sql.gz
│   └── luvex_files_20250112_120000.tar.gz
│
├── wordpress/                   # WordPress Core (Docker Volume Mount)
│   ├── wp-config.php
│   ├── wp-content/
│   │   ├── themes/
│   │   │   └── luvex/          # Dieses Git-Repository (Theme)
│   │   ├── plugins/
│   │   └── uploads/
│   └── ...
│
└── .git/                        # Git Repository (nur Theme-Code!)
```

### **Was ist im Git?**

✅ **Im Repository:**
- Theme-Dateien (PHP, CSS, JS)
- Docker-Konfiguration (docker-compose.yml, nginx/luvex.conf)
- Scripts (deploy.sh)
- Dokumentation (DEPLOYMENT.md, README.md)

❌ **NICHT im Repository:**
- `.env` (Secrets!)
- `backups/` (Datenbank-Dumps)
- `wordpress/` (WordPress Core & Plugins)
- Docker Volumes

---

## 🚀 Erstmalige Installation

### **Schritt 1: Server vorbereiten**

```bash
# SSH auf Server
ssh root@srv1117211

# Verzeichnis erstellen
mkdir -p /opt/apps/luvex-tech
cd /opt/apps/luvex-tech

# Git Repository klonen
git clone https://github.com/Valerian92/luvex-website.git .

# Auf richtigen Branch wechseln
git checkout claude/migrate-luvex-hostinger-docker-011CV2PeVyo5eKuEDy254Mgo
```

### **Schritt 2: Environment Variables konfigurieren**

```bash
# .env erstellen
cp .env.example .env
nano .env
```

**Wichtig:** Sichere Passwörter generieren!

```bash
# Passwort generieren (32 Zeichen)
openssl rand -base64 32
```

Beispiel `.env`:
```env
MYSQL_ROOT_PASSWORD=xK9mP2nQ7wR4tY8uI5oL3aS6dF1gH0jK
MYSQL_DATABASE=luvex_production
MYSQL_USER=luvex_user
MYSQL_PASSWORD=zX8cV7bN6mM5qW3eR2tY9uI4oP1aS0dF

NGINX_HTTP_PORT=8080
NGINX_HTTPS_PORT=8443
WORDPRESS_TABLE_PREFIX=wp_
WORDPRESS_DEBUG=false
BACKUP_RETENTION_DAYS=7
```

**Rechte setzen:**
```bash
chmod 600 .env
```

### **Schritt 3: SSL-Zertifikat einrichten**

```bash
# Let's Encrypt Zertifikat holen
./deploy.sh ssl-setup
# Eingaben:
#   Domain: luvex.tech
#   Email: deine@email.com
```

**Voraussetzung:** DNS muss bereits auf die Server-IP zeigen!

### **Schritt 4: Erste Deployment**

```bash
# Deploy ausführen
./deploy.sh deploy

# Status prüfen
./deploy.sh status

# Health Check
./deploy.sh health

# Logs anschauen
./deploy.sh logs
```

### **Schritt 5: Host-Nginx konfigurieren**

Der Host-Nginx (außerhalb Docker) muss als Reverse Proxy konfiguriert werden:

```bash
# Nginx Config bearbeiten
nano /etc/nginx/sites-available/luvex.tech
```

**Beispiel Host-Nginx Config:**

```nginx
# /etc/nginx/sites-available/luvex.tech

server {
    listen 80;
    listen [::]:80;
    server_name luvex.tech www.luvex.tech;

    # Let's Encrypt ACME Challenge
    location /.well-known/acme-challenge/ {
        root /var/www/certbot;
    }

    # Redirect HTTP → HTTPS
    location / {
        return 301 https://$host$request_uri;
    }
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name luvex.tech www.luvex.tech;

    # SSL Certificates
    ssl_certificate /etc/letsencrypt/live/luvex.tech/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/luvex.tech/privkey.pem;

    # Reverse Proxy zu Docker-Nginx
    location / {
        proxy_pass https://localhost:8443;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

**Aktivieren & Reload:**

```bash
# Symlink erstellen
ln -s /etc/nginx/sites-available/luvex.tech /etc/nginx/sites-enabled/

# Nginx Syntax testen
nginx -t

# Nginx neu laden
systemctl reload nginx
```

---

## 🔄 Migration von Google Cloud

### **Schritt 1: Daten vom alten Server holen**

#### **1.1 WordPress-Dateien exportieren**

```bash
# Auf dem ALTEN Google Cloud Server
ssh root@ALTE_SERVER_IP

# Uploads & Plugins packen
cd /var/www/html/wp-content
tar czf ~/luvex-wp-content-$(date +%Y%m%d).tar.gz uploads/ plugins/

# Lokal runterladen
scp root@ALTE_SERVER_IP:~/luvex-wp-content-*.tar.gz ~/Desktop/
```

#### **1.2 Datenbank exportieren**

```bash
# Auf dem ALTEN Google Cloud Server

# MySQL Credentials herausfinden (aus wp-config.php)
grep DB_ /var/www/html/wp-config.php

# Datenbank exportieren
mysqldump -u USERNAME -p DATENBANKNAME > ~/luvex-db-$(date +%Y%m%d).sql

# Komprimieren
gzip ~/luvex-db-*.sql

# Lokal runterladen
scp root@ALTE_SERVER_IP:~/luvex-db-*.sql.gz ~/Desktop/
```

### **Schritt 2: Daten auf neuen Server importieren**

#### **2.1 Dateien hochladen**

```bash
# Auf dem NEUEN Hostinger Server
cd /opt/apps/luvex-tech

# Dateien hochladen
scp ~/Desktop/luvex-wp-content-*.tar.gz root@srv1117211:/opt/apps/luvex-tech/backups/
scp ~/Desktop/luvex-db-*.sql.gz root@srv1117211:/opt/apps/luvex-tech/backups/

# Entpacken und in Docker Volumes kopieren
cd /opt/apps/luvex-tech/backups
tar xzf luvex-wp-content-*.tar.gz

# In Docker Volumes kopieren
docker run --rm \
  -v luvex-website_wordpress_uploads:/uploads \
  -v luvex-website_wordpress_plugins:/plugins \
  -v $(pwd):/backup \
  alpine:latest sh -c "
    cp -r /backup/uploads/* /uploads/
    cp -r /backup/plugins/* /plugins/
  "
```

#### **2.2 Datenbank importieren**

```bash
cd /opt/apps/luvex-tech

# Datenbank importieren
./deploy.sh db-import backups/luvex-db-*.sql.gz

# WordPress URLs aktualisieren (falls Domain sich geändert hat)
docker exec -it luvex-mysql mysql -u root -p

# In MySQL:
USE luvex_production;
UPDATE wp_options SET option_value = 'https://luvex.tech' WHERE option_name = 'siteurl';
UPDATE wp_options SET option_value = 'https://luvex.tech' WHERE option_name = 'home';
exit;

# WordPress Cache leeren (im Container)
docker exec -it luvex-wordpress wp cache flush --allow-root
```

### **Schritt 3: DNS umstellen**

1. **Bei Domain-Registrar (z.B. Hostinger):**
   - A-Record für `luvex.tech` → IP von srv1117211
   - A-Record für `www.luvex.tech` → IP von srv1117211

2. **Propagation abwarten:**
   ```bash
   # Prüfen, ob DNS korrekt
   nslookup luvex.tech
   dig luvex.tech +short
   ```

3. **SSL-Zertifikat erneuern:**
   ```bash
   ./deploy.sh ssl-setup
   ```

### **Schritt 4: Test & Verifikation**

```bash
# Health Check
./deploy.sh health

# WordPress Admin Login testen
# https://luvex.tech/wp-admin

# Theme aktivieren
docker exec -it luvex-wordpress wp theme activate luvex --allow-root

# Permalinks neu generieren
docker exec -it luvex-wordpress wp rewrite flush --allow-root
```

---

## 🎮 Deploy-Script Kommandos

Das `deploy.sh` Script bietet alle wichtigen Management-Funktionen:

### **Deployment**

```bash
./deploy.sh deploy          # Vollständiger Deploy (Backup + Restart + Health Check)
./deploy.sh start           # Container starten
./deploy.sh stop            # Container stoppen
./deploy.sh restart         # Container neustarten
./deploy.sh status          # Status aller Container anzeigen
```

### **Monitoring & Debugging**

```bash
./deploy.sh health                  # Health Checks für alle Services
./deploy.sh logs                    # Alle Logs anzeigen (live)
./deploy.sh logs wordpress          # Nur WordPress Logs
./deploy.sh logs nginx              # Nur Nginx Logs
./deploy.sh logs mysql              # Nur MySQL Logs
./deploy.sh shell                   # Shell in WordPress Container öffnen
./deploy.sh shell mysql             # Shell in MySQL Container öffnen
```

### **Datenbank-Management**

```bash
./deploy.sh db-export               # Datenbank exportieren
./deploy.sh db-import backup.sql    # Datenbank importieren
./deploy.sh rollback                # Aus Backup wiederherstellen (interaktiv)
```

### **Backup**

```bash
./deploy.sh backup-db               # Nur Datenbank-Backup
./deploy.sh backup-files            # Nur Datei-Backup (Uploads, Plugins)
```

**Automatische Backups:**
- Bei jedem `deploy` wird automatisch ein Backup erstellt
- Alte Backups werden nach 7 Tagen gelöscht (konfigurierbar in `.env`)

### **SSL-Verwaltung**

```bash
./deploy.sh ssl-setup               # SSL-Zertifikat einrichten (Let's Encrypt)
```

---

## 🐛 Troubleshooting

### **Problem: Container starten nicht**

```bash
# Logs checken
./deploy.sh logs

# Docker-Status prüfen
docker ps -a
docker-compose ps

# Container neu bauen
docker-compose down
docker-compose up -d --force-recreate
```

### **Problem: 502 Bad Gateway**

**Ursache:** WordPress-Container ist nicht erreichbar

```bash
# WordPress Container Status
docker ps -f name=luvex-wordpress

# WordPress Logs
./deploy.sh logs wordpress

# PHP-FPM Health Check
docker exec luvex-wordpress php-fpm-healthcheck
```

### **Problem: Datenbank-Verbindung fehlgeschlagen**

```bash
# MySQL Status prüfen
docker exec luvex-mysql mysqladmin ping -h localhost -u root -p

# MySQL Logs
./deploy.sh logs mysql

# Verbindung testen
docker exec -it luvex-wordpress wp db check --allow-root
```

### **Problem: Theme wird nicht angezeigt**

```bash
# Theme aktivieren
docker exec -it luvex-wordpress wp theme activate luvex --allow-root

# Theme-Verzeichnis prüfen
docker exec luvex-wordpress ls -la /var/www/html/wp-content/themes/

# Permissions prüfen
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/wp-content/themes/luvex
```

### **Problem: Uploads funktionieren nicht**

```bash
# Permissions prüfen
docker exec luvex-wordpress ls -la /var/www/html/wp-content/uploads

# Rechte setzen
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/wp-content/uploads
docker exec luvex-wordpress chmod -R 755 /var/www/html/wp-content/uploads
```

### **Problem: Nginx Fehler**

```bash
# Nginx Config testen
docker exec luvex-nginx nginx -t

# Nginx neu laden
docker-compose restart nginx

# Nginx Logs
./deploy.sh logs nginx
```

---

## 🔧 Wartung & Backups

### **Automatische Backups**

Das Deploy-Script erstellt automatisch Backups:

- **Bei jedem Deploy:** DB + Files Backup
- **Retention:** 7 Tage (konfigurierbar)
- **Speicherort:** `/opt/apps/luvex-tech/backups/`

**Backup-Format:**
```
backups/
├── luvex_db_20250112_120000.sql.gz       # Datenbank
└── luvex_files_20250112_120000.tar.gz    # Uploads + Plugins
```

### **Manuelle Backups**

```bash
# Backup erstellen
./deploy.sh backup-db
./deploy.sh backup-files

# Backups herunterladen (auf lokalem Rechner)
scp -r root@srv1117211:/opt/apps/luvex-tech/backups/ ~/luvex-backups/
```

### **Restore aus Backup**

```bash
# Interaktiv (zeigt verfügbare Backups)
./deploy.sh rollback

# Oder manuell
./deploy.sh db-import backups/luvex_db_20250112_120000.sql.gz
```

### **WordPress Updates**

```bash
# WordPress Core updaten
docker exec -it luvex-wordpress wp core update --allow-root

# Plugins updaten
docker exec -it luvex-wordpress wp plugin update --all --allow-root

# Themes updaten
docker exec -it luvex-wordpress wp theme update --all --allow-root
```

### **Docker Image Updates**

```bash
# Images aktualisieren
docker-compose pull

# Container mit neuen Images neu starten
./deploy.sh deploy
```

---

## 🔒 Sicherheit

### **Best Practices**

✅ **Secrets Management:**
- `.env` niemals ins Git committen
- `.env` Rechte: `chmod 600 .env`
- Starke Passwörter (32+ Zeichen)

✅ **Docker Security:**
- Alpine Linux Images (minimal, weniger Angriffsfläche)
- Non-root User in Containern
- Isoliertes Docker Network (keine Kommunikation mit Lunaria)
- Read-only Mounts wo möglich

✅ **WordPress Security:**
- XML-RPC deaktiviert (`/xmlrpc.php`)
- Directory Listing deaktiviert
- PHP-Ausführung in Uploads deaktiviert
- `.htaccess` & `wp-config.php` blockiert

✅ **Nginx Security Headers:**
- HSTS (HTTP Strict Transport Security)
- X-Frame-Options (Clickjacking-Schutz)
- X-Content-Type-Options (MIME-Sniffing-Schutz)
- CSP (Content Security Policy)
- X-XSS-Protection

✅ **SSL/TLS:**
- TLS 1.2 & 1.3 only
- Modern Cipher Suites (Mozilla Intermediate)
- OCSP Stapling

✅ **Rate Limiting:**
- 10 Requests/Sekunde pro IP (Burst: 20)
- DDoS-Schutz

### **Firewall (Server-Ebene)**

```bash
# UFW Firewall aktivieren
ufw allow 22/tcp      # SSH
ufw allow 80/tcp      # HTTP
ufw allow 443/tcp     # HTTPS
ufw enable
```

### **Docker Ports (interne Isolation)**

- **Nginx:** Port 8080/8443 (nur für Host-Nginx erreichbar)
- **WordPress:** Port 9000 (nur im Docker Network)
- **MySQL:** Port 3306 (nur im Docker Network)

→ Keine direkten Ports nach außen exponiert!

### **Sicherheits-Checks**

```bash
# Health Check
./deploy.sh health

# Logs auf Fehler prüfen
./deploy.sh logs | grep -i error

# Failed Login Attempts (WordPress)
docker exec -it luvex-mysql mysql -u root -p luvex_production -e "
  SELECT * FROM wp_users ORDER BY ID DESC LIMIT 10;
"
```

---

## 📞 Support & Kontakt

**Bei Problemen:**

1. **Logs checken:** `./deploy.sh logs`
2. **Health Check:** `./deploy.sh health`
3. **Container Status:** `./deploy.sh status`
4. **Dokumentation:** Diese Datei (DEPLOYMENT.md)

**Für zukünftige Sessions:**
Dieses Dokument enthält alle wichtigen Informationen. Bei Fragen:
- Architektur: Siehe [Architektur-Übersicht](#architektur-übersicht)
- Migration: Siehe [Migration von Google Cloud](#migration-von-google-cloud)
- Befehle: Siehe [Deploy-Script Kommandos](#deploy-script-kommandos)

---

## 📚 Weiterführende Links

- [Docker Compose Dokumentation](https://docs.docker.com/compose/)
- [WordPress Docker Image](https://hub.docker.com/_/wordpress)
- [Nginx Docker Image](https://hub.docker.com/_/nginx)
- [Let's Encrypt](https://letsencrypt.org/)
- [WP-CLI](https://wp-cli.org/)

---

**Version:** 1.0
**Letzte Aktualisierung:** 2025-01-12
**Erstellt für:** LUVEX.TECH Migration Google Cloud → Hostinger
