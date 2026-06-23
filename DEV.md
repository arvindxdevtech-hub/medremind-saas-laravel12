# 💊 MedRemind Developer Documentation (DEV.md)

## Purpose

This document explains:

- Project setup
- Folder structure
- Feature implementation
- Artisan commands used
- Database design
- Events & Listeners
- Notifications
- Scheduler
- Queue processing
- Development workflow

This file is intended for developers maintaining or extending MedRemind.

---

# Project Overview

MedRemind is a Laravel-12-based Medicine Reminder & Medication Tracking System.

Core Flow:

User

↓

Authentication

↓

Medicine Management

↓

Schedule Management

↓

Reminder Generation

↓

Scheduler

↓

Notification Processing

↓

Medicine Tracking

↓

Dashboard Analytics

---

# Initial Project Setup

## Create Project

```bash
composer create-project laravel/laravel medremind
```

## Install Breeze Authentication

```bash
composer require laravel/breeze --dev

php artisan breeze:install

npm install

npm run build

php artisan migrate
```

---

# Database Tables

```text
users
medicines
schedules
reminders
notifications
medicine_logs
```

---

# Module 1: Authentication

## Purpose

Provides:

- Registration
- Login
- Logout
- Profile Management

## Files

```text
routes/auth.php

resources/views/auth/

app/Models/User.php
```

---

# Module 2: Medicine Management

## Build Command

```bash
php artisan make:model Medicine -mcr
```

## Generated Files

```text
app/Models/Medicine.php

app/Http/Controllers/MedicineController.php

database/migrations/create_medicines_table.php
```

## Responsibilities

- Add Medicine
- Update Medicine
- Delete Medicine
- View Medicines

## Relationship

```php
User hasMany Medicines

Medicine belongsTo User
```

---

# Module 3: Schedule Management

## Build Command

```bash
php artisan make:model Schedule -mcr
```

## Generated Files

```text
app/Models/Schedule.php

app/Http/Controllers/ScheduleController.php

database/migrations/create_schedules_table.php
```

## Responsibilities

- Add Schedule
- Edit Schedule
- Delete Schedule
- Weekly Scheduling

## Relationship

```php
Medicine hasMany Schedules

Schedule belongsTo Medicine
```

---

# Module 4: Reminder System

## Build Command

```bash
php artisan make:model Reminder -m
```

## Generated Files

```text
app/Models/Reminder.php

database/migrations/create_reminders_table.php
```

Database Table:

```text
reminders
```

Columns:

```text
id
schedule_id
reminder_time
status
created_at
updated_at
```

Status:

```text
pending
sent
```

---

# Module 5: Event Driven Architecture

When Schedule is created:

```text
User Creates Schedule

↓

ScheduleCreated Event

↓

GenerateReminders Listener

↓

Reminder Records Created
```

---

## ScheduleCreated Event

### Build Command

```bash
php artisan make:event ScheduleCreated
```

### File

```text
app/Events/ScheduleCreated.php
```

Purpose:

Trigger reminder generation.

---

## GenerateReminders Listener

### Build Command

```bash
php artisan make:listener GenerateReminders
```

### File

```text
app/Listeners/GenerateReminders.php
```

Responsibilities:

Generate:

- Current Week Reminder
- Next Week Reminder

Example:

Schedule:

```text
Tuesday 01:00 PM
```

Creates:

```text
24 Jun 2026 01:00 PM
01 Jul 2026 01:00 PM
```

---

# Module 6: Reminder Processing Command

## Build Command

```bash
php artisan make:command ProcessReminders
```

## File

```text
app/Console/Commands/ProcessReminders.php
```

Command:

```bash
php artisan medicine:process-reminders
```

Responsibilities:

1. Find pending reminders
2. Send notification
3. Send email
4. Mark reminder sent
5. Create future reminder

Flow:

```text
Pending Reminder

↓

Notification

↓

Email

↓

Status = Sent

↓

Generate Next Reminder
```

---

# Module 7: Notification System

## Build Command

