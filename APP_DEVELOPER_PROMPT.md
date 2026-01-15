# 🚀 Prompt für App Developer Agent - UV Simulation App

> **Status:** WordPress DevOps Setup ✅ ABGESCHLOSSEN
> **Nächster Schritt:** App Development mit WordPress-Login-Integration

---

## 🔴 LIVE PRODUCTION DEPLOYMENT - KRITISCHER HINWEIS

**⚠️ ACHTUNG: Diese App wird DIREKT auf PRODUCTION deployed!**

```
═══════════════════════════════════════════════════════════════════════════════
🔴 LIVE PRODUCTION ENVIRONMENT
═══════════════════════════════════════════════════════════════════════════════

Domain:             https://uv.luvex.tech
Environment:        PRODUCTION (LIVE - kein Staging!)
Database:           Produktions-WordPress-Datenbank (luvex_production)
User Impact:        Fehler sind SOFORT für echte Benutzer sichtbar

KRITISCHE ANFORDERUNGEN:
✅ Sorgfältiges Testing vor Deployment
✅ Health Check Endpoint /health implementieren
✅ Production-grade Error Handling
✅ Logging für Debugging aktiviert
✅ Debug-Modus DEAKTIVIERT (NODE_ENV=production)
✅ Keine console.log() oder Debug-Outputs
✅ Graceful Shutdown implementiert
✅ Database Connection Pool mit Error Handling

═══════════════════════════════════════════════════════════════════════════════
```

**Keine zweite Chance - Quality First! 🎯**

---

## 📋 Executive Summary

Du bist der **App Developer Agent** und entwickelst die **UV Simulation App** mit Login-Integration gegen die WordPress-Datenbank.

**Was bereits erledigt ist:**
- ✅ WordPress-Datenbank läuft in Docker (MySQL 8.0)
- ✅ Shared Docker-Netzwerk `db-shared` konfiguriert
- ✅ Read-Only User `external_app` erstellt
- ✅ Traefik-Netzwerk `luvex-network` für Routing bereit

**Deine Aufgabe:**
- 🎯 UV Simulation App mit Docker-Container entwickeln
- 🎯 WordPress-Login-Integration implementieren
- 🎯 Traefik-Routing für externen Zugriff konfigurieren
- 🎯 **Production-ready deployment** (LIVE Environment!)

---

## 🔌 WordPress Datenbank-Verbindung

### Netzwerk-Konfiguration

Die WordPress-Datenbank ist über ein **shared Docker-Netzwerk** erreichbar:

```yaml
networks:
  db-shared:
    external: true      # Bereits erstellt, beitreten!
    name: db-shared
  luvex-network:
    external: true      # Traefik-Routing (optional)
    name: luvex-network
```

### Datenbank-Credentials

| Parameter   | Wert                      | Hinweis                              |
|------------|---------------------------|--------------------------------------|
| **Host**   | `wp-db`                   | Network-Alias im db-shared Netzwerk |
| **Port**   | `3306`                    | Standard MySQL Port                  |
| **Datenbank** | `luvex_production`     | WordPress-Datenbank-Name            |
| **User**   | `external_app`            | Read-Only User                       |
| **Passwort** | `SecurePassword123!`    | ⚠️ In Produktion ändern!            |
| **Berechtigung** | `SELECT` only       | Kein INSERT/UPDATE/DELETE           |

### Environment Variables für deine App

```env
# Database Connection
DB_HOST=wp-db
DB_PORT=3306
DB_NAME=luvex_production
DB_USER=external_app
DB_PASSWORD=SecurePassword123!

# Application Settings
APP_ENV=production
APP_PORT=3000
APP_DOMAIN=uv.luvex.tech  # LIVE Production Domain!
NODE_ENV=production       # CRITICAL: Must be production!
```

---

## 📊 Datenbank-Schema

### Relevante Tabellen

#### 1. `wp_users` - Haupttabelle für User-Daten

```sql
CREATE TABLE wp_users (
  ID                 bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  user_login         varchar(60)  NOT NULL,
  user_pass          varchar(255) NOT NULL,     -- PHPass Hash!
  user_email         varchar(100) NOT NULL,
  user_url           varchar(100) NOT NULL,
  user_registered    datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  user_status        int(11)      NOT NULL DEFAULT '0',
  display_name       varchar(250) NOT NULL,
  PRIMARY KEY (ID),
  KEY user_login_key (user_login),
  KEY user_email     (user_email)
);
```

