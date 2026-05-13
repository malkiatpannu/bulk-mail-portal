# ARCHITECTURE DOCUMENT

# Bulk Mail Management Portal

This document describes the system architecture, workflow design, scalability considerations, and engineering decisions used in the Bulk Email Management Portal.

---

# System Overview

The application is designed using modular Laravel architecture focused on:

* Scalability
* Maintainability
* Queue-based processing
* Third-party integrations
* Separation of concerns
* Production-oriented workflows

Core modules:

* Contact Management
* Email Template Management
* Campaign Management
* Queue Processing
* Email Delivery Service
* Logs & Reporting

---

# High-Level Workflow

```text
Admin User
    ↓
Create Campaign
    ↓
Select Template & Contacts
    ↓
Campaign Jobs Created
    ↓
Queue Workers Process Emails
    ↓
Third-Party Provider Sends Emails
    ↓
Logs Updated
    ↓
Campaign Status Updated
```

---

# System Components

## 1. Contact Management Module

Responsible for:

* CSV/Excel uploads
* Contact validation
* Dynamic field handling
* Contact storage
* Search and filtering

Dynamic fields are stored using JSON structure for flexibility.

Example:

```json
{
    "name": "John Doe",
    "company": "ABC Ltd",
    "city": "Delhi"
}
```

---

## 2. Email Template Module

Responsible for:

* Creating reusable templates
* Placeholder management
* Dynamic content rendering

Example placeholders:

```html
Hello {{name}},
Welcome to {{company}}
```

Placeholders are replaced dynamically during campaign execution.

---

## 3. Campaign Management Module

Responsible for:

* Campaign creation
* Recipient selection
* Scheduling
* Campaign tracking
* Status updates

Supported statuses:

* Draft
* Scheduled
* Processing
* Completed
* Failed

---

## 4. Queue Processing Module

Laravel queues are used to process bulk emails asynchronously.

Benefits:

* Faster HTTP response time
* Better scalability
* Reduced server blocking
* Retry support
* Failure isolation

Recommended queue drivers:

* Database
* Redis

Queue worker command:

```bash
php artisan queue:work
```

---

# Queue Processing Strategy

Workflow:

1. Campaign is created
2. Contacts are divided into chunks
3. Jobs are dispatched to queue
4. Queue workers process jobs in background
5. Emails are sent through provider
6. Delivery logs are updated
7. Campaign status is updated

---

# Chunking Strategy

Chunk processing is used to handle large datasets efficiently.

Example:

```php
Contact::chunk(500, function ($contacts) {
    // dispatch jobs
});
```

Advantages:

* Prevents memory exhaustion
* Handles large imports efficiently
* Reduces database load
* Improves application stability

---

# Email Delivery Architecture

A dedicated service layer is used for email provider integration.

Architecture:

```text
Controller
    ↓
Service Layer
    ↓
Provider Integration
    ↓
Mailgun / SES / SendGrid
```

Advantages:

* Loose coupling
* Easier provider switching
* Better maintainability
* Cleaner controllers
* Easier testing

Current recommended provider:

* Mailgun

Future supported providers:

* Amazon SES
* SendGrid

---

# Database Design

Main tables used/planned:

## contacts

Stores uploaded contacts.

Fields:

* id
* name
* email
* phone
* dynamic_fields (JSON)
* created_at

---

## templates

Stores reusable email templates.

Fields:

* id
* name
* subject
* body
* created_at

---

## campaigns

Stores campaign information.

Fields:

* id
* name
* template_id
* status
* scheduled_at
* created_at

---

## campaign_contact

Stores recipient-level delivery tracking.

Fields:

* id
* campaign_id
* contact_id
* delivery_status
* failure_reason
* sent_at

---

## jobs / failed_jobs

Used by Laravel queue system.

---

# Failure & Retry Handling

The application uses Laravel queue retry mechanisms.

Features:

* Automatic retries
* Failed job logging
* Failure tracking
* Error isolation
* Campaign-level status updates

Useful commands:

```bash
php artisan queue:failed
php artisan queue:retry all
```

---

# Logs & Reporting

The platform maintains:

* Email delivery logs
* Failed email logs
* Campaign history
* Delivery statuses
* Basic reporting

Tracked information:

* Recipient email
* Delivery status
* Failure reason
* Sent timestamp

---

# Security Considerations

Security practices implemented/planned:

* CSRF protection
* Input validation
* Escaped Blade rendering
* Secure SMTP credentials
* Environment-based configuration
* Queue isolation
* Protected admin routes

---

# Scalability Strategy

The platform is designed to support high-volume email processing.

Scalability considerations:

* Queue-based background processing
* Chunked operations
* Redis queue support
* Database indexing
* Provider abstraction
* Multi-worker support
* Separation of concerns

The architecture is intended to handle 10,000+ email deliveries efficiently.

---

# Suggested Production Improvements

Recommended production enhancements:

* Redis queues
* Supervisor process monitoring
* Dedicated queue servers
* Webhook-based delivery tracking
* Monitoring & alerting
* Centralized logging
* Rate limiting
* Multi-provider failover

---

# Folder Structure

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

# Engineering Decisions

Important architectural decisions:

* Laravel chosen for rapid scalable development
* Queue system used for asynchronous processing
* Third-party providers used for reliable email delivery
* Service layer used for provider abstraction
* Chunk processing used for large datasets
* Modular architecture used for maintainability

---

# Conclusion

The application is designed around real-world bulk email processing workflows and follows modern Laravel development standards.

The architecture prioritizes scalability, maintainability, performance, and production readiness.
