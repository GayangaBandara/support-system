# Support System

## Overview
The Support System is a Laravel-based web application designed to manage customer support requests. Customers can submit support tickets without creating an account and track their issues using a unique reference number. Support agents can manage and handle these tickets efficiently.

---

## Objectives
- Convert user requirements into application features
- Map real-world entities into a database structure
- Implement CRUD operations using Laravel
- Understand MVC architecture and Laravel tools

---

## Features
- Create support tickets
- View ticket details
- Search tickets using reference number
- Basic ticket status management
- Form validation
- Flash messages for user feedback
- Email notification for ticket creation (optional)

---

## System Design

### Entities
- User (Support Agent)
- Ticket (Support Request)

### Relationship
- One User manages many Tickets
- One Ticket belongs to one User

---

## Technologies Used
- Laravel
- PHP
- MySQL
- Composer
- Bootstrap
- Postman

---

## Installation and Setup

### 1. Clone Repository
git clone https://github.com/GayangaBandara/support-system.git
cd support-system  

### 2. Install Dependencies
composer install  

### 3. Configure Environment
Copy .env.example to .env  

Update database configuration:

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=support  
DB_USERNAME=root  
DB_PASSWORD=  

### 4. Generate Application Key
php artisan key:generate  

### 5. Run Migrations
php artisan migrate  

### 6. Start Development Server
php artisan serve  

Open in browser:  
http://localhost:8000  

---

## Usage
1. Open the application  
2. Click "Open New Ticket"  
3. Fill the form and submit  
4. Receive a reference number  
5. Use the reference number to search and view the ticket  

---

## Application Flow
1. Customer submits a support request  
2. System stores ticket data in database  
3. Unique reference ID is generated  
4. Ticket details are displayed  
5. User can search ticket using reference number  

---

## Validation Rules
- Name is required  
- Email must be valid  
- Description is required  
- Phone is optional  

---

## Project Structure
- Models handle database logic  
- Controllers handle application logic  
- Views handle UI  
- Routes handle request mapping  

---

## Future Improvements
- Add authentication for agents  
- Add ticket reply system  
- Add file attachments  
- Improve UI design  
- Add ticket categories  

---

## License
MIT License © [GayangaBandara](https://github.com/GayangaBandara)