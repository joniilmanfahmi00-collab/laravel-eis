# Laravel Executive Information System (EIS)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)

## Overview
**Laravel EIS** is an executive information system built using the Laravel framework. This application is designed to assist management and executives in making informed decisions based on processed performance data and scoring metrics.

## Purpose
The primary goal of Laravel EIS is to provide a centralized platform for tracking organizational performance, visualizing key metrics, and facilitating data-driven decision-making. By leveraging Laravel's powerful features, this system ensures efficient data management, security, and scalability.

## Tech Stack
- **PHP**: The core programming language used for backend development.
- **Laravel**: A popular PHP framework for building web applications.
- **Bootstrap 5 CSS**: A front-end framework for responsive and modern UI design.
- **Javascript (Vanilla)**: Used for interactive elements and client-side logic.

## Key Features
- **Executive Dashboard**: Data visualization for quick and effective decision-making.
- **EisScore Tracking**: Monitor organizational performance scores and key metrics.
- **Data Management**: Seamless data integration utilizing Laravel's Eloquent ORM.
- **Security System**: Robust authentication and authorization following Laravel's security standards.

## System Requirements
- PHP >= 8.2
- Composer
- Database (MySQL / PostgreSQL / SQLite)
- Node.js & NPM (for front-end assets)

## Installation Guide

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/joniilmanfahmi00-collab/laravel-eis
   cd eis
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Environment Configuration**:
   Copy `.env.example` to `.env` and configure your database settings:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Migration**:
   Run the migrations to create the necessary tables:
   ```bash
   php artisan migrate
   ```

5. **Compile Assets**:
   ```bash
   npm run dev
   ```

6. **Run the Application**:
   ```bash
   php artisan serve
   ```

## License
This project is licensed under the MIT license.
