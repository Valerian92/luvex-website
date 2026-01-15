-- ═══════════════════════════════════════════════════════════════════════════════
-- LUVEX.TECH - External Database User Setup for Student App
-- ═══════════════════════════════════════════════════════════════════════════════
-- Purpose: Create a read-only database user for the external student app
-- to access WordPress user data for authentication.
--
-- SECURITY:
-- - Read-only access (SELECT only)
-- - Restricted to wp_users and wp_usermeta tables
-- - Access from any container in db-shared network via '%' host
-- ═══════════════════════════════════════════════════════════════════════════════

-- Create external app user with strong password
-- IMPORTANT: Change 'SecurePassword123!' to a strong password in production!
CREATE USER IF NOT EXISTS 'external_app'@'%' IDENTIFIED BY 'SecurePassword123!';

-- Grant SELECT privileges on WordPress database tables
-- Option 1: Full read access to all WordPress tables
GRANT SELECT ON luvex_production.* TO 'external_app'@'%';

-- Option 2 (More Restrictive): Only wp_users and wp_usermeta tables
-- Uncomment these lines and comment out the line above for stricter access:
-- REVOKE SELECT ON luvex_production.* FROM 'external_app'@'%';
-- GRANT SELECT ON luvex_production.wp_users TO 'external_app'@'%';
-- GRANT SELECT ON luvex_production.wp_usermeta TO 'external_app'@'%';

-- Apply changes
FLUSH PRIVILEGES;

-- Verify user creation
SELECT User, Host FROM mysql.user WHERE User = 'external_app';

-- Verify privileges
SHOW GRANTS FOR 'external_app'@'%';

-- ═══════════════════════════════════════════════════════════════════════════════
-- TESTING QUERY - Run this to verify access works
-- ═══════════════════════════════════════════════════════════════════════════════
-- FROM EXTERNAL CONTAINER:
-- docker run --rm --network db-shared mysql:8.0 \
--   mysql -h wp-db -u external_app -pSecurePassword123! \
--   -e "SELECT COUNT(*) as user_count FROM luvex_production.wp_users;"
-- ═══════════════════════════════════════════════════════════════════════════════

-- ═══════════════════════════════════════════════════════════════════════════════
-- IMPORTANT NOTES FOR APP DEVELOPER
-- ═══════════════════════════════════════════════════════════════════════════════
-- Connection Details:
--   Host: wp-db (network alias in db-shared network)
--   Port: 3306
--   Database: luvex_production
--   User: external_app
--   Password: SecurePassword123! (CHANGE IN PRODUCTION!)
--   Network: db-shared
--
-- WordPress Password Hashing:
--   WordPress uses PHPass hashing algorithm
--   Libraries needed:
--     - PHP: wp_check_password() function
--     - Python: passlib library with wordpress scheme
--     - Node.js: wordpress-hash-node package
--     - Go: github.com/defuse/password-hashing/go
--
-- Relevant Tables:
--   wp_users:
--     - ID: User ID
--     - user_login: Username
--     - user_pass: Password hash (PHPass)
--     - user_email: Email address
--     - user_status: 0 = active
--     - user_registered: Registration date
--
--   wp_usermeta:
--     - user_id: Foreign key to wp_users.ID
--     - meta_key: Metadata key (e.g., 'wp_capabilities', 'first_name')
--     - meta_value: Metadata value
-- ═══════════════════════════════════════════════════════════════════════════════
