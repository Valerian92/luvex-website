# 📦 LUVEX.TECH - Migration Checkliste (Google Cloud → Hostinger)

> **Quick Reference:** Schritt-für-Schritt Anleitung für die vollständige Migration

---

## ⚠️ Vorbereitung

### **Was du brauchst:**

- [ ] SSH-Zugang zum **alten Google Cloud Server**
- [ ] SSH-Zugang zum **neuen Hostinger Server** (srv1117211)
- [ ] Domain-Zugang (für DNS-Änderungen)
- [ ] ~2 Stunden Zeit (bei mittlerer Datenbankgröße)

---

## 🔍 Phase 1: Analyse (Alter Server)

### **1.1 WordPress-Informationen sammeln**

```bash
# SSH zum alten Server
ssh root@ALTE_SERVER_IP

# WordPress Pfad finden
find /var/www -name "wp-config.php" 2>/dev/null

# Angenommen: /var/www/html
cd /var/www/html

# WordPress Version
wp core version --allow-root

# Aktive Plugins auflisten
wp plugin list --status=active --allow-root

# Aktives Theme
wp theme list --status=active --allow-root

# Datenbank-Größe prüfen
wp db size --allow-root
```

### **1.2 Datenbank-Credentials notieren**

```bash
# wp-config.php öffnen
cat /var/www/html/wp-config.php | grep "DB_"

# Notiere dir:
# - DB_NAME
# - DB_USER
# - DB_PASSWORD
# - DB_HOST
```

### **1.3 Uploads-Größe prüfen**

```bash
# Uploads-Größe
du -sh /var/www/html/wp-content/uploads

# Anzahl Dateien
find /var/www/html/wp-content/uploads -type f | wc -l
```

---

## 💾 Phase 2: Backup (Alter Server)

### **2.1 Datenbank exportieren**

```bash
# SSH zum alten Server
ssh root@ALTE_SERVER_IP

# Export erstellen (ersetze CREDENTIALS aus wp-config.php)
mysqldump -u DB_USER -p DB_NAME > ~/luvex-db-$(date +%Y%m%d).sql

# Komprimieren
gzip ~/luvex-db-*.sql

# Größe prüfen
ls -lh ~/luvex-db-*.sql.gz
```

### **2.2 Dateien exportieren**

```bash
# Uploads & Plugins packen
cd /var/www/html/wp-content
tar czf ~/luvex-wp-content-$(date +%Y%m%d).tar.gz uploads/ plugins/

# Größe prüfen
ls -lh ~/luvex-wp-content-*.tar.gz
```

### **2.3 Backups herunterladen (auf lokalem Rechner)**

```bash
# Lokal ausführen (auf deinem Mac/PC)
mkdir -p ~/luvex-migration-backup
cd ~/luvex-migration-backup

# Datenbank
scp root@ALTE_SERVER_IP:~/luvex-db-*.sql.gz .

# Dateien
scp root@ALTE_SERVER_IP:~/luvex-wp-content-*.tar.gz .

# Prüfen
ls -lh
```

---

## 🚀 Phase 3: Neuer Server Setup

### **3.1 Repository klonen**

```bash
# SSH zum neuen Server
ssh root@srv1117211

# Verzeichnis erstellen
mkdir -p /opt/apps/luvex-tech
cd /opt/apps/luvex-tech

# Git klonen
git clone https://github.com/Valerian92/luvex-website.git .

# Branch wechseln
git checkout claude/migrate-luvex-hostinger-docker-011CV2PeVyo5eKuEDy254Mgo
```

### **3.2 Environment Variables konfigurieren**

```bash
cd /opt/apps/luvex-tech

# .env erstellen
cp .env.example .env

# Passwörter generieren
echo "MySQL Root Password: $(openssl rand -base64 32)"
echo "MySQL User Password: $(openssl rand -base64 32)"

# .env bearbeiten
nano .env
```

**Fülle aus:**
```env
MYSQL_ROOT_PASSWORD=<generiertes-passwort>
MYSQL_DATABASE=luvex_production
MYSQL_USER=luvex_user
MYSQL_PASSWORD=<generiertes-passwort>
NGINX_HTTP_PORT=8080
NGINX_HTTPS_PORT=8443
```

```bash
# Rechte setzen
chmod 600 .env
```

### **3.3 Docker Container starten (erste Initialisierung)**

