# 🚀 Prompt für App Developer Agent - Studenten-Verwaltungs-App

> **Status:** WordPress DevOps Setup ✅ ABGESCHLOSSEN
> **Nächster Schritt:** App Development mit WordPress-Login-Integration

---

## 📋 Executive Summary

Du bist der **App Developer Agent** und entwickelst eine **Studenten-Verwaltungs-App** mit Login-Integration gegen die WordPress-Datenbank.

**Was bereits erledigt ist:**
- ✅ WordPress-Datenbank läuft in Docker (MySQL 8.0)
- ✅ Shared Docker-Netzwerk `db-shared` konfiguriert
- ✅ Read-Only User `external_app` erstellt
- ✅ Traefik-Netzwerk `luvex-network` für Routing bereit

**Deine Aufgabe:**
- 🎯 Studenten-App mit Docker-Container entwickeln
- 🎯 WordPress-Login-Integration implementieren
- 🎯 Traefik-Routing für externen Zugriff konfigurieren
- 🎯 Production-ready deployment vorbereiten

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
APP_DOMAIN=students.luvex.tech  # Beispiel-Subdomain
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
    console.log(`Student app listening on port ${PORT}`);
});
```

**package.json:**

```json
{
  "name": "luvex-student-app",
  "version": "1.0.0",
  "description": "Student management app with WordPress integration",
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

### Vollständige docker-compose.yml für Student App

```yaml
version: '3.8'

# ═══════════════════════════════════════════════════════════════════════════════
# STUDENT MANAGEMENT APP - WordPress Integration
# ═══════════════════════════════════════════════════════════════════════════════

services:
  student-app:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: student-app
    restart: unless-stopped

    # Environment variables
    environment:
      # Database connection
      DB_HOST: wp-db
      DB_PORT: 3306
      DB_NAME: luvex_production
      DB_USER: external_app
      DB_PASSWORD: ${DB_PASSWORD:-SecurePassword123!}

      # Application settings
      APP_ENV: production
      APP_PORT: 3000
      NODE_ENV: production

    # Networks - WICHTIG!
    networks:
      - db-shared        # Für Datenbank-Zugriff
      - luvex-network    # Für Traefik-Routing

    # Traefik Labels für externen Zugriff
    labels:
      - "traefik.enable=true"
      - "traefik.http.routers.student-app.rule=Host(`students.luvex.tech`)"
      - "traefik.http.routers.student-app.entrypoints=websecure"
      - "traefik.http.routers.student-app.tls=true"
      - "traefik.http.routers.student-app.tls.certresolver=letsencrypt"
      - "traefik.http.routers.student-app.service=student-app"
      - "traefik.http.services.student-app.loadbalancer.server.port=3000"
      - "traefik.http.routers.student-app.middlewares=compression@file"

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

### Environment Variables (.env für Student App)

```env
# ═══════════════════════════════════════════════════════════════════════════════
# STUDENT APP - Environment Configuration
# ═══════════════════════════════════════════════════════════════════════════════

# Database Connection (WordPress)
DB_HOST=wp-db
DB_PORT=3306
DB_NAME=luvex_production
DB_USER=external_app
DB_PASSWORD=SecurePassword123!

# Application Settings
APP_ENV=production
APP_PORT=3000
APP_DOMAIN=students.luvex.tech

# Session Secret (Generate with: openssl rand -hex 32)
SESSION_SECRET=CHANGE_THIS_TO_RANDOM_STRING

# Logging
LOG_LEVEL=info
LOG_FILE=/app/logs/app.log

# CORS (if needed)
CORS_ORIGIN=https://luvex.tech,https://www.luvex.tech
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
docker build -t student-app:dev .

# Test mit db-shared Netzwerk
docker run --rm \
  --network db-shared \
  -e DB_HOST=wp-db \
  -e DB_USER=external_app \
  -e DB_PASSWORD=SecurePassword123! \
  -e DB_NAME=luvex_production \
  -p 3000:3000 \
  student-app:dev

# Login testen
curl -X POST http://localhost:3000/api/login \
  -H "Content-Type: application/json" \
  -d '{"username":"admin","password":"your-password"}'
```

### 2. Production Deployment

```bash
# Auf Production Server (srv1117211)
cd /opt/apps/student-app

# Repository klonen
git clone https://github.com/YOUR_ORG/student-app.git .

# .env konfigurieren
cp .env.example .env
nano .env  # Passwörter eintragen

# Container starten
docker-compose up -d

# Logs prüfen
docker-compose logs -f student-app

# Health check
curl https://students.luvex.tech/health
```

### 3. Traefik SSL Auto-Renewal

Traefik generiert automatisch Let's Encrypt Zertifikate für `students.luvex.tech`, wenn:

1. **DNS A-Record** existiert: `students.luvex.tech` → Server-IP
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
- [ ] Repository für Student-App erstellt
- [ ] Dockerfile geschrieben
- [ ] docker-compose.yml mit db-shared + luvex-network konfiguriert
- [ ] .env Datei mit DB-Credentials erstellt
- [ ] Health-Check Endpoint implementiert

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

### Deployment
- [ ] Traefik Labels konfiguriert
- [ ] DNS A-Record für students.luvex.tech erstellt
- [ ] SSL-Zertifikat via Traefik Let's Encrypt
- [ ] Production Build getestet
- [ ] Logs & Monitoring eingerichtet

### Testing
- [ ] Login mit WordPress-User erfolgreich
- [ ] External DB-Zugriff via wp-db funktioniert
- [ ] Health-Check Endpoint antwortet
- [ ] HTTPS-Redirect funktioniert
- [ ] Performance-Test durchgeführt

---

## 🎯 Success Criteria

Die Integration ist erfolgreich, wenn:

1. ✅ Student-App läuft als Docker-Container
2. ✅ Login mit WordPress-Credentials funktioniert
3. ✅ Passwort-Hashing (PHPass) korrekt verifiziert
4. ✅ App ist extern erreichbar über `https://students.luvex.tech`
5. ✅ SSL-Zertifikat von Let's Encrypt aktiv
6. ✅ Keine Schreib-Zugriffe auf WordPress-DB (Read-Only!)
7. ✅ Health-Check gibt "healthy" zurück
8. ✅ Logs zeigen keine Fehler

---

## 📞 Support & Troubleshooting

### Hilfreiche Commands

```bash
# Container-Logs
docker-compose logs -f student-app

# Database-Verbindung testen
docker exec -it student-app sh
nc -zv wp-db 3306

# Traefik-Logs
docker logs traefik

# Netzwerk-Inspektion
docker network inspect db-shared
docker network inspect luvex-network
```

### Häufige Probleme

Siehe: `STUDENT_APP_INTEGRATION.md` → Troubleshooting Section

---

## 🚀 Let's Build!

Du hast jetzt alle Informationen, um die Student-App zu entwickeln!

**Nächste Schritte:**

1. Wähle deine Programmiersprache (PHP, Python, Node.js)
2. Erstelle Dockerfile und docker-compose.yml
3. Implementiere Login-Logik mit PHPass
4. Teste lokal mit db-shared Netzwerk
5. Deploy auf Production Server
6. Konfiguriere Traefik-Routing

**Viel Erfolg! 🎉**

---

**Version:** 1.0
**Erstellt:** 2026-01-15
**Author:** WordPress DevOps Agent
**Next Agent:** App Developer Agent
