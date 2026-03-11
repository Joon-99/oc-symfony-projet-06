# TomTroc

A book-exchange web application built with PHP (MVC, no framework) and MySQL.

---

## Setup

### Step 1 — Clone the project

```bash
git clone <repository-url>
```

### Step 2 — Run composer

```bash
composer install
```

### Step 3 - You can use PHP Code Sniffer to verify that the code is conform to PSR-12

```bash
./vendor/bin/phpcs --standard=PSR12 src/
```

### Step 4 — Import the database into phpMyAdmin

The tests have been made exclusively through Xampp.

The DB schema and the data itself are both in the file `tomtroc.sql`.

Make sur to disable foreign key verification before importing.

### Step 5 — Configure database credentials (optional)

Open `config/config.php` and update the constants as needed, but you shouldn't need to change anything if you
haven't changed the sql file.

```php
const DB_HOST = 'localhost';   // database host
const DB_NAME = 'tomtroc';     // database name (created in step 3)
const DB_USER = 'root';        // MySQL username
const DB_PWD  = '';            // MySQL password
```

### Step 6 — Configure Apache

Make sure Apache can find the `index.php` file at the root of the project.

The tests have been made exclusively through Xampp, using a virtual host.

As an example: 

```apache
<VirtualHost *:80>
    ServerName oc-symfony.projet06.test
    DocumentRoot "C:\Users\Arjo\Desktop\oc-symfony-projet-06"
    ErrorLog "xampp-logs-projet06.test.log"
    <Directory "C:\Users\Arjo\Desktop\oc-symfony-projet-06">
        Require all granted
    </Directory>
</VirtualHost>
```

### Step 7 — Make sure the placeholder files for profiles and books are present

If you haven't touched anything in the `data` directory, you can ignore this, it's just that those files are those
loaded by default for books and users that do not have a personalized image yet.

The application saves uploaded images under `data/images/`. Make sure the web server process can write to it.

```bash
chmod -R 775 data/images/
```

---

## Routing

Pages are accessed via the `route` query parameter, for example:

| URL | Page |
|-----|------|
| `/?route=books` | Book catalogue |
| `/?route=sign-up` | Registration |
| `/?route=login` | Login |
| `/?route=my-profile` | My profile (requires login) |
| `/?route=messages` | Messaging (requires login) |

---

## Project structure

```
config/         Configuration and autoloader
data/images/    Uploaded images (book covers, avatars)
src/
  Controller/   Single front controller
  Entity/       Model classes
  Manager/      Database access (PDO)
  Service/      Application services (auth, forms, rendering)
  View/         PHP templates
  css/          Stylesheet
index.php       Application entry point
tomtroc.sql     Database schema and seed data
README.md       This file.
```
