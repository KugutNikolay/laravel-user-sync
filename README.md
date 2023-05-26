# Laravel User Synchronization App

This is a simple Laravel application that synchronizes user data with JSONPlaceholder API and stores it in a MySQL database. It also provides a web page to display the list of users.

## Prerequisites

Make sure you have the following prerequisites installed on your local machine:

- Docker
- Docker Compose

## Getting Started

To get started with the Laravel User Synchronization App, follow the steps below:

1. Install Docker
2. Clone repository
3. Copy `.env.example` to `.env`
4. Run command `docker compose -f docker-compose.yml up -d`
5. Install dependencies `docker exec -it  user-sync-app_php-fpm_1 composer install`
6. Run the database migrations `docker exec -it  user-sync-app_php-fpm_1 php artisan migrate`
7. Access the application in your browser: [http://localhost:8084](http://localhost:8084)

## Usage

- To synchronize user data from JSONPlaceholder API to the database, you can run the following command:

    `docker exec -it  user-sync-app_php-fpm_1 php artisan users:sync`
    
    or
    
    `docker exec -it  user-sync-app_php-fpm_1 php artisan schedule:list`


- To update user data from JSONPlaceholder API regularly using the Laravel Scheduler, the application is already configured to run the synchronization command hourly. You can modify the schedule as needed in the `app/Console/Kernel.php` file.

## Running Tests

To run the tests for the application, use the following command:

`docker exec -it  user-sync-app_php-fpm_1 php artisan test`
