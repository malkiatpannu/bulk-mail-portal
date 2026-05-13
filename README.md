# Bulk Email Management Portal

A scalable bulk email management platform built with Laravel 13.

The system is designed to manage contacts, create reusable email templates, launch bulk email campaigns, and process large-scale email delivery using queue-based architecture and third-party email providers.

---

# Features

## Contact Management

- Upload contacts using CSV/Excel files
- Manage contacts
- Dynamic fields support
- Search and filtering
- Pagination support
- Import validation

Example dynamic fields:

```json
{
    "name": "John Doe",
    "company": "ABC Ltd",
    "city": "Delhi"
}
```

---

## Email Template Management

- Create email templates
- Edit templates
- Reusable template support
- Dynamic placeholders

Example:

```html
Hello {{name}},
Welcome to {{company}}
```

---

## Campaign Management

- Create campaigns
- Attach templates
- Select recipients
- Schedule campaigns
- Immediate sending
- Campaign status tracking

Supported statuses:

- Draft
- Scheduled
- Processing
- Completed
- Failed

---

## Bulk Email Sending

- Queue-based processing
- Chunked email dispatching
- Retry handling
- Failed job tracking
- Background workers
- Third-party provider integration

---

## Logs & Reporting

- Email delivery logs
- Failed email logs
- Campaign history
- Delivery status tracking
- Basic reporting

---

# Tech Stack

- PHP 8.3+
- Laravel 13
- MySQL
- Blade Templates
- Bootstrap / AdminLTE
- Laravel Queues
- Eloquent ORM
- Laravel Mail System

---

# Third-Party Email Provider

The platform uses external email delivery providers for reliable bulk email sending.

Recommended provider:

- Mailgun

Future supported providers:

- Amazon SES
- SendGrid

The architecture is designed with provider abstraction to allow easy switching between providers.

---

# Queue Processing

Laravel queues are used for asynchronous bulk email processing.

Recommended queue drivers:

- Database
- Redis

Start queue worker:

```bash
php artisan queue:work
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
|── console.php
└── web.php
```

---

# Installation

## 1. Clone Repository

```bash
git clone https://github.com/malkiatpannu/bulk-mail-portal.git
cd bulk-email-portal
```

---

## 2. Install Dependencies

```bash
composer install
```

---

## 3. Copy Environment File

```bash
cp .env.example .env
```

---

## 4. Configure Database

Update `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bulk_email_portal
DB_USERNAME=root
DB_PASSWORD=
```

---

## 5. Configure Mail Provider

Example Mailgun configuration:

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

## 6. Configure Queue

```env
QUEUE_CONNECTION=database
```

Generate queue tables:

```bash
php artisan queue:table
php artisan migrate
```

---

## 7. Run Migrations

```bash
php artisan migrate
```

---

## 8. Start Queue Worker

```bash
php artisan queue:work
```

---

## 9. Start Development Server

```bash
php artisan serve
```

Application URL:

```bash
http://127.0.0.1:8000
```

---

# Useful Commands

## Clear Cache

```bash
php artisan optimize:clear
```

---

## Run Queue Worker

```bash
php artisan queue:work
```

---

## View Failed Jobs

```bash
php artisan queue:failed
```

---

## Retry Failed Jobs

```bash
php artisan queue:retry all
```

---

# Scalability Considerations

The application is designed to support high-volume email processing using:

- Queue-based architecture
- Chunked processing
- Background workers
- Retry mechanisms
- Provider abstraction
- Modular architecture

The platform is intended to handle 10,000+ email deliveries efficiently.

---

# Future Enhancements

- Advanced analytics dashboard
- Open/click tracking
- Webhook handling
- Multi-provider failover
- Role & permission management
- API support
- Real-time campaign progress
- Redis queue optimization
- Template builder UI

---

# Architecture Documentation

Detailed architecture and workflow documentation is available in:

```bash
ARCHITECTURE.md
```

---

# Conclusion

This platform is designed using modern Laravel development practices with focus on scalability, maintainability, and efficient bulk email processing.

The architecture supports large-scale email campaigns using queue-based processing and third-party email delivery services.