**Wichtige Spalten:**
- `ID` - Eindeutige User-ID (verwende diese als Primary Key)
- `user_login` - Username (unique)
- `user_pass` - **PHPass Password Hash** (nicht bcrypt!)
- `user_email` - Email (unique)
- `user_status` - `0` = aktiv, `1+` = inaktiv
- `display_name` - Anzeigename im Frontend

#### 2. `wp_usermeta` - Zusätzliche User-Metadaten

```sql
CREATE TABLE wp_usermeta (
  umeta_id    bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  user_id     bigint(20) unsigned NOT NULL DEFAULT '0',
  meta_key    varchar(255) DEFAULT NULL,
  meta_value  longtext,
  PRIMARY KEY (umeta_id),
  KEY user_id (user_id),
  KEY meta_key (meta_key)
);
```

**Wichtige meta_key Werte:**
- `first_name` - Vorname
- `last_name` - Nachname
- `nickname` - Nickname
- `description` - Bio/Beschreibung
- `wp_capabilities` - Rollen (serialized PHP array, z.B. `a:1:{s:13:"administrator";b:1;}`)
- `wp_user_level` - User Level (0-10, deprecated aber noch vorhanden)

### Beispiel-Queries

**Login-Query (Username oder Email):**

```sql
SELECT
    u.ID,
    u.user_login,
    u.user_email,
    u.user_pass,
    u.display_name,
    u.user_status
FROM wp_users u
WHERE (u.user_login = ? OR u.user_email = ?)
  AND u.user_status = 0
LIMIT 1;
```

**User-Metadaten abrufen:**

```sql
SELECT
    u.ID,
    u.user_login,
    u.user_email,
    u.display_name,
    (SELECT meta_value FROM wp_usermeta WHERE user_id = u.ID AND meta_key = 'first_name') as first_name,
    (SELECT meta_value FROM wp_usermeta WHERE user_id = u.ID AND meta_key = 'last_name') as last_name,
    (SELECT meta_value FROM wp_usermeta WHERE user_id = u.ID AND meta_key = 'description') as bio
FROM wp_users u
WHERE u.ID = ?;
```

**Alle aktiven User auflisten:**

```sql
SELECT
    ID,
    user_login,
    user_email,
    display_name,
    user_registered
FROM wp_users
WHERE user_status = 0
ORDER BY user_registered DESC;
```

---

## 🔐 WordPress Password Hashing

### ⚠️ WICHTIG: PHPass, nicht bcrypt!

WordPress verwendet **PHPass** (Portable PHP password hashing framework), **nicht bcrypt**!

**Hash-Format:**
- Beginnt mit `$P$` (WordPress) oder `$H$` (phpBB)
- Beispiel: `$P$B5rT7U8VxjKlMnOpQrStUvWxYz...`

### Implementierung nach Sprache

#### Option 1: PHP (Empfohlen für WordPress-Integration)

```php
<?php
// composer require mysql
require_once __DIR__ . '/vendor/autoload.php';

// WordPress PHPass Hash Functions (native)
require_once('/path/to/wordpress/wp-includes/class-phpass.php');

function authenticateUser($username, $password) {
    $pdo = new PDO(
        'mysql:host=wp-db;dbname=luvex_production;charset=utf8mb4',
        'external_app',
        'SecurePassword123!'
    );

    $stmt = $pdo->prepare(
        "SELECT ID, user_login, user_pass, user_email, display_name
         FROM wp_users
         WHERE (user_login = :username OR user_email = :username)
           AND user_status = 0
         LIMIT 1"
    );

    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        return ['success' => false, 'error' => 'User not found'];
    }

    // WordPress PHPass Verification
    $wp_hasher = new PasswordHash(8, true);

    if ($wp_hasher->CheckPassword($password, $user['user_pass'])) {
        return [
            'success' => true,
            'user' => [
                'id' => $user['ID'],
                'username' => $user['user_login'],
                'email' => $user['user_email'],
                'display_name' => $user['display_name']
            ]
        ];
    }

    return ['success' => false, 'error' => 'Invalid password'];
}

// Usage
$result = authenticateUser($_POST['username'], $_POST['password']);

if ($result['success']) {
    $_SESSION['user_id'] = $result['user']['id'];
    $_SESSION['username'] = $result['user']['username'];
    header('Location: /dashboard');
} else {
    echo "Login failed: " . $result['error'];
}
?>
```

