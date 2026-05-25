# Backend Implementation Plan: PHP 8.x & MySQL 8

This document outlines the architecture, database schema, and integration strategy for transitioning the Jahari Safaris frontend into a fully dynamic, database-driven application.

## 1. Architecture & Tech Stack
*   **Language**: PHP 8.x (Procedural / Object-Oriented blend for simplicity and speed)
*   **Database**: MySQL 8.0+
*   **Database Interaction**: PDO (PHP Data Objects) for secure, prepared statements.
*   **API Design**: RESTful JSON endpoints. The Vanilla JS frontend will use the `fetch()` API to communicate with the backend asynchronously, ensuring the site remains fast and doesn't require full page reloads.

## 2. Integration Readiness (Frontend Status)
The frontend is **100% prepared for backend integration**:
*   **Mobile Responsiveness**: All layouts are built with Tailwind's mobile-first breakpoints (`sm:`, `md:`, `lg:`). Grids collapse to single columns on mobile devices, ensuring seamless UI on all screen sizes.
*   **Form IDs**: All forms (like `#quote-form` in `car-hire.html`) have strict IDs and HTML5 validation. You can easily hijack the `submit` event via JS to send a POST request to a PHP endpoint instead of (or alongside) opening WhatsApp.
*   **Modular JS**: The `assets/js/main.js` handles currency and UI state. Data fetching logic can be easily appended here.
*   **Data Attributes**: Pricing relies on `data-price-usd`. When injecting dynamic content via PHP/JS, you simply output the database price into this attribute, and the frontend currency switcher will automatically handle the KSh ↔ USD conversion.

## 3. Database Schema (MySQL)

### `users` (Admin/Staff Accounts)
*   `id` (INT, PK, A_I)
*   `username` (VARCHAR 50)
*   `password_hash` (VARCHAR 255)
*   `role` (ENUM: 'admin', 'manager')
*   `created_at` (TIMESTAMP)

### `inquiries` (Contact & Quote Submissions)
*   `id` (INT, PK, A_I)
*   `client_name` (VARCHAR 100)
*   `client_phone` (VARCHAR 20)
*   `client_email` (VARCHAR 100, NULL)
*   `subject` (VARCHAR 255)
*   `start_date` (DATE)
*   `end_date` (DATE)
*   `status` (ENUM: 'pending', 'contacted', 'booked', 'closed')
*   `created_at` (TIMESTAMP)

### `catalog_items` (Vehicles, Lodges, Tents, Campsites)
*   `id` (INT, PK, A_I)
*   `type` (ENUM: 'vehicle', 'lodge', 'campsite', 'tent')
*   `title` (VARCHAR 100)
*   `location` (VARCHAR 100)
*   `description` (TEXT)
*   `price_usd` (DECIMAL 10,2)
*   `image_url` (VARCHAR 255)
*   `features` (JSON) - Stores arrays like `["7 Seats", "4WD", "A/C"]`
*   `is_active` (BOOLEAN)

## 4. Proposed API Endpoints (`/backend/api/`)

### Public Endpoints
*   `POST /api/submit-inquiry.php`: Receives form data (JSON), sanitizes it, inserts it into the `inquiries` table, and optionally uses PHPMailer to send an email alert to the admin.
*   `GET /api/catalog.php?type=vehicle`: Returns JSON array of active vehicles to populate the car-hire grid.
*   `GET /api/catalog.php?type=lodge`: Returns JSON array of active lodges.

### Admin Endpoints (Requires Authentication Session)
*   `POST /api/auth/login.php`: Authenticates admin users and sets session cookies.
*   `GET /api/admin/inquiries.php`: Fetches all leads for the admin dashboard.
*   `POST /api/admin/update-item.php`: Updates pricing or details in the `catalog_items` table.

## 5. Security Protocols
1.  **SQL Injection Prevention**: All queries MUST use PDO prepared statements. Never concatenate variables directly into SQL strings.
2.  **XSS Protection**: Use `htmlspecialchars()` when rendering any user-generated data (like inquiry names) back into an HTML dashboard.
3.  **CORS & Headers**: Set strict `Access-Control-Allow-Origin` headers if the API runs on a different subdomain.
4.  **Environment Variables**: Store MySQL credentials in a `.env` or `config.php` file outside the public web root.

## 6. Next Steps for Implementation
1.  Create the MySQL database and run the initial table generation scripts.
2.  Set up the `config.php` for database connection.
3.  Write the `submit-inquiry.php` endpoint first to capture leads into the database before redirecting to WhatsApp.
4.  (Optional) Build a simple CRUD admin dashboard using Bootstrap or Tailwind to manage the `catalog_items` without touching code.
