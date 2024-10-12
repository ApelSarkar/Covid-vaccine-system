<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Covid Vaccine System

-   [Clone the repository from here] (https://github.com/ApelSarkar/Covid-vaccine-system).

## Install Dependencies

-   `composer install`

## Set up the environment file:

-   `cp .env.example .env`
-   `php artisan key:generate`

## Run the migrations:

-   `php artisan migrate`

## Pre-populate the Database run db seed:

-   `php artisan db:seed`

## Run scheduler command to execute vaccination schedule:

-   `php artisan vaccination:schedule`

## Start the development server:

-   `php artisan serve`

## How I would optimise these:

If I have more time i opitimize the project in several ways like:

**Database indexing**: I ensure that the key columns, like nid (National ID), email, and vaccine_center_id, are indexed. This will help speed up database write and read operations.

**Batch Insertions**: If handling bulk registrations, use batch inserts to reduce the number of database transactions:

**Queue for Time-Consuming Tasks**: For processes like sending emails or other heavy operations during registration, I used Laravel queu.

**Full-Text Search**: I will implement full-text indexing for faster searches, especially for columns like name, email, or any other text-based fields:

**Eager Loading**: If my search queries often involve relationships (e.g., vaccine_center),I use eager loading to minimize the number of database queries.

**Cache Search Results**: For commonly searched terms or filters, I can use Laravel's cache to improve search result.

## Integrate an SMS Service:

I will Twilio or any local SMS gateway provider.
I had update the current email notification logic to also sending SMS.

As I used Scheduler, when I run a command with a specific time and date, the mail is sent to the user.

For SMS notication I can also use scheduler command like and changed the logic in ScheduleVaccination.php file

-   `php artisan send:notifications`

### Screenshot section:I've added screenshots below:

-   **Registration Form**:

<p align="center">
  <img src="screenshots/Registration.png" alt="Registration Form" width="600">
</p>

-   **Vaccination Status Successfull**:

<p align="center">
  <img src="screenshots/Vaccine Registration Status check.png" alt="Registration Form" width="600">
</p>

-   **Vaccination Status Form**:

<p align="center">
  <img src="screenshots/Search Vaccination Status .png" alt="Registration Form" width="600">
</p>

-   **Vaccination Status Search result**:

<p align="center">
  <img src="screenshots/Vaccine Registration Status.png" alt="Registration Form" width="600">
</p>

-   **Vaccination Center limit status check result**:

<p align="center">
  <img src="screenshots/FCOVID limit Vaccine Registration.png" alt="Registration Form" width="600">
</p>

-   **Vaccination Registration not found status check result**:

<p align="center">
  <img src="screenshots/Vaccine Registration Status not found.png" alt="Registration Form" width="600">
</p>

-   **Vaccination Registration mail check result**:

<p align="center">
  <img src="screenshots/Mailtrap - Email Delivery Platform - mailtrap.io.png" alt="Registration Form" width="900">
</p>