**Dockerfile für PHP:**

```dockerfile
FROM php:8.2-fpm-alpine

# Install dependencies
RUN apk add --no-cache mysql-client
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copy PHPass library
COPY --from=wordpress:latest /usr/src/wordpress/wp-includes/class-phpass.php /app/lib/

WORKDIR /app
COPY . .

CMD ["php-fpm"]
```

#### Option 2: Python (mit passlib)

```python
from passlib.hash import wordpress
import mysql.connector
from flask import Flask, request, jsonify, session

app = Flask(__name__)
app.secret_key = 'your-secret-key-change-in-production'

# Database connection
db_config = {
    'host': 'wp-db',
    'port': 3306,
    'user': 'external_app',
    'password': 'SecurePassword123!',
    'database': 'luvex_production'
}

def get_db():
    return mysql.connector.connect(**db_config)

@app.route('/api/login', methods=['POST'])
def login():
    data = request.get_json()
    username = data.get('username')
    password = data.get('password')

    if not username or not password:
        return jsonify({'success': False, 'error': 'Missing credentials'}), 400

    db = get_db()
    cursor = db.cursor(dictionary=True)

    query = """
        SELECT ID, user_login, user_pass, user_email, display_name, user_status
        FROM wp_users
        WHERE (user_login = %s OR user_email = %s) AND user_status = 0
        LIMIT 1
    """

    cursor.execute(query, (username, username))
    user = cursor.fetchone()

    cursor.close()
    db.close()

    if not user:
        return jsonify({'success': False, 'error': 'User not found'}), 401

    # Verify WordPress password hash
    try:
        if wordpress.verify(password, user['user_pass']):
            session['user_id'] = user['ID']
            session['username'] = user['user_login']

            return jsonify({
                'success': True,
                'user': {
                    'id': user['ID'],
                    'username': user['user_login'],
                    'email': user['user_email'],
                    'display_name': user['display_name']
                }
            })
        else:
            return jsonify({'success': False, 'error': 'Invalid password'}), 401
    except Exception as e:
        return jsonify({'success': False, 'error': str(e)}), 500

@app.route('/api/user/<int:user_id>', methods=['GET'])
def get_user(user_id):
    if 'user_id' not in session:
        return jsonify({'error': 'Not authenticated'}), 401

    db = get_db()
    cursor = db.cursor(dictionary=True)

    query = """
        SELECT
            u.ID,
            u.user_login,
            u.user_email,
            u.display_name,
            u.user_registered,
            (SELECT meta_value FROM wp_usermeta WHERE user_id = u.ID AND meta_key = 'first_name') as first_name,
            (SELECT meta_value FROM wp_usermeta WHERE user_id = u.ID AND meta_key = 'last_name') as last_name
        FROM wp_users u
        WHERE u.ID = %s
    """

    cursor.execute(query, (user_id,))
    user = cursor.fetchone()

    cursor.close()
    db.close()

    if user:
        return jsonify({'success': True, 'user': user})
    else:
        return jsonify({'success': False, 'error': 'User not found'}), 404

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=3000)
```

**requirements.txt:**

```
Flask==3.0.0
mysql-connector-python==8.2.0
passlib==1.7.4
```

**Dockerfile:**

```dockerfile
FROM python:3.12-alpine

WORKDIR /app

# Install dependencies
RUN apk add --no-cache gcc musl-dev mariadb-connector-c-dev

# Python dependencies
COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

# Application code
COPY . .

EXPOSE 3000

CMD ["python", "app.py"]
```

#### Option 3: Node.js (mit wordpress-hash-node)

