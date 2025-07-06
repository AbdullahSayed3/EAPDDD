# Laravel 11 Setup Instructions

This guide will walk you through the setup process for a Laravel 11 application running on PHP 8.2. Follow these steps to get started with the project.

## Prerequisites

- PHP 8.2 or higher
- Composer (for managing PHP dependencies)
- A database (MySQL, PostgreSQL, etc.)
- Laravel 11

## 1. Clone the Repository
```bash
git clone https://github.com/ATWltd/EAPD
```
## 2. Copy the .env file

```bash
cp .env.example .env
```

## Prerequisites
- put variables needed in .env

## 3. Install Dependencies
```bash
composer install
```
## 4. Generate Application Key
```bash
php artisan key:generate
```
## 5. Run Database Migrations
```bash
php artisan migrate
```

## 6. Seed the Database
```bash
php artisan db:seed
```

### If you are deploying the application to production, be sure to configure appropriate caching and optimize the application:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
