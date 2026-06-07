# LAMP Stack eCommerce Deployment

A LAMP stack deployment project based on the KodeKloud Shell Scripts for Beginners course.

## Stack

- **OS:** Ubuntu 25.10
- **Web Server:** Apache 2.4
- **Database:** MariaDB 11.8
- **Language:** PHP 8.4

## What This Does

Deploys a fictional electronics eCommerce storefront backed by a MariaDB database. The `setup.sh` script automates the full provisioning process — installing packages, configuring services, setting up the database, and deploying the application.

## Usage

### Prerequisites

- A fresh Ubuntu server or VM

### Run the setup script

```bash
git clone https://github.com/kodekloudhub/learning-app-ecommerce.git /tmp/learning-app-ecommerce
git clone https://github.com/YOUR_USERNAME/lamp-ecommerce.git
cd lamp-ecommerce
chmod +x setup.sh
./setup.sh
```

The app will be available at `http://localhost`.

## Notes

The course uses CentOS but this project uses Ubuntu, which is more representative of modern cloud server environments. The LAMP stack setup is identical — only the package manager and service names differ.