```javascript
const express = require('express');
const mysql = require('mysql2/promise');
const wpHash = require('wordpress-hash-node');
const session = require('express-session');

const app = express();
app.use(express.json());
app.use(session({
    secret: 'your-secret-key-change-in-production',
    resave: false,
    saveUninitialized: false,
    cookie: { secure: false } // Set to true in production with HTTPS
}));

// Database connection pool
const pool = mysql.createPool({
    host: 'wp-db',
    port: 3306,
    user: 'external_app',
    password: 'SecurePassword123!',
    database: 'luvex_production',
    waitForConnections: true,
    connectionLimit: 10,
    queueLimit: 0
});

// Login endpoint
app.post('/api/login', async (req, res) => {
    const { username, password } = req.body;

    if (!username || !password) {
        return res.status(400).json({
            success: false,
            error: 'Missing credentials'
        });
    }

    try {
        const [rows] = await pool.execute(
            `SELECT ID, user_login, user_pass, user_email, display_name, user_status
             FROM wp_users
             WHERE (user_login = ? OR user_email = ?) AND user_status = 0
             LIMIT 1`,
            [username, username]
        );

        if (rows.length === 0) {
            return res.status(401).json({
                success: false,
                error: 'User not found'
            });
        }

        const user = rows[0];

        // Verify WordPress password hash
        const isValid = wpHash.CheckPassword(password, user.user_pass);

        if (isValid) {
            req.session.userId = user.ID;
            req.session.username = user.user_login;

            return res.json({
                success: true,
                user: {
                    id: user.ID,
                    username: user.user_login,
                    email: user.user_email,
                    display_name: user.display_name
                }
            });
        } else {
            return res.status(401).json({
                success: false,
                error: 'Invalid password'
            });
        }
    } catch (error) {
        console.error('Login error:', error);
        return res.status(500).json({
            success: false,
            error: 'Internal server error'
        });
    }
});

// Get user details
app.get('/api/user/:id', async (req, res) => {
    if (!req.session.userId) {
        return res.status(401).json({ error: 'Not authenticated' });
    }

    try {
        const [rows] = await pool.execute(
            `SELECT
                u.ID,
                u.user_login,
                u.user_email,
                u.display_name,
                u.user_registered,
                (SELECT meta_value FROM wp_usermeta WHERE user_id = u.ID AND meta_key = 'first_name') as first_name,
                (SELECT meta_value FROM wp_usermeta WHERE user_id = u.ID AND meta_key = 'last_name') as last_name
             FROM wp_users u
             WHERE u.ID = ?`,
            [req.params.id]
        );

        if (rows.length === 0) {
            return res.status(404).json({
                success: false,
                error: 'User not found'
            });
        }

        return res.json({
            success: true,
            user: rows[0]
        });
    } catch (error) {
        console.error('Get user error:', error);
        return res.status(500).json({
            success: false,
            error: 'Internal server error'
        });
    }
});

// Logout endpoint
app.post('/api/logout', (req, res) => {
    req.session.destroy((err) => {
        if (err) {
            return res.status(500).json({ error: 'Logout failed' });
        }
        res.json({ success: true, message: 'Logged out' });
    });
});

const PORT = process.env.APP_PORT || 3000;
app.listen(PORT, '0.0.0.0', () => {
    console.log(`UV Simulation App listening on port ${PORT}`);
});
```

**package.json:**

```json
{
  "name": "uv-simulation-app",
  "version": "1.0.0",
  "description": "UV Simulation App with WordPress integration",
  "main": "server.js",
  "scripts": {
    "start": "node server.js",
    "dev": "nodemon server.js"
  },
  "dependencies": {
    "express": "^4.18.2",
    "express-session": "^1.17.3",
    "mysql2": "^3.6.5",
    "wordpress-hash-node": "^1.1.0"
  },
  "devDependencies": {
    "nodemon": "^3.0.2"
  }
}
```

**Dockerfile:**

```dockerfile
FROM node:20-alpine

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm ci --only=production

# Copy application code
COPY . .

EXPOSE 3000

CMD ["npm", "start"]
```

---

## 🐳 Docker Compose Konfiguration

### Vollständige docker-compose.yml für UV Simulation App

