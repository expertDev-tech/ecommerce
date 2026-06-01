# Laravel Vue E-Commerce Platform

A modern, scalable E-Commerce platform built with Laravel, Inertia.js, Vue.js, Tailwind CSS, and MySQL.

The project is being developed using a module-by-module approach, focusing on building a production-ready Admin Panel first, followed by a complete Customer Storefront.

---

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

### Development Tools

* Git & GitHub
* Composer
* NPM
* Vite

---

# Project Architecture

The project follows a practical architecture:

* Simple CRUD → Controller + Model
* Medium Complexity → Dedicated Validation
* Complex Business Logic → Separation when needed

The goal is to keep the codebase maintainable without unnecessary overengineering.

---

# Completed Modules

## Authentication & Authorization

* Admin Authentication
* Role Based Access Control (RBAC)
* Permission Management

---

## Category Management

Features:

* Create Category
* Edit Category
* Delete Category
* Soft Delete
* Trash Management
* Restore Category
* Permanent Delete
* Nested Categories
* Status Management

---

## Brand Management

Features:

* Create Brand
* Edit Brand
* Delete Brand
* Brand Image Upload
* Soft Delete
* Trash Management
* Restore Brand
* Permanent Delete

---

## Product Management

### Product CRUD

Features:

* Create Product
* Edit Product
* Delete Product
* Product Status
* Featured Products
* Inventory Fields
* Pricing Fields
* SEO Fields

---

### Product Images

Features:

* Multiple Image Upload
* Primary Image
* Image Listing
* Soft Delete
* Trash Management
* Restore Image
* Permanent Delete

---

### Product Videos

Supported Types:

* YouTube Videos
* Vimeo Videos
* Uploaded Videos

Features:

* Video Management
* Embedded Video Preview
* Primary Video Selection
* Soft Delete
* Trash Management
* Restore Video
* Permanent Delete

---

### Product Attributes

Supported Attribute Types:

* Text
* Textarea
* Number
* Date
* Select
* Radio
* Checkbox
* Color

Features:

* Dynamic Product Attributes
* Required Attributes
* Attribute Options
* Product Assignment
* Pagination
* Validation Support

---

## Soft Delete System

Implemented Across:

* Categories
* Brands
* Product Images
* Product Videos

Features:

* Trash Page
* Restore Records
* Permanent Delete

---

# Currently In Development

## Product Collections

Features Planned:

* Collection CRUD
* Collection Image
* Featured Collections
* SEO Fields
* Product Assignment
* Soft Delete
* Trash Management

---

# Upcoming Modules

## Product Variants

Features:

* Variant Generation
* Variant Attributes
* SKU Management
* Variant Pricing
* Variant Inventory
* Variant Images

---

## Inventory Management

Features:

* Stock Tracking
* Inventory Updates
* Low Stock Monitoring

---

## Coupons & Discounts

Features:

* Coupon Codes
* Percentage Discounts
* Fixed Discounts
* Usage Limits

---

## Orders

Features:

* Order Management
* Order Status Workflow
* Customer Orders
* Order Details

---

## Reviews & Ratings

Features:

* Product Reviews
* Product Ratings
* Moderation

---

## Dashboard & Reports

Features:

* Sales Reports
* Inventory Reports
* Customer Reports
* Revenue Analytics

---

# Future Roadmap

After Admin Panel completion:

## Customer Storefront

### Home Page

* Featured Products
* Collections
* Promotions

### Catalog

* Product Listing
* Category Pages
* Collection Pages
* Search
* Filters

### Product Details

* Images
* Videos
* Attributes
* Variants
* Related Products

### Shopping Features

* Cart
* Wishlist
* Checkout
* Order Tracking

### Customer Account

* Profile
* Address Management
* Order History
* Wishlist

---

# Installation

Clone Repository

```bash
git clone <repository-url>
```

Install Dependencies

```bash
composer install

npm install
```

Environment Setup

```bash
cp .env.example .env
```

Generate Application Key

```bash
php artisan key:generate
```

Run Migrations

```bash
php artisan migrate
```

Create Storage Link

```bash
php artisan storage:link
```

Start Development

```bash
php artisan serve

npm run dev
```

---

# Git Workflow

```bash
git checkout develop

git pull origin develop

git checkout -b feature/feature-name
```

After Development:

```bash
git add .

git commit -m "Feature: Description"

git push origin feature/feature-name
```

Merge feature branch into develop/main after review.

---

# Project Status

Admin Panel Progress:

* Authentication ✓
* Categories ✓
* Brands ✓
* Product CRUD ✓
* Product Images ✓
* Product Videos ✓
* Product Attributes ✓
* Soft Delete System ✓
* Collections (In Progress)
* Variants (Upcoming)

Frontend Progress:

* Planned After Admin Completion

---

# Author

Ankit Parmar

Senior Full Stack Developer

Laravel | Vue.js | Inertia.js | MySQL | Tailwind CSS

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
