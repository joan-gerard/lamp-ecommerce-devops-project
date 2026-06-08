# NovaMart — E-Commerce Demo

A simple PHP storefront that displays products from a MariaDB/MySQL database. Built for learning and DevOps practice.

## Requirements

- PHP 7.4+ with the `mysqli` extension
- MariaDB or MySQL
- A web server (Apache/httpd) or PHP's built-in server for local development

## Quick start

### 1. Clone and configure environment

Copy the project files, then create a `.env` file in the project root:

```sh
DB_HOST=localhost
DB_USER=ecomuser
DB_PASSWORD=ecompassword
DB_NAME=ecomdb
```

### 2. Set up the database

Create the database and user:

```sql
CREATE DATABASE ecomdb;
CREATE USER 'ecomuser'@'localhost' IDENTIFIED BY 'ecompassword';
GRANT ALL PRIVILEGES ON ecomdb.* TO 'ecomuser'@'localhost';
FLUSH PRIVILEGES;
```

Load the sample product data:

```sh
mysql -u ecomuser -p ecomdb < assets/db-load-script.sql
```

### 3. Run the app

**Local development (PHP built-in server):**

```sh
php -S localhost:8000
```

Open [http://localhost:8000](http://localhost:8000).

**Apache / httpd:** copy the project to your web root (e.g. `/var/www/html/`) and ensure `index.php` is the default document.

## Styles

Styles are written in SCSS and compiled to `css/style.css`. After editing files in `scss/`:

```sh
npx sass scss/style.scss css/style.css
```

## Project structure

```
├── index.php              # Main storefront page
├── assets/
│   └── db-load-script.sql # Database schema and seed data
├── scss/                  # Source stylesheets
├── css/                   # Compiled CSS
├── js/                    # JavaScript (Bootstrap, theme)
├── img/                   # Product images
└── vendors/               # Third-party assets (Font Awesome, WOW.js)
```

## Deployment notes (CentOS / RHEL)

On a production-style CentOS host you will typically:

1. Install `httpd`, `php`, `php-mysqlnd`, and `mariadb-server`
2. Open ports 80 (web) and 3306 (database) if needed
3. Deploy the code to `/var/www/html/`
4. Create the `.env` file with the correct database host
5. Set `DirectoryIndex index.php` in the Apache config

For a multi-node setup, set `DB_HOST` in `.env` to the database server IP and grant the DB user access from the web server host.

## License

Sample project for educational use.