```yaml
version: '3.8'

# ═══════════════════════════════════════════════════════════════════════════════
# UV SIMULATION APP - WordPress Integration
# 🔴 LIVE PRODUCTION DEPLOYMENT
# ═══════════════════════════════════════════════════════════════════════════════

services:
  uv-simulation-app:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: uv-simulation-app
    restart: unless-stopped

    # Environment variables
    environment:
      # Database connection
      DB_HOST: wp-db
      DB_PORT: 3306
      DB_NAME: luvex_production
      DB_USER: external_app
      DB_PASSWORD: ${DB_PASSWORD:-SecurePassword123!}

      # Application settings (PRODUCTION!)
      APP_ENV: production
      APP_PORT: 3000
      NODE_ENV: production
      APP_DOMAIN: uv.luvex.tech

    # Networks - WICHTIG!
    networks:
      - db-shared        # Für Datenbank-Zugriff
      - luvex-network    # Für Traefik-Routing

    # Traefik Labels für externen Zugriff (PRODUCTION!)
    labels:
      - "traefik.enable=true"
      - "traefik.http.routers.uv-simulation.rule=Host(`uv.luvex.tech`)"
      - "traefik.http.routers.uv-simulation.entrypoints=websecure"
      - "traefik.http.routers.uv-simulation.tls=true"
      - "traefik.http.routers.uv-simulation.tls.certresolver=letsencrypt"
      - "traefik.http.routers.uv-simulation.service=uv-simulation"
      - "traefik.http.services.uv-simulation.loadbalancer.server.port=3000"
      - "traefik.http.routers.uv-simulation.middlewares=compression@file"

    # Health check
    healthcheck:
      test: ["CMD", "wget", "--quiet", "--tries=1", "--spider", "http://localhost:3000/health"]
      interval: 30s
      timeout: 10s
      retries: 3
      start_period: 40s

    # Volumes (optional - für persistent sessions, logs, etc.)
    volumes:
      - app-data:/app/data
      - app-logs:/app/logs

# ═══════════════════════════════════════════════════════════════════════════════
# DOCKER NETWORKS
# ═══════════════════════════════════════════════════════════════════════════════
networks:
  db-shared:
    external: true
    name: db-shared
  luvex-network:
    external: true
    name: luvex-network

# ═══════════════════════════════════════════════════════════════════════════════
# DOCKER VOLUMES
# ═══════════════════════════════════════════════════════════════════════════════
volumes:
  app-data:
    driver: local
  app-logs:
    driver: local
```

### Environment Variables (.env für UV Simulation App)

```env
# ═══════════════════════════════════════════════════════════════════════════════
# UV SIMULATION APP - Environment Configuration
# 🔴 LIVE PRODUCTION DEPLOYMENT
# ═══════════════════════════════════════════════════════════════════════════════

# Database Connection (WordPress Production DB)
DB_HOST=wp-db
DB_PORT=3306
DB_NAME=luvex_production
DB_USER=external_app
DB_PASSWORD=SecurePassword123!

# Application Settings (PRODUCTION!)
APP_ENV=production
APP_PORT=3000
APP_DOMAIN=uv.luvex.tech
NODE_ENV=production

# Session Secret (Generate with: openssl rand -hex 32)
SESSION_SECRET=CHANGE_THIS_TO_RANDOM_STRING

# Logging
LOG_LEVEL=info
LOG_FILE=/app/logs/app.log

# CORS (if needed)
CORS_ORIGIN=https://luvex.tech,https://www.luvex.tech,https://uv.luvex.tech
```

---

## 🚦 Health Check Endpoint

**Implementiere einen /health endpoint:**

```javascript
// Node.js Example
app.get('/health', async (req, res) => {
    try {
        // Check database connection
        const [rows] = await pool.execute('SELECT 1 as healthy');

        if (rows[0].healthy === 1) {
            return res.json({
                status: 'healthy',
                timestamp: new Date().toISOString(),
                database: 'connected'
            });
        }
    } catch (error) {
        return res.status(503).json({
            status: 'unhealthy',
            error: error.message
        });
    }
});
```

---

## 🧪 Testing & Deployment

### 1. Lokales Testing

```bash
# Build Image
docker build -t uv-simulation-app:dev .

# Test mit db-shared Netzwerk
docker run --rm \
  --network db-shared \
  -e DB_HOST=wp-db \
  -e DB_USER=external_app \
  -e DB_PASSWORD=SecurePassword123! \
  -e DB_NAME=luvex_production \
  -e NODE_ENV=production \
  -p 3000:3000 \
  uv-simulation-app:dev

# Login testen
curl -X POST http://localhost:3000/api/login \
  -H "Content-Type: application/json" \
  -d '{"username":"admin","password":"your-password"}'
```

### 2. Production Deployment 🔴 LIVE!

```bash
# Auf Production Server (srv1117211)
cd /opt/apps/uv-simulation-app

# Repository klonen
git clone https://github.com/Valerian92/uv-simulation-app.git .

# .env konfigurieren
cp .env.example .env
nano .env  # Passwörter eintragen

# Container starten (PRODUCTION!)
docker-compose up -d

# Logs prüfen
docker-compose logs -f uv-simulation-app

# Health check (IMPORTANT!)
curl https://uv.luvex.tech/health
```

