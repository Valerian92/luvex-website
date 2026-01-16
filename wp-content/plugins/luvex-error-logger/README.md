# LUVEX Error Logger

Professional error logging plugin for WordPress that captures both frontend and backend errors with git commit tracking.

## Features

### Frontend Error Tracking
- JavaScript runtime errors
- Unhandled Promise rejections
- Console error logging
- Automatic stack trace capture

### Backend Error Tracking
- PHP errors (all levels: ERROR, WARNING, NOTICE, DEPRECATED)
- PHP exceptions
- Fatal errors
- WordPress core errors

### Context Information
Each error log includes:
- **Git Commit Hash** - Know exactly which version caused the error
- **Timestamp** - When the error occurred
- **User ID** - Which user experienced the error (0 = not logged in)
- **URL** - Where the error happened
- **Stack Trace** - Full error context
- **User Agent** - Browser/client information
- **File & Line Number** - Exact error location

## Log Format

Logs are stored in `/error-logs/YYYY-MM-DD.log` in JSON format:

```json
{
    "type": "javascript",
    "message": "Cannot read property 'foo' of undefined",
    "source": "https://luvex.tech/wp-content/themes/luvex/script.js",
    "lineno": 42,
    "colno": 15,
    "stack": "Error: Cannot read property...",
    "url": "https://luvex.tech/page",
    "user_agent": "Mozilla/5.0...",
    "user_id": 2,
    "git_commit": "6c1bfb2a8f3d9e...",
    "timestamp": "2026-01-16 14:30:21"
}
```

## Usage

1. **Activate Plugin** in WordPress Admin → Plugins
2. **Errors are automatically logged** to `/error-logs/`
3. **Read logs** with: `cat error-logs/2026-01-16.log`
4. **Logs auto-rotate** after 30 days

## Installation

Plugin is automatically deployed with the WordPress installation.

## Git Integration

The plugin automatically detects the current git commit hash from `.git/HEAD` and includes it in every error log. This allows you to:
- Correlate errors with specific deployments
- Track when bugs were introduced
- Verify fixes in production

## Security

- Logs are stored outside the web root
- AJAX endpoint is nonce-protected
- Stack traces don't include function arguments (no sensitive data)
- Old logs are automatically cleaned after 30 days

## For Claude Code

Error logs are committed to git, allowing Claude to:
- Read errors directly with Read tool
- Correlate errors with code changes
- Debug issues without manual copy-paste
- Track error patterns over time
