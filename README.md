# Online Library Management System
<p align=center><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"><p>

## Description

The Online Library Management System is a web application designed to manage library resources effectively. It helps in organizing and managing the library's inventory, borrowing process, and much more. This system provides an easy-to-use interface for librarians and users, ensuring smooth operations within a library.
		
## Technologies Used
- Backend: PHP Laravel
- Frontend: Blade, Javascript
- Database: SQLite
- [Google Books Web API](https://developers.google.com/books)
- Unit testing using PHPUnit

## Features
- User Authentication & Management: Registration, logging-in & updating user information.
- Book Management: Allowing staff members to add new books, edit details and more.
- Improved UX for library staff: When adding books to the library system, an auto-fill feature is available to autofill the book informations using Google Books API.
- Borrowing, Reserving and Returning: Tracks the borrowing, returns and book reservations.
- Transactions logging: Logs transactions for both students and library admins.

## Usage

### With Docker

1. Ensure you have [Docker](https://www.docker.com/get-started) installed on your machine.
2. Build the Docker image and run the container:

    - **Linux & macOS:**
        ```sh
        bash rundocker.sh
        ```

    - **Windows:**
        - Copy the script from `rundocker.sh` and run it in your preferred CLI.
3. Access the application at `http://localhost:8000`.

### Without Docker

1. [Install Composer & Laravel](https://laravel.com/docs/11.x/installation)
2. [Install SQLite](https://www.sqlite.org/download.html)
3. Open the project directory and install the dependencies needed:
```sh
    composer update && composer install
```
4. Run the database migrations:
```sh
    php artisan migrate
```
5. Run the project using:
```sh
    php artisan serve
```

## Adding the first staff member
To add the first staff member, you can naviage to: app/`Http/Controllers/Auth/RegisterController.php` , at the end of the class you will find an addAdmin function that you can change the default admin user details and then navigate to the `/addAdmin` page and the user will be added as admin. This function of course, would be removed in case the website goes to production.
		
## Contributors
		
- [Sayed Hesham Husain](https://github.com/heshamalmosawi)		
- [Loay Dalal](https://github.com/loaydalal)
- [Sayed Redha Mohammed](https://github.com/SayedRedha77)
- [Hussain Abdulnabi Salman](https://github.com/shakhoori10)