```bash
# Deployment starten
./deploy.sh start

# Status prüfen
./deploy.sh status

# Warten bis MySQL bereit ist (~30 Sekunden)
./deploy.sh logs mysql

# Health Check
./deploy.sh health
```

---

## 📤 Phase 4: Daten übertragen

### **4.1 Backups hochladen**

```bash
# Lokal ausführen (auf deinem Mac/PC)
cd ~/luvex-migration-backup

# Backups hochladen
scp luvex-db-*.sql.gz root@srv1117211:/opt/apps/luvex-tech/backups/
scp luvex-wp-content-*.tar.gz root@srv1117211:/opt/apps/luvex-tech/backups/
```

### **4.2 Datenbank importieren**

```bash
# SSH zum neuen Server
ssh root@srv1117211
cd /opt/apps/luvex-tech

# Datenbank importieren
./deploy.sh db-import backups/luvex-db-*.sql.gz

# Prüfen, ob Import erfolgreich
docker exec -it luvex-mysql mysql -u root -p -e "USE luvex_production; SHOW TABLES;"
```

### **4.3 Dateien importieren**

```bash
cd /opt/apps/luvex-tech/backups

# Archive entpacken
tar xzf luvex-wp-content-*.tar.gz

# In Docker Volumes kopieren
docker run --rm \
  -v luvex-website_wordpress_uploads:/uploads \
  -v luvex-website_wordpress_plugins:/plugins \
  -v $(pwd):/backup \
  alpine:latest sh -c "
    rm -rf /uploads/* /plugins/*
    cp -r /backup/uploads/* /uploads/
    cp -r /backup/plugins/* /plugins/
    chmod -R 755 /uploads /plugins
  "

# Prüfen
docker exec luvex-wordpress ls -la /var/www/html/wp-content/uploads
docker exec luvex-wordpress ls -la /var/www/html/wp-content/plugins
```

---

## 🔧 Phase 5: WordPress konfigurieren

### **5.1 URLs aktualisieren**

```bash
# MySQL Shell öffnen
docker exec -it luvex-mysql mysql -u root -p

# In MySQL (alte Domain → neue Domain):
USE luvex_production;

-- Alte URL anzeigen
SELECT option_value FROM wp_options WHERE option_name IN ('siteurl', 'home');

-- WICHTIG: Ersetze ALTE_DOMAIN mit der aktuellen Domain (z.B. luvex-website.google.com)
UPDATE wp_options SET option_value = 'https://luvex.tech' WHERE option_name = 'siteurl';
UPDATE wp_options SET option_value = 'https://luvex.tech' WHERE option_name = 'home';

-- Prüfen
SELECT option_value FROM wp_options WHERE option_name IN ('siteurl', 'home');

exit;
```

### **5.2 Theme aktivieren**

```bash
# Theme-Verzeichnis prüfen
docker exec luvex-wordpress ls -la /var/www/html/wp-content/themes/

# Theme aktivieren
docker exec -it luvex-wordpress wp theme activate luvex --allow-root

# Permalinks neu generieren
docker exec -it luvex-wordpress wp rewrite flush --allow-root

# Cache leeren
docker exec -it luvex-wordpress wp cache flush --allow-root
```

### **5.3 Permissions setzen**

```bash
# WordPress Permissions
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/wp-content
docker exec luvex-wordpress chmod -R 755 /var/www/html/wp-content/uploads
docker exec luvex-wordpress chmod -R 755 /var/www/html/wp-content/plugins
```

---

## 🌐 Phase 6: DNS & SSL

### **6.1 DNS umstellen**

**Wichtig:** Erst DNS, dann SSL!

1. **Server-IP herausfinden:**
   ```bash
   # Auf srv1117211
   curl ifconfig.me
   # Notiere die IP
   ```

2. **Bei Domain-Registrar (Hostinger):**
   - Login zu Hostinger DNS-Management
   - A-Record für `luvex.tech` → Server-IP von srv1117211
   - A-Record für `www.luvex.tech` → Server-IP von srv1117211

3. **DNS-Propagation prüfen (lokal):**
   ```bash
   # Warten (~5-15 Minuten)
   nslookup luvex.tech
   dig luvex.tech +short
   ```

### **6.2 SSL-Zertifikat einrichten**

```bash
# Erst wenn DNS zeigt auf neuen Server!
cd /opt/apps/luvex-tech

# SSL einrichten
./deploy.sh ssl-setup

# Eingaben:
#   Domain: luvex.tech
#   Email: deine@email.com

# Bei Erfolg: Nginx neustarten
docker-compose restart nginx
```

