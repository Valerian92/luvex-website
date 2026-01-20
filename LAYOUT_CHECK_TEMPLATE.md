# Layout-Check mit Playwright MCP

> **Update 2026-01-20:** Puppeteer-Skript ersetzt durch Playwright MCP - keine Installation nötig!

## Warum Playwright MCP?

| Aspekt | Puppeteer (Alt) | Playwright MCP (Neu) |
|--------|-----------------|----------------------|
| Installation | `npm install puppeteer` + Browser | Keine - bereits in Claude |
| Kompatibilität | OS-abhängig, oft Probleme | Funktioniert überall |
| Nutzung | Batch-Script | Interaktiv in Session |
| Screenshots | Nur speichern | Direkt analysieren |
| Debugging | Manuell | Claude analysiert live |

---

## Playwright MCP Befehle

Claude hat direkten Zugriff auf diese Tools:

```
mcp__playwright__browser_navigate       → URL öffnen
mcp__playwright__browser_snapshot       → Accessibility-Snapshot (Layout-Struktur)
mcp__playwright__browser_take_screenshot → Screenshot speichern
mcp__playwright__browser_click          → Elemente klicken
mcp__playwright__browser_type           → Text eingeben
mcp__playwright__browser_resize         → Viewport ändern (Mobile/Tablet/Desktop)
mcp__playwright__browser_console_messages → Console-Fehler prüfen
```

---

## Typischer Layout-Check Workflow

### 1. Seite öffnen
```
User: "Check das Layout von spesenkompass.de"
Claude: mcp__playwright__browser_navigate({url: "https://spesenkompass.de"})
```

### 2. Snapshot für Struktur-Analyse
```
Claude: mcp__playwright__browser_snapshot()
→ Gibt YAML-Struktur aller Elemente zurück
→ Claude kann Layout-Hierarchie analysieren
```

### 3. Verschiedene Viewports testen
```
Claude: mcp__playwright__browser_resize({width: 375, height: 812})   // Mobile
Claude: mcp__playwright__browser_snapshot()

Claude: mcp__playwright__browser_resize({width: 768, height: 1024})  // Tablet
Claude: mcp__playwright__browser_snapshot()

Claude: mcp__playwright__browser_resize({width: 1440, height: 900})  // Desktop
Claude: mcp__playwright__browser_snapshot()
```

### 4. Screenshot bei Problemen
```
Claude: mcp__playwright__browser_take_screenshot({filename: "issue-mobile.png"})
```

---

## Vorteile für Layout-Debugging

1. **Accessibility Snapshot** zeigt:
   - Element-Hierarchie (heading, button, link, etc.)
   - Referenz-IDs für Interaktion
   - Text-Inhalte
   - Fokus-Status

2. **Interaktives Debugging:**
   - Claude kann Elemente klicken und Zustand prüfen
   - Hover-States testen
   - Formulare ausfüllen

3. **Console-Fehler erkennen:**
   - JavaScript Errors
   - Network-Fehler
   - React/Vue Warnings

---

## Beispiel: Vollständiger Layout-Check

```
User: "Prüf alle Seiten von meiner App auf Layout-Probleme"

Claude:
1. mcp__playwright__browser_navigate({url: "https://app.example.com"})
2. mcp__playwright__browser_snapshot() → Analysiere Landing Page
3. mcp__playwright__browser_resize({width: 375, height: 812})
4. mcp__playwright__browser_snapshot() → Check Mobile
5. mcp__playwright__browser_click({ref: "login-button"})
6. mcp__playwright__browser_snapshot() → Analysiere Login Page
7. mcp__playwright__browser_console_messages() → Check auf Fehler
8. ... für alle wichtigen Seiten wiederholen
```

---

## Legacy: Puppeteer Script (Optional)

Falls du trotzdem ein automatisiertes Batch-Script brauchst (CI/CD, etc.):

**Referenz:** `D:/LUVEX/Dev/spesenkompass/SpesenKompass/frontend/scripts/layout-check.mjs`

```bash
# Installation
npm install puppeteer --save-dev

# Nutzung
npm run layout-check        # Production
npm run layout-check:local  # localhost
```

**Hinweis:** Das Puppeteer-Script hat oft OS-Kompatibilitätsprobleme. Playwright MCP ist die empfohlene Methode.

---

**Letzte Aktualisierung:** 2026-01-20
