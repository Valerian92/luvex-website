# 🎓 LUVEX.TECH - Student App Integration Guide

> **Purpose:** Integration einer externen Studenten-Verwaltungs-App mit der WordPress-Datenbank für gemeinsame Benutzer-Authentifizierung

---

## 📋 Überblick

Diese Integration ermöglicht es einer externen Studenten-App, WordPress-Benutzer für die Authentifizierung zu verwenden. Die App erhält **Read-Only Zugriff** auf die WordPress-Datenbank über ein gemeinsames Docker-Netzwerk.

### Architektur

```
┌─────────────────────────────────────────────────────────────┐
│                    Docker Networks                          │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  ┌──────────────────┐         ┌──────────────────┐        │
│  │  luvex-network   │         │    db-shared     │        │
│  │                  │         │                  │        │
│  │  ┌──────────┐    │         │   ┌──────────┐  │        │
│  │  │WordPress │◄───┼─────────┼──►│  MySQL   │  │        │
│  │  │   App    │    │         │   │ (wp-db)  │  │        │
│  │  └──────────┘    │         │   └──────────┘  │        │
│  │                  │         │         ▲        │        │
│  │  ┌──────────┐    │         │         │        │        │
│  │  │  Nginx   │    │         │   ┌─────┴─────┐ │        │
│  │  │(Traefik) │    │         │   │ Student   │ │        │
│  │  └──────────┘    │         │   │   App     │ │        │
│  │                  │         │   └───────────┘ │        │
│  └──────────────────┘         └──────────────────┘        │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

---

## 🚀 Schnellstart

### Option 1: Automatisches Setup (Empfohlen)

```bash
# 1. Backups in backups/ Verzeichnis kopieren
cp backup.sql backups/
cp final_backup.tar.gz backups/

# 2. Setup-Script ausführen
./setup-student-app-integration.sh
```

Das Script führt automatisch alle Schritte aus:
- ✅ Docker-Netzwerke erstellen
- ✅ MySQL-Container starten
- ✅ Datenbank wiederherstellen
- ✅ WordPress-Dateien wiederherstellen
- ✅ Externen DB-User erstellen
- ✅ Zugriff testen

### Option 2: Manuelle Einrichtung

Siehe [Manuelle Installation](#manuelle-installation) weiter unten.

---

## 🔧 Konfigurationsdetails

### Docker Networks

Zwei Docker-Netzwerke werden verwendet:

1. **luvex-network** (intern)
   - Verbindet WordPress, MySQL und Nginx
   - Isoliert von anderen Apps
   - Wird von Traefik verwaltet

2. **db-shared** (extern shared)
   - Ermöglicht externen App-Zugriff auf MySQL
   - MySQL ist als `wp-db` erreichbar
   - Studenten-App muss diesem Netzwerk beitreten

### Datenbank-Verbindung für Studenten-App

```yaml
# In der Student-App docker-compose.yml:
services:
  student-app:
    image: your-student-app:latest
    container_name: student-app
    networks:
      - db-shared        # Für DB-Zugriff
      - luvex-network    # Für Traefik-Routing (optional)
    environment:
      DB_HOST: wp-db
      DB_PORT: 3306
      DB_NAME: luvex_production
      DB_USER: external_app
      DB_PASSWORD: SecurePassword123!  # ⚠️ In Produktion ändern!

networks:
  db-shared:
    external: true
  luvex-network:
    external: true
```

---

## 🔐 Sicherheit

### Datenbank-Benutzer: `external_app`

**Berechtigungen:**
- ✅ **SELECT** auf `luvex_production.*` (read-only)
- ❌ **Keine** INSERT, UPDATE, DELETE Rechte
- ❌ **Keine** CREATE, DROP, ALTER Rechte

**Host-Zugriff:**
- `'external_app'@'%'` - Zugriff von jedem Container im `db-shared` Netzwerk

### Passwort-Sicherheit

⚠️ **WICHTIG:** Standard-Passwort `SecurePassword123!` **MUSS** in Produktion geändert werden!

**Passwort ändern:**

```bash
# 1. In setup-external-db-user.sql ändern:
# Zeile 14: IDENTIFIED BY 'DEIN_SICHERES_PASSWORT'

