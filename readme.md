# Web Technologies Events Management - For Organizer

# About

Web application helping them to manage the events and allowing attendees to sign up and see all information they need.

## Extension Application
### Web Technologies Events Management - For Attendee
https://github.com/locle-isme/event-booking-platform-client
## Prerequisites

* PHP 7.x
* MariaDB 10.x
* [XAMPP](https://www.apachefriends.org/download.html)
* [COMPOSER](https://getcomposer.org/download/)

## BUILDING Open terminal source project.

Run:

```bash
composer install
```

Copy `.env.example` file and rename to `.env`. This is file configuration of application. Update some fields of this
file:

```
.     
└───.env.example
```

```bash
DB_CONNECTION=mysql #type DBMS
DB_HOST=127.0.0.1 #host
DB_PORT=3306 #port database
DB_DATABASE=event_booking_platform #name database
DB_USERNAME=root #user
DB_PASSWORD= #password
```

Generate key for application

```bash
php artisan key:generate
 ```

import database into your DBMS.

```
.     
└───db-dump
│   │   event_booking_platform.sql
```

Run serve:

```bash
php artisan serve
```
### Demo account
```html
Email: demo1@worldskills.org | Password: demopass1
Email: demo2@worldskills.org | Password: demopass2
```

### Note: If has errors with database, you can try it

```bash
php artisan migrate:refresh
php artisan db:seed
```
