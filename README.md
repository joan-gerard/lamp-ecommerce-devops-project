# NovaMart — LAMP Stack Deployment

A LAMP stack deployment project featuring NovaMart, a fictional electronics eCommerce storefront. The project demonstrates two deployment approaches: manual provisioning on an Ubuntu server via a shell script, and a containerised local development setup using Docker Compose.

## Stack

Target stack for server deployment:

- **OS:** Ubuntu 25.10
- **Web Server:** Apache 2.4
- **Database:** MariaDB 11.8
- **Language:** PHP 8.4

The Docker Compose setup pins **MariaDB 11.8** and **PHP 8.4** via container images. On the Ubuntu VM, `setup.sh` installs whatever versions are available from `apt` for your Ubuntu release.

## Project Structure

```
lamp-ecommerce-devops-project/
├── README.md
├── setup.sh              # automated server provisioning script
├── Dockerfile            # builds the web container
├── docker-compose.yml    # defines web and db services
├── assets/
│   └── db-load-script.sql  # database schema and seed data
└── app/                  # NovaMart PHP application
```

## Deployment Approaches

### 1. Server Deployment (Ubuntu VM)

Provisions a full LAMP stack on a fresh Ubuntu server — package installation, service configuration, database setup, and application deployment.

The script deploys the NovaMart app from this repository's `app/` directory to `/var/www/html/`. Database credentials are written to `/var/www/html/.env` at deploy time.

#### Prerequisites

- A fresh Ubuntu server or VM

#### Run the setup script

```bash
git clone https://github.com/joan-gerard/lamp-ecommerce-devops-project.git
cd lamp-ecommerce-devops-project
chmod +x setup.sh
./setup.sh
```

The app will be available at `http://localhost`.

### 2. Local Development (Docker Compose)

Spins up the full stack locally using two containers — one for the web server and one for the database. The local `app/` directory is copied into the web container at build time, and a `.env` file is generated from environment variables when the container starts.

#### Prerequisites

- Docker Desktop

#### Run

```bash
git clone https://github.com/joan-gerard/lamp-ecommerce-devops-project.git
cd lamp-ecommerce-devops-project
docker compose up --build
```

The app will be available at `http://localhost:8080`.

To rebuild after code changes:

```bash
docker compose up --build
```

To stop and remove containers:

```bash
docker compose down
```

The database seed script in `assets/db-load-script.sql` runs automatically on first startup only (when the MariaDB volume is created). To re-seed, remove the volume first: `docker compose down -v`.

## Notes

Ubuntu was chosen over CentOS as it is more representative of modern cloud server environments. The LAMP stack setup is identical across both distributions — only the package manager and service names differ.