### **6.3 Host-Nginx konfigurieren**

```bash
# Host-Nginx Config erstellen
nano /etc/nginx/sites-available/luvex.tech
```

**Inhalt:**
```nginx
server {
    listen 80;
    server_name luvex.tech www.luvex.tech;
    location /.well-known/acme-challenge/ { root /var/www/certbot; }
    location / { return 301 https://$host$request_uri; }
}

server {
    listen 443 ssl http2;
    server_name luvex.tech www.luvex.tech;

    ssl_certificate /etc/letsencrypt/live/luvex.tech/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/luvex.tech/privkey.pem;

    location / {
        proxy_pass https://localhost:8443;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto https;
    }
}
```

```bash
# Aktivieren
ln -s /etc/nginx/sites-available/luvex.tech /etc/nginx/sites-enabled/

# Syntax testen
nginx -t

# Nginx neu laden
systemctl reload nginx
```

---

## ✅ Phase 7: Validierung

### **7.1 Health Checks**

```bash
cd /opt/apps/luvex-tech

# Service Health
./deploy.sh health

# Container Status
./deploy.sh status

# Logs prüfen
./deploy.sh logs | grep -i error
```

### **7.2 Frontend-Tests**

Browser öffnen und testen:

- [ ] **Homepage:** https://luvex.tech
- [ ] **WordPress Admin:** https://luvex.tech/wp-admin
  - Login mit alten Credentials
- [ ] **Bilder laden:** Posts mit Bildern öffnen
- [ ] **Navigation:** Alle Menü-Links testen
- [ ] **Theme:** Design korrekt?
- [ ] **Formulare:** Kontaktformular testen

### **7.3 Performance-Tests**

```bash
# Response Time
curl -o /dev/null -s -w "Total time: %{time_total}s\n" https://luvex.tech

# SSL-Test
curl -vI https://luvex.tech 2>&1 | grep "SSL connection"

# HTTP → HTTPS Redirect
curl -I http://luvex.tech
```

---

## 🧹 Phase 8: Aufräumen

### **8.1 Alter Server (später deaktivieren!)**

```bash
# WICHTIG: Warte 1-2 Wochen, um sicher zu sein, dass alles läuft!

# Dann erst:
# - Google Cloud Instanz stoppen
# - Finale Backups erstellen
# - Instanz löschen
```

### **8.2 Lokale Backups aufbewahren**

```bash
# Backups an sicheren Ort verschieben
mv ~/luvex-migration-backup ~/Backups/luvex-migration-$(date +%Y%m%d)
```

---

## 🎉 Fertig!

### **Checkliste (alle Punkte abhaken):**

- [ ] Alter Server: Datenbank exportiert
- [ ] Alter Server: Dateien exportiert
- [ ] Neuer Server: Docker Container laufen
- [ ] Neuer Server: Datenbank importiert
- [ ] Neuer Server: Dateien importiert
- [ ] WordPress: URLs aktualisiert
- [ ] WordPress: Theme aktiviert
- [ ] WordPress: Admin-Login funktioniert
- [ ] DNS: Zeigt auf neuen Server
- [ ] SSL: Zertifikat installiert
- [ ] HTTPS: Funktioniert ohne Fehler
- [ ] Website: Alle Seiten laden
- [ ] Performance: Ladezeiten OK
- [ ] Backups: Lokal gesichert

---

## 🚨 Rollback (falls etwas schief geht)

### **DNS zurück auf alten Server:**

1. DNS-Records wieder auf alte IP ändern
2. Warten (~15 Minuten)
3. Alte Server-Instanz wieder starten

### **Zeit einplanen:**

- DNS-Propagation: 5-30 Minuten
- SSL-Setup: 2-5 Minuten
- Datenbank-Import: Abhängig von Größe (100 MB ≈ 5 Min)

---

## 📞 Support

**Bei Problemen während Migration:**

1. **Logs checken:** `./deploy.sh logs`
2. **Health Check:** `./deploy.sh health`
3. **Rollback:** DNS auf alten Server zurücksetzen

**Dokumentation:**
- Vollständige Doku: `DEPLOYMENT.md`
- Deploy-Befehle: `./deploy.sh help`

---

**Version:** 1.0
**Erstellt:** 2025-01-12
