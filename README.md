# Grocery Store Management system

A PHP + MySQL web app to run a grocery store: live stock tracking, a fast billing screen and a sales dashboard, with an animated interface and page transitions.

## Screenshots
Run the project, then save your own captures into `screenshots/` with these names:

| Landing | Dashboard | Products | Billing |
|---|---|---|---|
| ![Landing](screenshots/landing.png) | ![Dashboard](screenshots/dashboard.png) | ![Products](screenshots/products.png) | ![Billing](screenshots/billing.png) |

## Features
- Animated landing page, wordmark logo, curtain page transitions, animated stat counters
- Secure login (hashed passwords, sessions)
- Products: add, search, filter by category, restock, delete, low-stock flags
- Billing: search, tap to add, quantity controls, transactional checkout that reduces stock
- Dashboard: product count, low stock, today's sales, all-time revenue, recent sales
- Light and dark mode, responsive, reduced-motion friendly

## Setup
1. Install XAMPP/WAMP/MAMP (PHP 8+, MySQL).
2. Copy this folder to `htdocs/grocery-store-management-system`.
3. Open phpMyAdmin and import `database.sql`.
4. Check DB credentials in `config.php` (default `root`, no password).
5. Visit `http://localhost/grocery-store-management-system/`.

**Default login:** `admin@grocery.local` / `admin123` (created automatically on first visit to the login page). Change it after first use.

## Structure
```
config.php  index.php  login.php  logout.php
dashboard.php  products.php  pos.php  database.sql
includes/layout.php   assets/css/style.css   assets/js/app.js   screenshots/
```
## Roadmap
Suppliers, customers, sales reports/export, cashier vs admin permissions, CSRF tokens.
