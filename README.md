# Bulk Email Management Portal

A scalable bulk email management platform built with Laravel 13.

The system is designed to manage contacts, create reusable email templates, launch bulk email campaigns, and process large-scale email delivery using queue-based architecture and third-party email providers.

---

# Platform Objectives

Build a platform that allows administrators to:

* Upload and manage contacts
* Create reusable email templates
* Create and schedule campaigns
* Send bulk emails efficiently
* Handle retries and failures
* Maintain logs and reporting
* Support scalable email processing

The architecture focuses on scalability, maintainability, efficient workflows, and production-ready email processing.

---

# Tech Stack

* PHP 8.3+
* Laravel 13
* MySQL
* Blade Templates
* Bootstrap / AdminLTE UI
* Laravel Queues
* Eloquent ORM
* Laravel Mail System
* Third-party Email Provider Integration

---

# Third-Party Services Used

The platform uses external email delivery services instead of building custom mailing infrastructure from scratch.

Recommended integrations:

* Mailgun

The system architecture is designed to support provider abstraction so the mailing service can be changed easily without affecting business logic.

---

# Core Features

# Contact Management

Features implemented/planned:

* Upload contacts using CSV/Excel files
* Store and manage contacts
* Dynamic fields support
* Contact listing with pagination
* Search and filtering
* Import validation

Example dynamic fields:

```json
{
    "name": "John Doe",
    "company": "ABC Ltd",
    "city": "Delhi"
}
```

---

# Email Template Management

Administrators can:

* Create templates
* Edit templates
* Store reusable email content
* Use placeholders dynamically

Supported placeholders:

```html
Hello {{name}},
Welcome to {{company}}
```

The placeholder system is designed to replace values dynamically during campaign execution.

---

# Campaign Management

Campaign module supports:

* Create campaigns
* Attach email templates
* Select recipients
* Schedule campaigns
* Immediate sending
* Campaign status tracking

Typical statuses:

* Draft
* Scheduled
* Processing
* Completed
* Failed

---

# Bulk Email Sending

Bulk mailing architecture includes:

* Queue-based processing
* Chunked email dispatching
* Retry handling
* Failed job tracking
* Provider abstraction
* Background workers

The queue system ensures the application remains responsive while processing 10k+ emails.

---

# Queue Architecture

Laravel queues are used to process emails asynchronously.

Example flow:

```text
Campaign Created
    ↓
Jobs Dispatched
    ↓
Queue Workers Process Emails
    ↓
Provider Sends Emails
    ↓
Logs & Status Updated
```

Recommended queue drivers:

* Database
* Redis

Run queue worker:

```bash
php artisan queue:work
```

---

# Logs & Reporting

The system maintains:

* Email delivery logs
* Failed email logs
* Campaign history
* Basic reporting

Possible tracked fields:

* Recipient email
* Delivery status
* Failure reason
* Sent timestamp

---

# Scalability Considerations

The architecture is designed with scalability in mind.

Implemented/planned considerations:

* Queue-based processing
* Chunked bulk operations
* Database indexing
* Background workers
* Retry mechanisms
* Separation of concerns
* Service-based architecture

The system is intended to handle 10,000+ email deliveries efficiently.

---

# Architecture Overview

```text
Admin Panel
    ↓
Campaign Module
    ↓
Queue Jobs
    ↓
Email Service Layer
    ↓
Third-Party Provider
    ↓
Logs & Tracking
```

---

# Project Structure

```bash
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
├── Imports/
├── Jobs/
├── Mail/
├── Models/
├── Services/
resources/
├── views/
│   ├── campaigns/
│   ├── contacts/
|   ├── emails/
│   ├── layouts/
│   └── templates/
routes/
|── web.php
|── console.php
```

---

# Installation

## 1. Clone Repository

```bash
git clone git@github.com:malkiatpannu/bulk-mail-portal.git
cd bulk-mail-portal
```

## 2. Install Dependencies

```bash
composer install
```

## 3. Copy Environment File

```bash
cp .env.example .env
```

## 4. Configure Database

Update `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bulk_email_portal
DB_USERNAME=root
DB_PASSWORD=
```

---

# Mail Provider Configuration

Example SendGrid configuration:

```env
MAIL_MAILER=mailgun
MAIL_SCHEME=https
MAIL_HOST=default
MAIL_PORT=587

MAILGUN_ENDPOINT=https://api.mailgun.net
MAILGUN_DOMAIN=<mailgun-domain>
MAILGUN_SECRET=<mailgun-api-key>

MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="Bulk mail Portal"
```

---

# Queue Configuration

Example database queue setup:

```env
QUEUE_CONNECTION=database
```

Generate queue tables:

```bash
php artisan queue:table
php artisan migrate
```

Start queue worker:

```bash
php artisan queue:work
```

---

# Run Migrations

```bash
php artisan migrate
```

---

# Start Development Server

```bash
php artisan serve
```

Application URL:

```bash
http://127.0.0.1:8000
```

---

# Important Laravel Commands

## Clear Cache

```bash
php artisan optimize:clear
```

## Run Queue Worker

```bash
php artisan queue:work
```

## Retry Failed Jobs

```bash
php artisan queue:retry all
```

## View Failed Jobs

```bash
php artisan queue:failed
```

---

# Future Enhancements

Potential future improvements:

* Advanced analytics dashboard
* Open/click tracking
* Webhook handling
* Multi-provider failover
* Role & permission management
* API support
* Real-time campaign progress
* Redis queue optimization
* Template builder UI

---

# Conclusion

This project demonstrates full-stack Laravel development skills along with architectural thinking required for scalable applications.

The solution is designed around real-world bulk email processing workflows and follows modern Laravel development standards.
