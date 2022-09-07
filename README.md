## C9 Test Laravel Project

Made with Laravel 9 as the backend and AdminLTE 3 template for the frontend.

This is a simple project about:

1. User Management
2. Managing user roles/permissions
3. Checking page and action restrictions 
4. Uploading and saving files to database in a base64 encoded string format.

## Installation

To install on your local machine:

1. Clone the project using GIT.
2. Run `composer install`.
3. Run `npm install` and `npm run dev`
4. Update the .env file for the database connection.
5. Run `php artisan migrate --seed`

## Accounts

You can do some tests using these pre-populated user accounts.

Admin Account
Email: admin@gmail.com
Password: admin

Member Account
Email: member@gmail.com
Password: member

## Quick Note

When going to the File Uploads pages(index and edit), I tried displaying the base64 encoded string but some are quite long and makes the page loading very slow(more than 10secs) thus I did not display it. To check if the file is encoded to base64 properly, you can just double check it on the database table/field directly. 

Thank you.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