# 2. Script erneut ausführen oder manuell in MySQL:
docker exec -it luvex-mysql mysql -u root -p

# In MySQL:
ALTER USER 'external_app'@'%' IDENTIFIED BY 'NEUES_SICHERES_PASSWORT';
FLUSH PRIVILEGES;
```

**Starkes Passwort generieren:**

```bash
openssl rand -base64 32
```

---

## 📊 WordPress-Datenbank-Schema

### Relevante Tabellen für Student-App

#### `wp_users` - Benutzer-Daten

| Spalte          | Typ          | Beschreibung                                    |
|-----------------|--------------|------------------------------------------------|
| `ID`            | bigint(20)   | Eindeutige User-ID (Primary Key)              |
| `user_login`    | varchar(60)  | Username für Login                             |
| `user_pass`     | varchar(255) | Password Hash (PHPass-Format)                  |
| `user_email`    | varchar(100) | Email-Adresse                                  |
| `user_status`   | int(11)      | 0 = aktiv, 1+ = inaktiv                       |
| `user_registered`| datetime    | Registrierungsdatum                            |
| `display_name`  | varchar(250) | Anzeigename                                    |

#### `wp_usermeta` - Zusätzliche User-Daten

| Spalte       | Typ           | Beschreibung                                     |
|--------------|---------------|--------------------------------------------------|
| `umeta_id`   | bigint(20)    | Meta-ID (Primary Key)                           |
| `user_id`    | bigint(20)    | Foreign Key zu wp_users.ID                      |
| `meta_key`   | varchar(255)  | Metadata-Schlüssel (z.B. 'first_name')         |
| `meta_value` | longtext      | Metadata-Wert                                   |

**Wichtige meta_keys:**
- `first_name` - Vorname
- `last_name` - Nachname
- `wp_capabilities` - Rollen (serialized PHP array)
- `description` - Bio/Beschreibung

---

## 🔑 WordPress-Passwort-Hashing

WordPress verwendet das **PHPass**-Hashing-Verfahren (Portable PHP password hashing framework).

### Passwort-Verifikation in verschiedenen Sprachen

#### PHP (Native WordPress)

```php
// WordPress lädt automatisch Hashing-Funktionen
require_once('./wp-includes/class-phpass.php');

$username = $_POST['username'];
$password = $_POST['password'];

// Query user from database
$user = $wpdb->get_row($wpdb->prepare(
    "SELECT ID, user_login, user_pass, user_email
     FROM wp_users
     WHERE user_login = %s OR user_email = %s",
    $username, $username
));

if ($user && wp_check_password($password, $user->user_pass)) {
    // Login erfolgreich
    echo "Welcome, " . $user->user_login;
} else {
    // Login fehlgeschlagen
    echo "Invalid credentials";
}
```

#### Python (mit passlib)

```python
from passlib.hash import wordpress
import mysql.connector

# Database connection
db = mysql.connector.connect(
    host="wp-db",
    port=3306,
    user="external_app",
    password="SecurePassword123!",
    database="luvex_production"
)

cursor = db.cursor(dictionary=True)

# Get user
username = input("Username: ")
password = input("Password: ")

cursor.execute(
    "SELECT ID, user_login, user_pass, user_email "
    "FROM wp_users WHERE user_login = %s OR user_email = %s",
    (username, username)
)

user = cursor.fetchone()

if user and wordpress.verify(password, user['user_pass']):
    print(f"Welcome, {user['user_login']}")
else:
    print("Invalid credentials")

cursor.close()
db.close()
```

**Installation:**
```bash
pip install passlib mysql-connector-python
```

#### Node.js (mit wordpress-hash-node)

```javascript
const mysql = require('mysql2/promise');
const wpHash = require('wordpress-hash-node');

