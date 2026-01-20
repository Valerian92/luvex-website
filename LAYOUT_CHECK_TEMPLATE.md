# Layout-Check Tool Template

Automatisierte Layout-Analyse mit Puppeteer für alle LUNARIA Frontend-Apps.

## Integration in ein Projekt

### 1. Puppeteer installieren
```bash
cd frontend  # oder wo package.json liegt
npm install puppeteer --save-dev
```

### 2. Script kopieren
Kopiere `scripts/layout-check.mjs` aus SpesenKompass:
```
D:/LUVEX/Dev/spesenkompass/SpesenKompass/frontend/scripts/layout-check.mjs
```

### 3. Anpassen
Im Script diese Werte anpassen:

```javascript
// Seiten die gecheckt werden sollen
const PAGES = [
  { name: 'home', path: '/' },
  { name: 'login', path: '/login' },
  // ... weitere Seiten
];

// Base URL anpassen wenn nötig
const baseUrl = process.argv[2] || 'https://deine-app.de';
```

### 4. npm scripts hinzufügen
In `package.json`:
```json
{
  "scripts": {
    "layout-check": "node scripts/layout-check.mjs",
    "layout-check:local": "node scripts/layout-check.mjs http://localhost:5173"
  }
}
```

### 5. .gitignore
```
# Layout Check Tool Output
.layout-check/
```

## Nutzung

```bash
# Production
npm run layout-check

# Lokal
npm run layout-check:local
```

## Output
- Screenshots: `.layout-check/*.png`
- JSON Report: `.layout-check/layout-report.json`

Claude kann den Report lesen und Layout-Probleme identifizieren.

---
**Referenz-Implementierung:** `D:/LUVEX/Dev/spesenkompass/SpesenKompass/frontend/`