```bash
php artisan make:notification MedicineReminderNotification
```

## File

```text
app/Notifications/MedicineReminderNotification.php
```

Channels:

```php
return ['mail', 'database'];
```

---

# Module 8: Email Templates

## File

```text
resources/views/emails/reminder.blade.php
```

Purpose:

Medicine reminder email.

Example:

```text
Hello Arvind,

It's time to take your medicine.

Medicine:
Crocin 650
```

---

# Module 9: Database Notifications

Table:

```text
notifications
```

Stored Example:

```json
{
    "medicine_id": 1,
    "medicine_name": "Crocin 650",
    "message": "Medicine reminder sent"
}
```

---

# Module 10: Scheduler

## File

```text
routes/console.php
```

Registered Command:

```php
Schedule::command(
    'medicine:process-reminders'
)->everyMinute();
```

Run Scheduler:

```bash
php artisan schedule:work
```

Production Cron:

```bash
* * * * * php artisan schedule:run >> /dev/null 2>&1
```

---

# Module 11: Queue System

Run Queue:

```bash
php artisan queue:work
```

Used For:

- Email Notifications
- Background Jobs

---

# Module 12: Medicine Tracking

## Build Commands

```bash
php artisan make:model MedicineLog -m

php artisan make:controller MedicineLogController
```

## Generated Files

```text
app/Models/MedicineLog.php

app/Http/Controllers/MedicineLogController.php

database/migrations/create_medicine_logs_table.php
```

Status:

```text
taken
missed
```

Flow:

```text
Dashboard

↓

Taken / Missed

↓

medicine_logs updated
```

---

# Module 13: Dashboard Analytics

## Build Command

```bash
php artisan make:controller DashboardController
```

## Files

```text
app/Http/Controllers/DashboardController.php

resources/views/dashboard.blade.php
```

Cards:

- Total Medicines
- Total Schedules
- Pending Reminders
- Sent Reminders
- Notifications

Sections:

- Today's Medicines
- Recent Medicines
- Recent Notifications

---

# Seeder Commands

Create Seeder:

```bash
php artisan make:seeder DemoUserSeeder

php artisan make:seeder MedicineSeeder
```

Run:

```bash
php artisan db:seed
```

Fresh Install:

```bash
php artisan migrate:fresh --seed
```

---

# Relationships

User

```php
hasMany Medicines
```

Medicine

```php
belongsTo User

hasMany Schedules
```

Schedule

```php
belongsTo Medicine

hasMany Reminders
```

Reminder

```php
belongsTo Schedule
```

MedicineLog

```php
belongsTo User

belongsTo Medicine
```

---

# Local Development Startup Checklist

Start MySQL

↓

Run App

```bash
php artisan serve
```

↓

Run Queue

```bash
php artisan queue:work
```

↓

Run Scheduler

```bash
php artisan schedule:work
```

↓

Application Ready

---

# Frequently Used Artisan Commands

Create Model + Migration + Controller

```bash
php artisan make:model Example -mcr
```

Create Migration

```bash
php artisan make:migration create_example_table
```

Create Controller

```bash
php artisan make:controller ExampleController
```

Create Event

```bash
php artisan make:event ExampleEvent
```

Create Listener

```bash
php artisan make:listener ExampleListener
```

Create Notification

```bash
php artisan make:notification ExampleNotification
```

Create Command

```bash
php artisan make:command ExampleCommand
```

Create Seeder

```bash
php artisan make:seeder ExampleSeeder
```

Open Tinker

```bash
php artisan tinker
```

---

# Future Architecture

Planned Enhancements:

- Adherence Analytics
- Weekly Reports
- Monthly Reports
- Chart.js Dashboard
- PDF Reports
- WhatsApp Notifications
- SMS Notifications
- Push Notifications
- Multi-Tenant SaaS
- Organizations
- Family Accounts
- Subscription Billing

---

# Maintainer

Arvind Singh

PHP / Laravel Developer

Experience: 9+ Years

---

# 📄 License

MIT License
