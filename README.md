# ✨ Miraj - E-commerce Platform for Romanian Women

![Laravel](https://img.shields.io/badge/Laravel-12.51-FF2D20?style=for-the-badge&logo=laravel)
![Livewire](https://img.shields.io/badge/Livewire-4.1-4A5568?style=for-the-badge&logo=livewire)
![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)
![Stripe](https://img.shields.io/badge/Stripe-Integrated-008CDD?style=for-the-badge&logo=stripe)

## 📋 Overview

Miraj is a fully-featured e-commerce platform built specifically for the Romanian market, targeting women's fashion, accessories, and beauty products. The platform includes a complete shopping experience from product browsing to secure checkout.

### 🎯 Target Audience
- Romanian women seeking fashion, accessories, and beauty products
- Local businesses wanting to sell products online
- Multi-vendor potential for future expansion

## ✨ Features

### 🛍️ Customer Features
- **User Authentication**: Secure registration, login, and profile management
- **Address Management**: Save and manage multiple shipping addresses
- **Product Catalog**: Browse products with categories and detailed views
- **Shopping Cart**: Add/update/remove items with quantity controls
- **Checkout Process**: Streamlined checkout with address selection
- **Payment Options**: 
  - 💳 Secure card payments via Stripe
  - 💵 Cash on delivery (Ramburs)
- **Order History**: View all past orders with details
- **PDF Invoices**: Download invoices for each order
- **Email Notifications**: Order confirmation and status updates
- **Contact Form**: Reach out with questions or support

### 👑 Admin Features
- **Dashboard**: Overview of sales, orders, and users
- **Product Management**: 
  - Add new products with images, prices, descriptions
  - Edit existing products
  - Delete products
  - Manage stock quantities
  - Mark products as featured
- **Order Management**:
  - View all orders with pagination
  - Filter orders by status
  - Update order status (pending, processing, shipped, delivered, cancelled)
  - View detailed order information
  - Generate and download PDF invoices
- **User Management**:
  - View all registered users
  - See user details and statistics
  - Edit user information
  - Promote users to admin
  - Delete regular users

### 💳 Payment Integration
- **Stripe Checkout**: Secure payment processing
- Test mode support for development
- Webhook ready for production
- Support for multiple payment methods via Stripe

### 📧 Email System
- Order confirmation emails
- Order status update notifications
- Contact form email handling
- HTML email templates with responsive design

### 📄 PDF Generation
- Professional invoice PDFs
- Company details and branding
- Itemized order breakdown
- Downloadable for both admin and customers

## 🛠️ Tech Stack

| Component | Technology |
|-----------|------------|
| **Framework** | Laravel 12.51 |
| **Frontend** | Livewire 4.1, Blade Templates |
| **CSS** | Custom CSS with responsive design |
| **Database** | MySQL 8.0 |
| **Payments** | Stripe API |
| **Emails** | Laravel Mail (SMTP) |
| **PDFs** | barryvdh/laravel-dompdf |
| **Authentication** | Laravel Fortify |
| **Version Control** | Git / GitHub |

## 📁 Project Structure
Miraj/
├── app/
│ ├── Http/
│ │ ├── Controllers/
│ │ │ ├── Admin/ # Admin controllers
│ │ │ ├── Auth/ # Login controllers
│ │ │ └── ... # Other controllers
│ ├── Mail/ # Email classes
│ ├── Models/ # Eloquent models
│ └── Services/ # Service classes (Stripe)
├── resources/
│ ├── views/
│ │ ├── admin/ # Admin panel views
│ │ ├── auth/ # Login/register views
│ │ ├── cart/ # Shopping cart
│ │ ├── checkout/ # Checkout process
│ │ ├── emails/ # Email templates
│ │ ├── pdf/ # Invoice PDF template
│ │ └── profile/ # User profile
│ └── css/ # Custom stylesheets
├── database/
│ ├── migrations/ # Database migrations
│ └── seeders/ # Sample data
└── routes/
└── web.php # All application routes

text

## 🚀 Installation

### Prerequisites
- PHP 8.1+
- Composer
- MySQL 8.0+
- Node.js & NPM
- Stripe Account (for payments)

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/CirlaAndrei/Miraj.git
   cd Miraj
Install PHP dependencies

bash
composer install
Install JavaScript dependencies

bash
npm install
npm run build
Environment setup

bash
cp .env.example .env
php artisan key:generate
Configure .env file

env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Miraj
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Miraj"

STRIPE_KEY=pk_test_your_stripe_key
STRIPE_SECRET=sk_test_your_stripe_secret
Run migrations

bash
php artisan migrate
Seed sample products (optional)

bash
php artisan db:seed --class=ProductSeeder
Create storage link

bash
php artisan storage:link
Make yourself admin

bash
php artisan tinker
php
$user = App\Models\User::where('email', 'your-email@example.com')->first();
$user->is_admin = true;
$user->save();
exit
Start the server

bash
php artisan serve
npm run dev  # In a separate terminal
🔑 Default Admin Access
URL: /admin/dashboard

First user must be manually promoted to admin via tinker

🧪 Testing Payments
Use these Stripe test cards:

Success: 4242 4242 4242 4242 (any future date, any CVC)

Decline: 4000 0000 0000 0002 (any future date, any CVC)

📱 Responsive Design
The platform is fully responsive and optimized for:

Desktop (1200px+)

Tablet (768px - 992px)

Mobile (480px - 768px)

Small mobile (<480px)

🔒 Security Features
CSRF protection

XSS prevention

SQL injection prevention via Eloquent

Admin middleware for protected routes

Authentication required for checkout

Secure Stripe payment handling

Password hashing with bcrypt

Session security

🌐 SEO Optimized
Comprehensive meta tags

Open Graph tags for social sharing

Twitter Cards

Canonical URLs

Sitemap ready

Schema.org structured data ready

📊 Database Schema
Users
id, name, email, password, phone, is_admin, timestamps

Products
id, name, slug, description, price, sale_price, sku, stock_quantity, image, category, tags, is_featured, is_published

Carts
id, user_id, session_id, product_id, quantity

Orders
id, user_id, order_number, subtotal, shipping, total, status, payment_status, payment_method, shipping_address fields, billing_address fields, notes, stripe_session_id, payment_intent_id, paid_at

Order Items
id, order_id, product_id, product_name, price, quantity, subtotal

Addresses
id, user_id, name, recipient_name, phone, address_line1, address_line2, city, county, postal_code, is_default

🎨 Customization
Styling
All custom styles are in resources/css/custom.css with:

CSS variables for easy theme changes

Responsive breakpoints

Mobile-first approach

Clean, modern design

Email Templates
Email templates are in resources/views/emails/ and can be customized:

order-confirmation.blade.php

order-status-updated.blade.php

PDF Invoice
Invoice template in resources/views/pdf/invoice.blade.php

🚦 Future Enhancements
Product reviews and ratings

Wishlist functionality

Discount coupons

Multi-language support (EN/RO)

Advanced product search

Social media login

Product image galleries

Order tracking

Analytics dashboard

Mobile app API

📄 License
Copyright © 2026 Miraj. All rights reserved.

This project is proprietary and confidential. Unauthorized copying, distribution, or use of this software is strictly prohibited.

👨‍💻 Author
Andrei Cirlă

GitHub: @CirlaAndrei

Email: cirlaandrei@gmail.com

🙏 Acknowledgments
Laravel community

Livewire team

Stripe for payment processing

Unsplash for placeholder images

📞 Support
For support, email contact@miraj.ro or use the contact form on the website.

Built with ❤️ 
