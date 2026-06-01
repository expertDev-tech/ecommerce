# Laravel E-Commerce Platform

A modern E-Commerce Admin Panel built with Laravel, Inertia.js, Vue.js, MySQL, and Tailwind CSS.

## Tech Stack

### Backend

* Laravel
* PHP 8+
* MySQL
* Eloquent ORM

### Frontend

* Vue.js 3
* Inertia.js
* Tailwind CSS
* Lucide Icons

### Development Tools

* Git
* GitHub
* Composer
* NPM

---

# Features

## Authentication & Authorization

* Secure Admin Authentication
* Role-Based Access Control (RBAC)
* Permission Management

---

## Catalog Management

### Categories

* Create Category
* Update Category
* Delete Category
* Trash & Restore
* Nested Categories
* Status Management

### Brands

* Create Brand
* Update Brand
* Delete Brand
* Brand Image Upload
* Trash & Restore

### Product Collections

* Collection Management
* Featured Collections
* SEO Meta Fields
* Collection Images
* Product Assignment

---

## Product Management

### Product CRUD

* Create Product
* Edit Product
* Delete Product
* Product Status Management
* Stock Management
* Pricing Management
* SEO Management

### Product Images

* Multiple Image Upload
* Primary Image Support
* Sort Order
* Soft Delete
* Trash & Restore
* Permanent Delete

### Product Videos

* YouTube Videos
* Vimeo Videos
* Uploaded Videos
* Primary Video Support
* Soft Delete
* Trash & Restore
* Permanent Delete

### Product Attributes

* Dynamic Attributes
* Attribute Options
* Text Fields
* Textarea Fields
* Number Fields
* Date Fields
* Select Fields
* Radio Fields
* Checkbox Fields
* Color Attributes
* Required Attribute Validation
* Product Attribute Assignment
* Pagination Support

---

## SEO Features

* SEO Friendly URLs
* Meta Titles
* Meta Descriptions
* Slug Generation

---

## Soft Delete System

Implemented across multiple modules:

* Categories
* Brands
* Product Images
* Product Videos
* Collections

Features:

* Trash Management
* Restore Records
* Permanent Delete

---

## Project Structure

```text
app
├── Http
│   ├── Controllers
│   └── Middleware
├── Models
├── Services
└── Helpers

resources
└── js
    └── Pages
        └── Admin
```

---

## Installation

### Clone Repository

```bash
git clone <repository-url>
```

### Install Dependencies

```bash
composer install

npm install
```

### Environment Setup

```bash
cp .env.example .env
```

### Generate Key

```bash
php artisan key:generate
```

### Run Migrations

```bash
php artisan migrate
```

### Storage Link

```bash
php artisan storage:link
```

### Start Development Server

```bash
php artisan serve

npm run dev
```

---

## Git Workflow

```bash
git checkout develop

git pull origin develop

git checkout -b feature/feature-name
```

After development:

```bash
git add .

git commit -m "Feature: Description"

git push origin feature/feature-name
```

Create Pull Request and merge into develop/main.

---

## Current Progress

Completed:

* Authentication
* Categories Module
* Brands Module
* Product CRUD
* Product Images
* Product Videos
* Product Attributes
* Soft Delete & Trash System
* Pagination

In Progress:

* Product Collections

Upcoming:

* Product Variants
* Inventory Management
* Orders
* Coupons
* Reviews
* Wishlist
* Reports & Analytics

---

## Author

Ankit Parmar

Senior Full Stack Developer

Laravel | Vue.js | Inertia.js | MySQL

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