### 3. Traefik SSL Auto-Renewal

Traefik generiert automatisch Let's Encrypt Zertifikate für `uv.luvex.tech`, wenn:

1. **DNS A-Record** existiert: `uv.luvex.tech` → Server-IP
2. **Traefik Labels** korrekt gesetzt (siehe docker-compose.yml)
3. **Port 80/443** erreichbar vom Internet

---

## 📚 Zusätzliche Features (Optional)

### 1. User-Rollen aus wp_usermeta auslesen

```javascript
async function getUserRoles(userId) {
    const [rows] = await pool.execute(
        `SELECT meta_value
         FROM wp_usermeta
         WHERE user_id = ? AND meta_key = 'wp_capabilities'
         LIMIT 1`,
        [userId]
    );

    if (rows.length === 0) return [];

    // Parse PHP serialized array
    // z.B.: a:1:{s:13:"administrator";b:1;}
    // Du brauchst eine PHP-Unserialize Library:
    // npm install phpunserialize

    const phpUnserialize = require('phpunserialize');
    const capabilities = phpUnserialize(rows[0].meta_value);

    return Object.keys(capabilities);
}
```

### 2. Rate Limiting (Schutz vor Brute-Force)

```javascript
const rateLimit = require('express-rate-limit');

const loginLimiter = rateLimit({
    windowMs: 15 * 60 * 1000, // 15 Minuten
    max: 5, // Max 5 Versuche
    message: 'Too many login attempts, please try again later.'
});

app.post('/api/login', loginLimiter, async (req, res) => {
    // Login logic
});
```

### 3. JWT Tokens (statt Sessions)

```javascript
const jwt = require('jsonwebtoken');

// Nach erfolgreicher Authentifizierung:
const token = jwt.sign(
    {
        userId: user.ID,
        username: user.user_login,
        email: user.user_email
    },
    process.env.JWT_SECRET,
    { expiresIn: '24h' }
);

res.json({
    success: true,
    token: token,
    user: { /* user data */ }
});
```

---

## ✅ Checkliste für App Developer

### Setup & Konfiguration
- [ ] Repository `Valerian92/uv-simulation-app` erstellt
- [ ] Dockerfile geschrieben
- [ ] docker-compose.yml mit db-shared + luvex-network konfiguriert
- [ ] .env Datei mit DB-Credentials erstellt
- [ ] Health-Check Endpoint `/health` implementiert
- [ ] **NODE_ENV=production** gesetzt ⚠️ PFLICHT!

### Authentifizierung
- [ ] WordPress PHPass Library integriert
- [ ] Login-Endpoint mit Username/Email Support
- [ ] Password-Verifikation gegen wp_users Tabelle
- [ ] Session/Token Management implementiert
- [ ] Logout-Funktion implementiert

### Datenbank-Integration
- [ ] MySQL Connection Pool konfiguriert
- [ ] Read-Only Zugriff auf wp_users verifiziert
- [ ] User-Metadaten aus wp_usermeta abrufbar
- [ ] Error Handling für DB-Verbindungen

### Security
- [ ] Rate Limiting für Login-Endpoint
- [ ] HTTPS-Only in Production (via Traefik)
- [ ] Secrets in .env (nicht hardcoded!)
- [ ] SQL Injection Protection (Prepared Statements)

### Deployment 🔴 PRODUCTION!
- [ ] Traefik Labels mit `uv.luvex.tech` konfiguriert
- [ ] DNS A-Record für `uv.luvex.tech` erstellt/verifiziert
- [ ] SSL-Zertifikat via Traefik Let's Encrypt
- [ ] Production Build getestet (NODE_ENV=production)
- [ ] Logs & Monitoring eingerichtet
- [ ] Debug-Outputs entfernt (keine console.log in production)
- [ ] Error Handling implementiert
- [ ] Graceful Shutdown implementiert
- [ ] **Infrastructure Feedback Report erstellt** ⚠️ PFLICHT!

### Testing 🔴 PRODUCTION!
- [ ] Login mit WordPress-User erfolgreich getestet
- [ ] External DB-Zugriff via wp-db funktioniert
- [ ] Health-Check Endpoint `/health` antwortet
- [ ] `https://uv.luvex.tech/health` returns 200 OK
- [ ] HTTPS-Redirect funktioniert (HTTP → HTTPS)
- [ ] Keine Fehler in Production Logs
- [ ] Performance-Test durchgeführt

