# PHP & MySQL E-commerce Shop

A server-rendered e-commerce learning project built with PHP, MySQL, HTML, CSS, and Bootstrap.

## Repository overview

The application lives in `e-commerce/` and contains storefront pages for browsing products, a shopping cart, sign-in/registration, profile pages, and an `admin/` area.

## Tech stack

- PHP
- MySQL
- HTML, CSS, JavaScript, Bootstrap

## Run locally

1. Install a local PHP/MySQL environment such as XAMPP, WAMP, or equivalent.
2. Place the `e-commerce/` folder in your local web server's document root.
3. Create and configure a MySQL database according to the SQL queries and connection settings in the application.
4. Set your **local** database credentials in the appropriate connection configuration.
5. Open the project in a browser through your local web server.

There is no verified database import script or automated installer documented at the repository root. Database setup may require inspecting the existing application schema.

## Structure

- `e-commerce/index.php` — storefront entry
- `e-commerce/produit.php` — product page
- `e-commerce/panier.php` — shopping cart
- `e-commerce/registre.php` — registration
- `e-commerce/admin/` — administration features
- `e-commerce/inc/` — shared PHP code/configuration

## Status and limitations

This is an educational project, **not a production-ready webshop**. Before hosting it publicly, review authentication, SQL injection protections, input validation, session security, file uploads, and payment handling. Do not use real customer information for demonstrations.
