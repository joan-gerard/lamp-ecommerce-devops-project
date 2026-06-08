# LAMP Stack eCommerce Deployment

A automated LAMP stack deployment on Ubuntu, provisioned inside a local Lima VM to simulate a real server environment.

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
git clone https://github.com/joan-gerard/lamp-ecommerce-devops-project.git
cd lamp-ecommerce-devops-project
chmod +x setup.sh
./setup.sh
```

The app will be available at `http://localhost`.

## Notes

Ubuntu was chosen over CentOS as it is more representative of modern cloud server environments. The LAMP stack setup is identical across both distributions — only the package manager and service names differ.
