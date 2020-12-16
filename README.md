<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://github.com/en3a/auction-laravel/actions"><img src="https://github.com/en3a/auction-laravel/workflows/Laravel Auction CI/badge.svg" alt="Actions"></a>
</p>

## Objective / Requirements / Task Description

Your task is to create a web auction application for an antique items seller. The application will allow users to bid on
antique items displayed in the site and admin users to set up items for auction. Product management and auctioning are
within the scope of the application; shopping cart and payment integration are not.

- Use PHP / Laravel on the Back-end and React.js on the Front End.
- Use Database engine of your choice.
- Implement form submission validation on the Front End side.
- Implement validation on the Back End side for the creation and modification of items.
- Use git to commit your work.
- Function body should not exceed 30 LOC.
- Class should not exceed 200 LOC.
- Stick to DRY principles.
- Base your implementation on design patterns.
- Layout should be responsive and follow UI/UX best practices.
- Any Image files should be uploaded and shared in a zip file.


- ***Summary of main features:***
- Home Page – Item’s listing (preferably in gallery view)
- Item Detail Page with Item bidding history
- Bid Now functionality
- Auto-bidding functionality

## Server Requirements

- PHP >= 7.4
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- NGINX / APACHE
- MYSQL / MARIADB
- COMPOSER
- DOCKER (optional)

## Installation via Docker (recommended)

*We can put to use Laravel Sail which will create all the dependencies needed for the application to run correctly.

***You will need docker and docker-compose installed in order to continue with this step***

- Clone the repository
- Install the dependencies
  ``` composer install ```
- Build and bring up containers via Laravel Sail (it may take a while the first time)

  ``` vendor/bin/sail up ```

- Generate application key
  ``` vendor/bin/sail artisan key:generate ```

- Create database tables and seeder
  ``` vendor/bin/sail artisan migrate:fresh --seed```
- Create storage symlink
  ``` vendor/bin/sail artisan storage:link ```

- Install / Compile assets (even though assets are already built. You will need nodejs and npm for this)
  ``` npm install && npm run prod ```

- Running queues on background for auto-bid feature (used to solve concurrency issues)
  ``` vendor/bin/sail artisan queue:work ```

## Local Installation

- Clone the repository
- Create the environment file
  ``` cp .env.example .env ```
  
- Change environment variables as follows
  
    ``` DB_HOST=127.0.0.1 ```
  
    ``` MEMCACHED_HOST=127.0.0.1 ```
  
    ``` REDIS_HOST=127.0.0.1 ```
  
- ***Configure the .env file by inserting app name, database credentials***
- Install the dependencies
  ``` composer install ```
- Generate application key
  ``` php artisan key:generate ```
- Create database tables
  ``` php artisan migrate:fresh ```
- Create storage symlink
  ``` php artisan storage:link ```
- Or you can use the one-liner

``` composer install && php artisan key:generate && php artisan migrate:fresh && php artisan storage:link ```

- On production dependecies can be optimized by running
  ``` composer install --optimize-autoloader --no-dev ```

- Install / Compile assets (even though assets are already built. You will need nodejs and npm for this)
  ``` npm install && npm run prod ```

- Running queues on background for auto-bid feature (used to solve concurrency issues)
  ``` php artisan queue:work ```

## Github Actions

Github actions are configured as pipelines for CI in order to automatically run the tests for the project. They are
triggered by pushing to master or creating a MR (merge request) to master.

Latest Status:

<a href="https://github.com/en3a/auction-laravel/actions"><img src="https://github.com/en3a/auction-laravel/workflows/Laravel Auction CI/badge.svg" alt="Actions"></a>

## Platform Usage

### Users and authentication
Platform provides only authentication functionality and has two predefined user accounts.

***username/password***

      - user1/password
      - user2/password

### Overall usage
Items are already configured on seeder and after logging in to the platform a user can see a paginated
list of items.

Users can bid on items, can configure auto-bid on settings page for setting up the limit and also can activate
auto-bid for specific items.

Auto-bid feature needs queues in order to work. The queue driver for this case is database but we can speed it up by
using a faster key:pair database like Redis. Queues makes sure that the job is dispatched one by one and in order so 
the jobs do not "race" for execution.

## Running tests

``` phpunit ```
**OR**
``` /vendor/bin/phpunit ```

## Contact

For any questions feel free to contact @ ***eneadede96@gmail.com*** OR ***enea.dede@elitestudio.io***

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
