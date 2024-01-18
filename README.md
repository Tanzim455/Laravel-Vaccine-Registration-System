
# Project Setup Guide

Follow these steps to set up the project:

## 1. Install Dependencies

Navigate to the project directory and install the PHP dependencies:

```bash
composer install
```
## 2.Environment Configuration
```
Then in cli run cp .env .env.example
```
## 3. Generate keys
```
 php artisan key:generate
```
## 4.Database Setup
```
Create a database and write similar name of database in .env file
```
## 5.Database migration
```
php artisan migrate
```
## 6.Add data to vaccine_centres table via factory
```
From cli run php tinker
then write 
namespace App\Models;
VaccineCentre::factory(10)->create();
```
## 7.Send the emails with schedule
```
From cli run php artisan schedule:run
```