---

## 🎯 Success Criteria

Die Integration ist erfolgreich, wenn:

1. ✅ UV Simulation App läuft als Docker-Container
2. ✅ Login mit WordPress-Credentials funktioniert
3. ✅ Passwort-Hashing (PHPass) korrekt verifiziert
4. ✅ App ist extern erreichbar über `https://uv.luvex.tech`
5. ✅ SSL-Zertifikat von Let's Encrypt aktiv
6. ✅ Keine Schreib-Zugriffe auf WordPress-DB (Read-Only!)
7. ✅ Health-Check gibt "healthy" zurück (`/health` returns 200)
8. ✅ Logs zeigen keine kritischen Fehler
9. ✅ NODE_ENV=production gesetzt (keine Debug-Outputs)
10. ✅ **Infrastructure Feedback Report erstellt und committed** ⚠️ PFLICHT!

---

## 📋 PFLICHT: Infrastructure Feedback Report

### ⚠️ WICHTIG: Am Ende deiner Arbeit MUSS dieser Report erstellt werden!

Nach erfolgreicher Implementierung und Deployment der UV Simulation App **MUSST** du einen **Infrastructure Feedback Report** erstellen. Dieser Report wird vom Infrastructure Architect benötigt, um die App in die zentralen Management-Scripts (`master-deploy.sh`, `backend-logs.sh`, etc.) zu integrieren.

### Report-Format (Copy & Paste bereit)

```
═══════════════════════════════════════════════════════════════════════════════
INFRASTRUCTURE FEEDBACK REPORT - UV SIMULATION APP
═══════════════════════════════════════════════════════════════════════════════

## Deployment Info

Repository:       Valerian92/uv-simulation-app
VPS Path:         /opt/apps/uv-simulation-app
Branch:           main
Container Name:   uv-simulation-app
Environment:      🔴 PRODUCTION (LIVE!)

## Public Access

Domain:           https://uv.luvex.tech
Health Check:     /health
Full Health URL:  https://uv.luvex.tech/health
HTTP Status:      200 = healthy, 503 = unhealthy

## Networks (FIXED - Do Not Change!)

Traefik:          luvex-network ✓
Database:         db-shared ✓

## Environment Variables

DB_HOST:          wp-db
DB_PORT:          3306
DB_NAME:          luvex_production
DB_USER:          external_app
DB_PASSWORD:      [CONFIGURED IN .env]
NODE_ENV:         production

## Logs Location

Application:      docker logs uv-simulation-app
Access Logs:      /app/logs/access.log (if configured)
Error Logs:       /app/logs/error.log (if configured)

## For Scripts Integration

Display Name:     UV Simulation App
Service Name:     uv-simulation-app
Service Type:     Web App with WordPress Login Integration
Docker Compose:   /opt/apps/uv-simulation-app/docker-compose.yml

═══════════════════════════════════════════════════════════════════════════════
```

### ⚠️ Für UV Simulation App: Werte sind FIXIERT!

**Diese Werte sind bereits korrekt und MÜSSEN verwendet werden:**

| Parameter | Wert | Status |
|------------|----------|---------|
| Repository | `Valerian92/uv-simulation-app` | ✅ FIXIERT |
| VPS Path | `/opt/apps/uv-simulation-app` | ✅ FIXIERT |
| Branch | `main` | ✅ FIXIERT |
| Container Name | `uv-simulation-app` | ✅ FIXIERT |
| Domain | `https://uv.luvex.tech` | ✅ FIXIERT |
| Health Check | `/health` | ✅ FIXIERT |
| Display Name | `UV Simulation App` | ✅ FIXIERT |
| Environment | `PRODUCTION (LIVE!)` | 🔴 CRITICAL!

### Warum ist dieser Report wichtig?

Der Infrastructure Architect nutzt diese Informationen für:

1. **master-deploy.sh** - Zentrales Deployment-Script
   - Fügt deine App zur Liste hinzu
   - Ermöglicht `./master-deploy.sh uv-simulation-app`

2. **backend-logs.sh** - Zentrales Logging
   - Integriert deine Logs
   - Ermöglicht `./backend-logs.sh uv-simulation-app`

