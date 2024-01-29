
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
From cli run php artisan schedule:work
```
## 8.Create user with email and password from factory
```
From cli run php artisan tinker then run User::factory(10)->create() as many as you want 
```
## 9.Just go to admin/login a login page will appear enter the credentials in your factory 
```
After entering the admin dashboard on left you will see UserVaccineRegistrations below 
dashboard
```
## 10.On right hand side you will see just beside the search input an icon for filter which contains 3 filters
```
Registered-Register but did not yet get a schedule
Scheduled-Scheduled but the dates are greater than present date 
Vaccinated-Vaccinated but the schedule_date is less than present date