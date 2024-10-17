# Invoice App

## Description

Implement a scheduled job in Laravel to generate invoices, allowing users to make partial or full payments. Ensure that users cannot pay more than the remaining balance. If there is an outstanding balance after the due date, the next invoice should include late fees and a 10% interest on the due payment.

## Versions

- **Laravel:** Laravel Framework 10.48.22
- **PHP:** PHP 8.2.12
- **Node.js:** v20.10.0 ( npm -v 10.2.3 )

## Installation Steps

To set up the project locally:

1. Clone the repository:

   git clone https://github.com/amit1767/invoice-app.git

   or

   Download zip.

2. Navigate to the project root directory.

3. Install dependencies:

   composer install

   and

   npm install

4. Copy the environment file:

   cp .env.example .env 
   
   or 
   
   copy .env.example .env

5. Generate an application key:

   php artisan key:generate

6. Set up your database configuration in the `.env` file.

7. Run the migrations:

   php artisan migrate

8. Start the server:

   php artisan serve

   or

   npm run dev

9. Run your application in a web browser.

10. Open the following URL:
    - [http://127.0.0.1:8000](http://127.0.0.1:8000)

    or

    - [http://localhost](http://localhost)