3. **health-check.sh** - Monitoring
   - Überwacht Health-Endpoint
   - Alerts bei Problemen

4. **Dokumentation** - Infrastructure Overview
   - Komplette Service-Übersicht
   - Dependency-Graph

### Exakter Report für UV Simulation App

**Verwende EXAKT diese Werte (Copy & Paste!):**

```
Display Name:     UV Simulation App
Service Name:     uv-simulation-app
Container Name:   uv-simulation-app
Domain:           https://uv.luvex.tech
Health Check:     /health
Repository:       Valerian92/uv-simulation-app
VPS Path:         /opt/apps/uv-simulation-app
Branch:           main
Environment:      PRODUCTION (LIVE!)
```

**⚠️ WICHTIG:** Keine Abweichungen erlaubt - diese Werte sind FEST definiert!

### Wo soll der Report erstellt werden?

**Option 1: In einem Markdown-File (Empfohlen)**

Erstelle eine Datei im Root deines Repositories:

```bash
touch INFRASTRUCTURE_REPORT.md
```

**Option 2: Am Ende deiner README.md**

Füge einen Abschnitt `## Infrastructure Details` hinzu.

**Option 3: Als Kommentar im finalen Commit**

Füge den Report in den Git Commit-Body ein:

```bash
git commit -m "feat: UV Simulation App deployment complete" -m "
[INFRASTRUCTURE REPORT]
Repository: Valerian92/uv-simulation-app
Domain: https://uv.luvex.tech
Environment: PRODUCTION (LIVE!)
..."
```

### Checkliste vor Report-Erstellung 🔴 PRODUCTION!

Stelle sicher, dass folgendes funktioniert:

- [ ] Container läuft ohne Fehler (`docker ps`)
- [ ] Health-Check Endpoint antwortet (`curl https://uv.luvex.tech/health`)
- [ ] Domain ist über HTTPS erreichbar (`https://uv.luvex.tech`)
- [ ] SSL-Zertifikat ist gültig (Let's Encrypt)
- [ ] Login mit WordPress-User funktioniert
- [ ] **NODE_ENV=production** gesetzt (CRITICAL!)
- [ ] Keine Debug-Outputs in Logs
- [ ] Logs zeigen keine kritischen Fehler
- [ ] .env Datei ist konfiguriert (nicht im Git!)
- [ ] README.md enthält Setup-Anleitung

---

## 📞 Support & Troubleshooting

### Hilfreiche Commands

```bash
# Container-Logs (PRODUCTION!)
docker-compose logs -f uv-simulation-app

# Database-Verbindung testen
docker exec -it uv-simulation-app sh
nc -zv wp-db 3306

# Health Check testen
curl https://uv.luvex.tech/health
curl -I https://uv.luvex.tech

# Traefik-Logs
docker logs traefik

# Netzwerk-Inspektion
docker network inspect db-shared
docker network inspect luvex-network

# Production Logs (Error-Suche)
docker logs uv-simulation-app --tail 100 | grep -i error
docker logs uv-simulation-app --follow
```

### Häufige Probleme

Siehe: `STUDENT_APP_INTEGRATION.md` → Troubleshooting Section

---

## 🚀 Let's Build! 🔴 LIVE PRODUCTION!

Du hast jetzt alle Informationen, um die **UV Simulation App** zu entwickeln!

**Nächste Schritte:**

1. Wähle deine Programmiersprache (PHP, Python, Node.js)
2. Erstelle Dockerfile und docker-compose.yml
3. Implementiere Login-Logik mit PHPass
4. Teste lokal mit db-shared Netzwerk
5. **⚠️ Sorgfältiges Testing** (PRODUCTION Deployment!)
6. Deploy auf Production Server (`/opt/apps/uv-simulation-app`)
7. Konfiguriere Traefik-Routing (`uv.luvex.tech`)
8. Health Check `/health` verifizieren
9. **Erstelle Infrastructure Feedback Report** ⚠️ PFLICHT!

**🔴 ACHTUNG: Production Deployment - Quality First! 🎯**

---

**Version:** 2.0 (UV Simulation App - Production)
**Erstellt:** 2026-01-15
**Aktualisiert:** 2026-01-15 (Production Ready)
**Author:** WordPress DevOps Agent
**Next Agent:** App Developer Agent
**Target:** `https://uv.luvex.tech` (LIVE PRODUCTION!)
