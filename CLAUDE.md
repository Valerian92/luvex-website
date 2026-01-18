# Claude Code Projektkontext

> **WICHTIG - Session Start:** Nutze `mcp__memory__read_graph` um Cross-Projekt-Kontext zu laden!

---

## WICHTIG - Lies das zuerst!

**Owner:** Valerian Huber (github.com/Valerian92)

**NICHT "LUNARIA"!** Diese Projekte sind NICHT alle für die "Lunaria GmbH":
- Dies sind **Valerian Huber's persönliche/geschäftliche Projekte**
- **NUR `lunaria-erp`** ist ein Projekt für die Lunaria GmbH (Kunde)
- Dieser "Website" Ordner enthält **Luvex Website** (luvex.tech) - NICHT Lunaria!

**Firmen/Brands:**
- **Luvex** - Valerian's Firma (luvex.tech, UV Simulation)
- **Alpin-Code** - Valerian's Dev-Brand (alpin-code.de, n8n, Automation)
- **Lunaria GmbH** - Externer Kunde, nur für lunaria-erp

**Bei Session-Start:**
1. Diese Datei lesen
2. `mcp__memory__read_graph` ausführen
3. Wichtige Erkenntnisse in Memory speichern: `mcp__memory__add_observations`

---

## Projekt: Luvex Website

### Beschreibung
WordPress Website für Luvex (luvex.tech).

### Struktur
```
/Website
├── luvex-website/      # WordPress Setup für luvex.tech
└── backup_wordpress/   # WordPress Backups
```

### Tech Stack
- WordPress (Docker containerisiert)
- MySQL 8.0
- Nginx
- Traefik (Reverse Proxy)

---

## Entwickler-Konventionen

### Deployment-Pipeline
```
Claude: Commit & Push → User: Merge auf Main → User: Deploy
```

**WICHTIG:** User handled Deployments, Claude macht nur Commits & Push!

### Commits
- Deutsche Commit-Messages OK
- Co-Authored-By: Claude Opus 4.5 <noreply@anthropic.com>

### MCP Tools
- **Memory:** Cross-Projekt Brain (`mcp__memory__*`)
- **Docker:** Container Management (`mcp__docker__*`)
- **GitHub:** Repo/PR/Issues (`mcp__github__*`)

---

## Projekt-spezifische Notizen

*Session-Notizen hier eintragen*
