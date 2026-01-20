# CLAUDE.md - Project Context

> **Session Start:** Lies diese Datei vollständig. Nutze `mcp__memory__read_graph` für Cross-Projekt-Kontext!

---

## WICHTIG - Lies das zuerst!

**Owner:** Valerian Huber (github.com/Valerian92)

**NICHT "LUNARIA"!** Dies ist ein **eigenes Projekt** von Valerian:
- **NUR `lunaria-erp`** ist ein Projekt für die Lunaria GmbH (Kunde)
- Die Luvex Website gehört zu **Luvex** (Valerian's Firma)

**Firmen/Brands:**
- **Luvex** - Valerian's Firma (luvex.tech, UV Simulation)
- **Alpin-Code** - Valerian's Dev-Brand (alpin-code.de, n8n, Automation)
- **Lunaria GmbH** - Externer Kunde, nur für lunaria-erp

**Bei Session-Start:**
1. Diese Datei lesen
2. ARCHITECTURE_PROMPT.md lesen
3. `mcp__memory__read_graph` ausführen

---

## Proaktive Dokumentations-Pflicht

> **SELBST-UPDATE PFLICHT:** Claude MUSS diese Datei und `ARCHITECTURE_PROMPT.md` selbstständig aktualisieren!

### Wann aktualisieren?

| Trigger | Aktion |
|---------|--------|
| WordPress Theme Änderungen | Beide Dateien |
| Neue Plugins | ARCHITECTURE_PROMPT.md |
| Infrastruktur-Änderungen | ARCHITECTURE_PROMPT.md |
| Content-Struktur Änderungen | CLAUDE.md |

### Session-Workflow

```
SESSION START:
1. CLAUDE.md lesen ✓
2. ARCHITECTURE_PROMPT.md lesen ✓
3. mcp__memory__read_graph ausführen ✓

SESSION ENDE:
1. Prüfen: Wurden Änderungen gemacht die dokumentiert werden müssen?
2. CLAUDE.md aktualisieren (wenn nötig)
3. ARCHITECTURE_PROMPT.md Update-Log ergänzen (wenn relevant)
```

---

## Projekt-Übersicht

| Key | Value |
|-----|-------|
| **Name** | Luvex Website |
| **Beschreibung** | Firmenwebsite für Luvex (UV Branche) |
| **Repository** | github.com/Valerian92/luvex-website |
| **Status** | Production |
| **Domain** | luvex.tech |
| **Firma/Brand** | **Luvex** |

---

## Tech Stack

### CMS
- **Platform:** WordPress (Docker containerisiert)
- **Theme:** Custom/Child Theme
- **Plugins:** *dokumentieren wenn relevant*

### Database
- **Type:** MySQL 8.0
- **Container:** Separate MySQL Container

### Hosting
- **Container:** Docker + Docker Compose
- **Reverse Proxy:** Traefik (via infrastructure-ops)
- **SSL:** Let's Encrypt (automatisch)
- **Network:** luvex-network

---

## Verzeichnisstruktur

```
/Website
├── luvex-website/      # WordPress Setup für luvex.tech
│   ├── docker-compose.yml
│   ├── wp-content/     # Themes, Plugins, Uploads
│   └── ...
└── backup_wordpress/   # WordPress Backups
```

---

## Wichtige URLs

| Umgebung | URL | Beschreibung |
|----------|-----|--------------|
| **Production** | https://luvex.tech | Live Website |
| **Admin** | https://luvex.tech/wp-admin | WordPress Admin |

---

## Docker Setup

```yaml
services:
  wordpress:
    - Image: wordpress:latest
    - Port: 8081
    - Network: luvex-network

  mysql:
    - Image: mysql:8.0
    - Network: luvex-network (or db-shared)
```

---

## Commands

```bash
# Docker starten
docker-compose up -d

# WordPress Logs
docker logs -f luvex-wordpress

# MySQL Backup
docker exec mysql mysqldump -u root -p luvex > backup.sql
```

---

## Arbeitsanweisungen für Claude

### Grundregeln
1. **Code vor Änderung lesen**
2. **Kleine Commits**
3. **WordPress Core NICHT modifizieren** - nur Theme/Plugins
4. **Backups vor größeren Änderungen**

### Git Workflow
- **Main Branch:** `main`
- **Commit Style:** Deutsch OK
- **Co-Author:**
  ```
  Co-Authored-By: Claude Opus 4.5 <noreply@anthropic.com>
  ```

**WICHTIG:** Claude macht NUR Commits & Push. User handled Deployments!

### Was zu vermeiden ist
- [ ] Keine WordPress Core Änderungen
- [ ] Keine Plugin-Updates via Git (über WP Admin)
- [ ] Keine Datenbank-Commits (nur Config)

---

## Session-Log

### 2026-01-19 - CLAUDE.md Standardisierung

- CLAUDE.md komplett überarbeitet
- Selbst-Update-Pflicht hinzugefügt
- ARCHITECTURE_PROMPT.md erstellt

---

## Layout-Check (Playwright MCP)

> **Update 2026-01-20:** Puppeteer ersetzt durch Playwright MCP - keine Installation nötig!

Claude hat direkten Zugriff auf Browser-Automation:

```
mcp__playwright__browser_navigate       → URL öffnen
mcp__playwright__browser_snapshot       → Layout-Struktur analysieren
mcp__playwright__browser_resize         → Viewport ändern (Mobile/Tablet/Desktop)
mcp__playwright__browser_take_screenshot → Screenshot speichern
```

**Referenz:** `D:/LUVEX/Dev/LAYOUT_CHECK_TEMPLATE.md`

---

**Letzte Aktualisierung:** 2026-01-20
