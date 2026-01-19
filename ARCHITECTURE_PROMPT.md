# Luvex Website Architektur-Visualisierung

> **Zweck:** Alle Informationen für Architektur-Grafik-Generierung
> **Letzte Aktualisierung:** 2026-01-19
> **Verantwortlich:** Claude (automatische Updates bei Änderungen)

---

## 1. Systemübersicht

| Attribut | Wert |
|----------|------|
| **Projektname** | Luvex Website |
| **Zweck** | Firmenwebsite für Luvex (UV Branche) |
| **Owner** | Valerian Huber (github.com/Valerian92) |
| **Firma/Brand** | **Luvex** (Valerian's Firma) |
| **Status** | Production |
| **Kritikalität** | HOCH - Firmenpräsenz |

### Compliance-Anforderungen

| Standard | Status | Notizen |
|----------|--------|---------|
| DSGVO | Relevant | Kontaktformulare, Analytics |
| Impressum | Erforderlich | Pflicht für DE |
| Cookie Consent | Erforderlich | Analytics/Tracking |

### Zielgruppe

- Potenzielle Kunden (UV Branche)
- B2B Partner
- Interessenten

---

## 2. Komponenten

### 2.1 WordPress

| Attribut | Wert |
|----------|------|
| **Typ** | CMS / Website |
| **Container** | `luvex-wordpress` |
| **Image** | wordpress:latest |
| **Host** | VPS via Traefik |
| **Port** | 8081 |
| **Domain** | luvex.tech |
| **Network** | luvex-network |

### 2.2 MySQL Database

| Attribut | Wert |
|----------|------|
| **Typ** | Relational Database |
| **Container** | `mysql` |
| **Image** | mysql:8.0 |
| **Network** | luvex-network / db-shared |
| **Backup** | Manual + Scheduled |

---

## 3. Datenfluss-Diagramm

```
                                    INTERNET
                                        │
                                        ▼
                    ┌───────────────────────────────────────┐
                    │          VPS (Germany)                 │
                    │  ┌─────────────────────────────────┐  │
                    │  │         TRAEFIK (SSL)            │  │
                    │  │         luvex.tech               │  │
                    │  └─────────────────────────────────┘  │
                    │              │                         │
                    │              ▼                         │
                    │  ┌─────────────────────────────────┐  │
                    │  │        WORDPRESS                │  │
                    │  │        Container                │  │
                    │  │        :8081                    │  │
                    │  │                                 │  │
                    │  │  ┌─────────────────────────┐   │  │
                    │  │  │     Custom Theme        │   │  │
                    │  │  │     + Plugins           │   │  │
                    │  │  └─────────────────────────┘   │  │
                    │  └──────────────┬──────────────────┘  │
                    │                 │                      │
                    │                 ▼                      │
                    │  ┌─────────────────────────────────┐  │
                    │  │          MySQL 8.0              │  │
                    │  │         (Database)              │  │
                    │  └─────────────────────────────────┘  │
                    │                                       │
                    └───────────────────────────────────────┘
```

### Protokolle

| Verbindung | Protokoll | Auth |
|------------|-----------|------|
| User → Traefik | HTTPS | - |
| Admin → WP Admin | HTTPS | WP Login |
| WordPress → MySQL | TCP | MySQL Auth |

---

## 4. Service-Entscheidungen (Reasoning)

### WordPress

| Aspekt | Entscheidung |
|--------|--------------|
| **Gewählt** | WordPress (Self-hosted) |
| **Alternativen** | Webflow, Wix, Custom Static Site, Ghost |
| **Begründung** | Schnelle Content-Updates, große Plugin-Auswahl, SEO-Tools, bekannte Admin-Oberfläche |
| **DSGVO** | Self-hosted = volle Kontrolle |
| **Kosten** | 0€ (Open Source) |

### MySQL

| Aspekt | Entscheidung |
|--------|--------------|
| **Gewählt** | MySQL 8.0 (Docker) |
| **Alternativen** | MariaDB, Managed DB |
| **Begründung** | WordPress Standard, bewährt, einfach zu backuppen |
| **DSGVO** | Self-hosted in Deutschland |
| **Kosten** | 0€ (Teil VPS) |

### Abgelehnte Optionen

| Option | Grund |
|--------|-------|
| **Webflow** | Teuer, weniger Kontrolle über Hosting |
| **Static Site** | Weniger flexibel für Content-Updates |
| **Managed WordPress** | Teurer als Self-hosted |

---

## 5. DSGVO & Compliance

### Daten-Klassifizierung

| Datentyp | Kategorie | Speicherort | Verschlüsselung | Retention |
|----------|-----------|-------------|-----------------|-----------|
| Kontaktformular | PII | MySQL (VPS) | Transit: TLS | Nach Bearbeitung |
| Analytics Data | PII (IP) | Depends on Tool | - | Plugin-abhängig |
| WP User Accounts | PII | MySQL (VPS) | Transit: TLS | Account Lifetime |

### DSGVO Checkliste

- [ ] Impressum vorhanden
- [ ] Datenschutzerklärung vorhanden
- [ ] Cookie Consent Banner
- [ ] SSL aktiv
- [ ] Kontaktformular DSGVO-konform

### Secrets Management

| Secret | Speicherort | Rotation |
|--------|-------------|----------|
| MySQL Root Password | docker-compose.yml / .env | Bei Kompromittierung |
| WP Salts | wp-config.php | Initial gesetzt |

---

## 6. Migrations-Roadmap

### Aktuelle Phase

```
[AKTIV] Phase: Stable Production
├── Status: Live
├── Content aktuell ✅
├── SEO optimiert ✅
└── DSGVO-konform ✅
```

### Geplante Phasen

| Phase | Beschreibung | Trigger | Kosten-Delta |
|-------|--------------|---------|--------------|
| **Blog Section** | News/Artikel | Marketing-Bedarf | +0€ |
| **Multi-Language** | DE/EN | International Expansion | +Plugin Kosten |
| **Shop Integration** | WooCommerce | Produktverkauf | +Setup Time |

---

## 7. Visualisierungs-Anweisungen

### Farbschema

| Element | Farbe | Hex |
|---------|-------|-----|
| **Traefik** | Blau | #2196F3 |
| **WordPress** | WP-Blau | #21759B |
| **MySQL** | Orange | #F29111 |

### Immer inkludieren

- [ ] VPS als Container-Boundary
- [ ] WordPress + MySQL Stack
- [ ] "Luvex" Branding
- [ ] DSGVO-Compliance andeuten

---

## 8. Update-Log

| Datum | Änderung | Grund |
|-------|----------|-------|
| 2026-01-19 | Initiale Erstellung | Standardisierung Architektur-Dokumentation |

---

## Anhang: Prompt für Bild-Generator

```
Erstelle ein Architektur-Diagramm für Luvex Website:

KOMPONENTEN:
- Traefik Reverse Proxy (blau)
- WordPress Container (WordPress-blau #21759B)
- MySQL Database (orange)

LAYOUT:
- VPS (Deutschland) als Box
- Traefik oben
- WordPress in der Mitte
- MySQL unten

STIL:
- Clean, Corporate
- WordPress-Farben nutzen
- "Luvex" Branding
- DSGVO-Badge (EU Server)
```
