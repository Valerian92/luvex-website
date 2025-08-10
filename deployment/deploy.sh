#!/bin/bash
echo "🌐 Deploying LUVEX Website..."
cd /opt/bitnami/wordpress/wp-content/themes/luvex-theme
sudo chown -R valerian:valerian .
git pull origin develop  
sudo chown -R bitnami:daemon .
echo "✅ Website deployed successfully!"