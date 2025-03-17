# Employee Management System

A simple Employee Management System built with Laravel and Livewire. This application allows users to manage employees, including adding, updating, searching, sorting, and paginating records.

## Purpose
This project was developed as part of my coding test for a Web Developer position.

## Features

- Add, Edit, and Delete Employees
- Live Search Functionality
- Sorting Column
- Pagination with Customizable Page Size
- Responsive Design with Tailwind CSS
- Built with Laravel 10, Livewire, and Alpine.js

## Installation

### Prerequisites

- PHP 8.1+
- Composer
- MySQL or any supported database
- Node.js & npm (for frontend assets)

### Steps to Install

1. **Clone the repository:**
   ```sh
   git clone https://github.com/DevMike13/Employee-Management-System.git
   cd employee-management
   ```

2. **Install dependencies:**
   ```sh
   composer install
   npm install && npm run dev
   ```

3. **Set up environment:**
   ```sh
   cp .env.example .env
   ```

4. **Configure database:**
   - Update `.env` file with your database credentials

5. **Run migrations and seed data:**
   ```sh
   php artisan migrate
   ```

6. **Start the development server:**
   ```sh
   php artisan serve
   ```

## Usage
- Access the application at `http://127.0.0.1:8000`