async function login(username, password) {
    const connection = await mysql.createConnection({
        host: 'wp-db',
        port: 3306,
        user: 'external_app',
        password: 'SecurePassword123!',
        database: 'luvex_production'
    });

    const [rows] = await connection.execute(
        'SELECT ID, user_login, user_pass, user_email ' +
        'FROM wp_users WHERE user_login = ? OR user_email = ?',
        [username, username]
    );

    if (rows.length === 0) {
        return { success: false, message: 'User not found' };
    }

    const user = rows[0];
    const isValid = wpHash.CheckPassword(password, user.user_pass);

    await connection.end();

    if (isValid) {
        return { success: true, user: user };
    } else {
        return { success: false, message: 'Invalid password' };
    }
}

// Usage
login('admin', 'password123')
    .then(result => console.log(result))
    .catch(err => console.error(err));
```

**Installation:**
```bash
npm install mysql2 wordpress-hash-node
```

#### Go (mit custom PHPass Implementation)

```go
package main

import (
    "database/sql"
    "fmt"
    _ "github.com/go-sql-driver/mysql"
    "golang.org/x/crypto/bcrypt"
)

// Hinweis: Für PHPass gibt es Go-Libraries wie:
// github.com/defuse/password-hashing/go
// oder eigene Implementation basierend auf PHPass-Spezifikation

func login(username, password string) error {
    dsn := "external_app:SecurePassword123!@tcp(wp-db:3306)/luvex_production"
    db, err := sql.Open("mysql", dsn)
    if err != nil {
        return err
    }
    defer db.Close()

    var userID int
    var userLogin, userPass, userEmail string

    query := `SELECT ID, user_login, user_pass, user_email
              FROM wp_users WHERE user_login = ? OR user_email = ?`

    err = db.QueryRow(query, username, username).Scan(
        &userID, &userLogin, &userPass, &userEmail,
    )

    if err != nil {
        return fmt.Errorf("user not found")
    }

    // PHPass verification (vereinfacht - use proper library!)
    // Import: github.com/defuse/password-hashing/go
    if verifyPHPass(password, userPass) {
        fmt.Printf("Welcome, %s\n", userLogin)
        return nil
    }

    return fmt.Errorf("invalid password")
}
```

---

## 🧪 Testing

### 1. Netzwerk-Konnektivität testen

```bash
# Prüfen ob db-shared Netzwerk existiert
docker network inspect db-shared

# Prüfen ob MySQL im Netzwerk ist
docker network inspect db-shared | grep luvex-mysql
```

### 2. Datenbank-Zugriff testen

```bash
# Von externem Container
docker run --rm --network db-shared mysql:8.0 \
  mysql -h wp-db -u external_app -pSecurePassword123! \
  -e "SELECT COUNT(*) as total_users FROM luvex_production.wp_users;"
```

### 3. User-Daten abfragen

```bash
# Alle Benutzer anzeigen
docker run --rm --network db-shared mysql:8.0 \
  mysql -h wp-db -u external_app -pSecurePassword123! \
  -e "SELECT ID, user_login, user_email FROM luvex_production.wp_users;"

# Spezifischen User suchen
docker run --rm --network db-shared mysql:8.0 \
  mysql -h wp-db -u external_app -pSecurePassword123! \
  -e "SELECT * FROM luvex_production.wp_users WHERE user_login = 'admin';"
```

### 4. Password-Hash-Format prüfen

```bash
docker run --rm --network db-shared mysql:8.0 \
  mysql -h wp-db -u external_app -pSecurePassword123! \
  -e "SELECT user_login, LEFT(user_pass, 10) as hash_prefix FROM luvex_production.wp_users LIMIT 1;"
```

WordPress PHPass Hash beginnt typischerweise mit `$P$` oder `$H$`.

---

## 📁 Manuelle Installation

Falls das automatische Setup-Script nicht verwendet werden kann:

### Schritt 1: Docker-Netzwerke erstellen

```bash
docker network create luvex-network
docker network create db-shared
```

### Schritt 2: Container starten

```bash
docker-compose up -d mysql
```

### Schritt 3: Auf MySQL warten

```bash
# Warten bis healthy
until docker exec luvex-mysql mysqladmin ping -h localhost --silent; do
    echo "Waiting for MySQL..."
    sleep 2
