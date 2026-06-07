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

echo "==> Cloning application files..."
if [ ! -d "/tmp/learning-app-ecommerce" ]; then
git clone https://github.com/kodekloudhub/learning-app-ecommerce.git /tmp/learning-app-ecommerce
fi
sudo cp -r /tmp/learning-app-ecommerce/* /var/www/html/

echo "==> Configuring Apache environment variables..."
echo 'export DB_HOST=localhost' | sudo tee -a /etc/apache2/envvars
echo 'export DB_USER=ecomuser' | sudo tee -a /etc/apache2/envvars
echo 'export DB_PASSWORD=ecompassword' | sudo tee -a /etc/apache2/envvars
echo 'export DB_NAME=ecomdb' | sudo tee -a /etc/apache2/envvars

echo "==> Configuring Apache to serve index.php first..."
sudo sed -i 's/DirectoryIndex index.html/DirectoryIndex index.php index.html/' /etc/apache2/mods-enabled/dir.conf

echo "==> Restarting Apache..."
sudo systemctl restart apache2

echo "==> Done! App should be running at http://localhost"
