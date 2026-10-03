# Pet Daycare Booking System

A Laravel-based SaaS web application for a pet daycare business, allowing pet owners to register, manage their pets, and book daycare, boarding, or grooming services online.

## Tech Stack
- **Laravel 13**
- **SQLite** (database)
- **Tailwind CSS**
- **Laravel Jetstream** (authentication, Livewire stack)
- **Laravel Livewire** (interactive booking status updates)
- **Laravel Sanctum** (API authentication)

## Features
- User registration and login (Jetstream)
- Full CRUD for Pets (name, type, age, breed, notes)
- Booking system with service type (daycare/overnight/grooming), duration, and contact phone
- Live Confirm/Cancel booking status updates (Livewire, no page reload)
- Quick-add-a-pet flow directly from the booking page
- REST API for pets and bookings, secured with Sanctum tokens
- Role-based data isolation (users only ever see their own pets/bookings)

## Setup Instructions
1. Clone this repository
2. Run `composer install`
3. Copy `.env.example` to `.env` and run `php artisan key:generate`
4. Run `php artisan migrate` (the included `database/database.sqlite` already has schema + sample data, or start fresh)
5. Run `npm install && npm run build`
6. Serve the application (e.g. via Laravel Herd, or `php artisan serve`)

## API Endpoints (Sanctum-protected)
- `GET /api/user` — authenticated user's details
- `GET /api/pets` — authenticated user's pets
- `GET /api/bookings` — authenticated user's bookings

## Author
Created as part of the Advance Programming coursework assignment.