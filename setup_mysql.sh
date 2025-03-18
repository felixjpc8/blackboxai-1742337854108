#!/bin/bash

# Start MySQL service
sudo service mysql start

# Create database and user
sudo mysql -e "
CREATE DATABASE IF NOT EXISTS inventario_itevo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'itevo_user'@'localhost' IDENTIFIED BY 'itevo_password';
GRANT ALL PRIVILEGES ON inventario_itevo.* TO 'itevo_user'@'localhost';
FLUSH PRIVILEGES;
"

# Import database structure
sudo mysql inventario_itevo < database.sql

echo "MySQL setup completed successfully!"