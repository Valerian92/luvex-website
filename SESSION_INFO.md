# 🤖 Session Information für Claude Code

> **Wichtig:** Diese Datei ist für nachfolgende Claude Code Sessions gedacht und gibt einen schnellen Überblick über das Projekt.

---

## 🎯 Projekt-Kontext

**Projekt:** LUVEX.TECH Website Migration (Google Cloud → Hostinger)
**Status:** Docker-Setup erstellt, bereit für Deployment
**Repository:** Valerian92/luvex-website
**Branch:** `claude/migrate-luvex-hostinger-docker-011CV2PeVyo5eKuEDy254Mgo`

---

## 🏗️ Was ist das Projekt?

LUVEX.TECH ist eine WordPress-Website, die von Google Cloud zu einem Hostinger-Server (srv1117211) migriert werden soll. Die Website läuft auf dem gleichen Server wie eine Lunaria Shopify App (komplett getrennt in `/opt/apps/production/`).

### **Technologie-Stack:**

- **CMS:** WordPress 6.4+ (Custom Theme)
- **Container:** Docker + Docker Compose
- **Webserver:** Nginx (Reverse Proxy)
- **Datenbank:** MySQL 8.0
- **PHP:** 8.2 (FPM)
- **SSL:** Let's Encrypt

---

## 📁 Wichtige Dateien

| Datei | Beschreibung |
|-------|--------------|
| `docker-compose.yml` | Docker Orchestrierung (WordPress, MySQL, Nginx) |
| `.env.example` | Template für Environment Variables |
| `deploy.sh` | Management-Script (Deploy, Backup, Logs, etc.) |
| `nginx/luvex.conf` | Nginx Production Config |
| `DEPLOYMENT.md` | **Vollständige Dokumentation** (START HIER!) |
| `MIGRATION.md` | Schritt-für-Schritt Migration Guide |
| `SESSION_INFO.md` | Diese Datei |

---

## 🚀 Schnellstart (für neue Sessions)

### **1. Dokumentation lesen**

```bash
# Zuerst lesen:
cat DEPLOYMENT.md       # Vollständige Doku
cat MIGRATION.md        # Migration Guide
```

### **2. Aktuellen Status prüfen**

```bash
# Wo bin ich?
pwd
# → /home/user/luvex-website

# Git Status
git status

# Branch prüfen
git branch
# → claude/migrate-luvex-hostinger-docker-011CV2PeVyo5eKuEDy254Mgo
```

### **3. Deployment-Befehle**

```bash
# Container starten
./deploy.sh start

# Status prüfen
./deploy.sh status

# Health Check
./deploy.sh health

# Logs anzeigen
./deploy.sh logs

# Hilfe anzeigen
./deploy.sh help
```

---

## 🗺️ Architektur (Kurzfassung)

```
Server srv1117211
│
├── /opt/apps/production/     ← Lunaria (Shopify App)
│   └── Port 5000 (Python Flask)
│
└── /opt/apps/luvex-tech/     ← LUVEX.TECH (WordPress)
    │
    ├── Docker Network: luvex-network (isoliert!)
    │   ├── Nginx (Port 8080/8443)
    │   ├── WordPress (Port 9000)
    │   └── MySQL (Port 3306)
    │
    └── Host-Nginx → Reverse Proxy → Docker-Nginx
```

**Isolation:** Luvex und Lunaria nutzen separate Docker Networks (keine Konflikte!)

---

## ✅ Was wurde bereits gemacht?

- [x] Docker-Compose Setup erstellt
- [x] Nginx Production Config
- [x] Environment Variables Template
- [x] Deploy-Script mit Backup-Funktion
- [x] Vollständige Dokumentation (DEPLOYMENT.md)
- [x] Migration Guide (MIGRATION.md)
- [x] .gitignore (Secrets-Schutz)

---

## 🔜 Was muss noch gemacht werden?

