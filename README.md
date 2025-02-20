# E-commerce Platform

This project is a fully-functional e-commerce platform that allows different user roles (User, Vendor, and Admin) to interact with the platform in distinct ways.

## Project Overview

This e-commerce platform is designed to manage and sell products with different user roles:

- **Users** can browse products,  and update their profiles.
- **Vendors** can register, upload store information, manage and list their products, and manage their store.
- **Admins** have complete control over the platform, including managing users, vendors, products, and more.

## Key Features

### User Role:
- Users can register and log in to update their profiles and upload a profile image.
- Users can browse products and make purchases.

### Vendor Role:
- Vendors can register, log in, and upload store information before adding products.
- Vendors can add, edit, and delete their own products after uploading store information.
- Vendors can view and manage their store's products.

### Admin Role:
- Admin has full control over the platform.
- Admin can manage users and vendors.
- Admin can access all product data, perform CRUD operations, and manage the system settings.

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: Laravel
- **Database**: MySQL

### Routes

#### For Users and Vendors:
- **Register**: [http://127.0.0.1:8000/register](http://127.0.0.1:8000/register)
- **Login**: [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)

#### For Admin:
- **Admin Register**: [http://127.0.0.1:8000/admin/register](http://127.0.0.1:8000/admin/register)
- **Admin Login**: [http://127.0.0.1:8000/admin/login](http://127.0.0.1:8000/admin/login)

## Installation

### Prerequisites

Ensure you have the following installed on your local machine:
- PHP 
- Composer
- Laravel 10
- MySQL 

### Steps to Install

1. Clone this repository to your local machine:
   ```bash
   git clone https://github.com/jigssuthar/practical-task
