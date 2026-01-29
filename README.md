# Mini-Bar

A web application built with Laravel and Blade for managing mini bars in rooms. This project not only manages products and inventory but also **keeps track of the validity/expiration of items** in each room.

## Features

- User registration and login
- Product and category management
- Inventory tracking per room
- **Validity/expiration tracking of items**
- Responsive UI using Blade templates
- RESTful API endpoints

## Technologies Used

- PHP 8.x
- Laravel 10
- Blade Templating
- MySQL / SQLite
- CSS / JavaScript
- Composer & NPM for dependency management

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/mohammadhussainshams7/Mini-Bar.git
   cd Mini-Bar
2. Install PHP dependencies:
     ```bash
    composer install
3. Install JavaScript dependencies:
   ```bash
    npm install
    npm run dev
4. Copy .env.example to .env and set your database credentials:
   ```bash
    cp .env.example .env
    php artisan key:generate
5. Run migrations:
    ```bash
    php artisan migrate
6. Start the local development server:
   ```bash
    php artisan serve
## Usage

Visit http://localhost:8000 in your browser.

Register a new account or log in.

Manage products, categories, and inventory per room.

Track the validity/expiration of items to ensure safe usage.


   