### **Auf dem Server (srv1117211):**

1. Repository klonen nach `/opt/apps/luvex-tech/`
2. `.env` konfigurieren (Passwörter setzen)
3. SSL-Zertifikat einrichten (`./deploy.sh ssl-setup`)
4. Deployment starten (`./deploy.sh deploy`)
5. Host-Nginx als Reverse Proxy konfigurieren
6. Daten vom alten Google Cloud Server migrieren (siehe `MIGRATION.md`)

### **Vollständiger Workflow:**

Siehe `MIGRATION.md` für Schritt-für-Schritt Anleitung!

---

## 🔑 Wichtige Informationen

### **Server-Details:**

- **Host:** root@srv1117211
- **Provider:** Hostinger/Hetzner
- **Docker:** ✅ Installiert
- **Nginx:** ✅ Läuft (für Lunaria)

### **Domain:**

- **Domain:** luvex.tech
- **Status:** Bereits zu Hostinger umgezogen
- **Aktuell:** Offline (alte Google Server-Instanz läuft noch)

### **Alte Installation (Google Cloud):**

- **Status:** Noch aktiv
- **WordPress:** Läuft noch (für Backup-Zugriff)
- **Daten:** Müssen exportiert werden (DB + Uploads)

---

## 📚 Nützliche Kommandos

### **Logs & Debugging:**

```bash
./deploy.sh logs                  # Alle Logs
./deploy.sh logs wordpress        # WordPress Logs
./deploy.sh logs nginx            # Nginx Logs
./deploy.sh logs mysql            # MySQL Logs
```

### **Container-Management:**

```bash
./deploy.sh start                 # Container starten
./deploy.sh stop                  # Container stoppen
./deploy.sh restart               # Container neustarten
./deploy.sh status                # Status anzeigen
./deploy.sh health                # Health Checks
```

### **Shell-Zugriff:**

```bash
./deploy.sh shell                 # WordPress Container
./deploy.sh shell mysql           # MySQL Container
./deploy.sh shell nginx           # Nginx Container
```

### **Backup & Restore:**

```bash
./deploy.sh backup-db             # DB Backup
./deploy.sh backup-files          # Files Backup
./deploy.sh db-export             # DB Export
./deploy.sh db-import file.sql    # DB Import
./deploy.sh rollback              # Restore aus Backup
```

---

## 🐛 Häufige Probleme

### **Problem: `.env` nicht gefunden**

```bash
cp .env.example .env
nano .env
# Passwörter setzen!
chmod 600 .env
```

### **Problem: Container starten nicht**

```bash
# Logs checken
./deploy.sh logs

# Container neu bauen
docker-compose down
docker-compose up -d --force-recreate
```

### **Problem: Theme wird nicht angezeigt**

```bash
# Theme aktivieren
docker exec -it luvex-wordpress wp theme activate luvex --allow-root

# Permissions setzen
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/wp-content/themes/luvex
```

---

## 📞 Für den User

**Wichtige Dateien für dich:**

- **DEPLOYMENT.md:** Vollständige technische Dokumentation
- **MIGRATION.md:** Schritt-für-Schritt Migrations-Anleitung
- **deploy.sh:** Management-Script für alle Operationen

**Nächste Schritte:**

1. Lies `MIGRATION.md` für die vollständige Checkliste
2. Sammle Zugangsdaten (alter Google Server, neuer Hostinger Server)
3. Starte mit Phase 1 (Analyse) der Migration

---

## 🔒 Sicherheit

**WICHTIG:**

- `.env` ist in `.gitignore` (wird nie committed!)
- Backups sind in `.gitignore` (sensible Daten!)
- SSL-Zertifikate sind auf Host-System (`/etc/letsencrypt`)

**Passwörter generieren:**

```bash
openssl rand -base64 32
```

---

**Version:** 1.0
**Erstellt:** 2025-01-12
**Für:** Claude Code nachfolgende Sessions
