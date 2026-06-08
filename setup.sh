#!/bin/bash

set -e

echo "==> Updating package list..."
sudo apt update -y

echo "==> Installing Apache, MariaDB, PHP..."
sudo apt install -y apache2 mariadb-server php libapache2-mod-php php-mysql

echo "==> Starting and enabling services..."
sudo systemctl start apache2
sudo systemctl enable apache2
sudo systemctl start mariadb
sudo systemctl enable mariadb

echo "==> Configuring MariaDB..."
sudo mariadb -e "CREATE DATABASE IF NOT EXISTS ecomdb;"
sudo mariadb -e "CREATE USER IF NOT EXISTS 'ecomuser'@'localhost' IDENTIFIED BY 'ecompassword';"
sudo mariadb -e "GRANT ALL PRIVILEGES ON ecomdb.* TO 'ecomuser'@'localhost';"
sudo mariadb -e "FLUSH PRIVILEGES;"

echo "==> Loading inventory data..."
sudo mariadb < ./assets/db-load-script.sql

echo "==> Deploying application files..."
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
sudo cp -r "$SCRIPT_DIR/app/." /var/www/html/

echo "==> Creating application .env file..."
sudo tee /var/www/html/.env > /dev/null <<EOF
DB_HOST=localhost
DB_USER=ecomuser
DB_PASSWORD=ecompassword
DB_NAME=ecomdb
EOF

echo "==> Configuring Apache to serve index.php first..."
sudo sed -i 's/DirectoryIndex index.html/DirectoryIndex index.php index.html/' /etc/apache2/mods-enabled/dir.conf

echo "==> Restarting Apache..."
sudo systemctl restart apache2

echo "==> Done! App should be running at http://localhost"