done
```

### Schritt 4: Datenbank wiederherstellen

```bash
# Uncompressed backup
docker exec -i luvex-mysql mysql -u root -p${MYSQL_ROOT_PASSWORD} luvex_production < backups/backup.sql

# Compressed backup (.gz)
gunzip -c backups/backup.sql.gz | docker exec -i luvex-mysql mysql -u root -p${MYSQL_ROOT_PASSWORD} luvex_production
```

### Schritt 5: WordPress-Dateien wiederherstellen

```bash
# Backup entpacken
mkdir -p backups/temp_restore
tar -xzf backups/final_backup.tar.gz -C backups/temp_restore

# WordPress-Container starten
docker-compose up -d wordpress

# Dateien kopieren
docker cp backups/temp_restore/wp-content/uploads/. luvex-wordpress:/var/www/html/wp-content/uploads/
docker cp backups/temp_restore/wp-content/plugins/. luvex-wordpress:/var/www/html/wp-content/plugins/

# Permissions setzen
docker exec luvex-wordpress chown -R www-data:www-data /var/www/html/wp-content
docker exec luvex-wordpress chmod -R 755 /var/www/html/wp-content/uploads

# Cleanup
rm -rf backups/temp_restore
```

### Schritt 6: Externen User erstellen

```bash
docker exec -i luvex-mysql mysql -u root -p${MYSQL_ROOT_PASSWORD} < setup-external-db-user.sql
```

### Schritt 7: Alle Services starten

```bash
docker-compose up -d
```

---

## 🔍 Troubleshooting

### Problem: "Can't connect to MySQL server on 'wp-db'"

**Lösung:**

1. Prüfen ob Container im richtigen Netzwerk ist:
   ```bash
   docker inspect <container-name> | grep -A 20 Networks
   ```

2. Studenten-App muss `db-shared` Netzwerk beitreten:
   ```yaml
   networks:
     - db-shared
   ```

3. MySQL-Container-Name prüfen:
   ```bash
   docker network inspect db-shared
   ```

### Problem: "Access denied for user 'external_app'"

**Lösung:**

1. User-Berechtigungen prüfen:
   ```bash
   docker exec -it luvex-mysql mysql -u root -p
   ```

   ```sql
   SELECT User, Host FROM mysql.user WHERE User = 'external_app';
   SHOW GRANTS FOR 'external_app'@'%';
   ```

2. Falls User nicht existiert, SQL-Script erneut ausführen:
   ```bash
   docker exec -i luvex-mysql mysql -u root -p < setup-external-db-user.sql
   ```

### Problem: "Unknown database 'luvex_production'"

**Lösung:**

1. Datenbank-Namen in .env prüfen:
   ```bash
   grep MYSQL_DATABASE .env
   ```

2. Datenbank erstellen falls fehlt:
   ```bash
   docker exec -it luvex-mysql mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS luvex_production;"
   ```

3. Backup importieren (siehe Schritt 4 oben)

### Problem: Password-Verifikation schlägt fehl

**Lösung:**

1. Hash-Format überprüfen:
   ```bash
   docker exec -it luvex-mysql mysql -u root -p
   ```

   ```sql
   USE luvex_production;
   SELECT user_login, user_pass FROM wp_users LIMIT 1;
   ```

2. Sicherstellen, dass richtige PHPass-Library verwendet wird:
   - PHP: `wp_check_password()`
   - Python: `passlib.hash.wordpress`
   - Node.js: `wordpress-hash-node`

---

## 📚 Weiterführende Dokumentation

- **WordPress Codex:** https://codex.wordpress.org/Database_Description
- **PHPass Library:** https://www.openwall.com/phpass/
- **Docker Networks:** https://docs.docker.com/network/
- **MySQL User Management:** https://dev.mysql.com/doc/refman/8.0/en/user-account-management.html

---

## 🎯 Next Steps: App Developer Agent

Nach erfolgreichem Setup können die Verbindungsdaten an den App Developer Agent weitergegeben werden.

Siehe: `APP_DEVELOPER_PROMPT.md` für den vollständigen Prompt mit allen Details.

---

**Version:** 1.0
**Erstellt:** 2026-01-15
**Author:** WordPress DevOps Agent
