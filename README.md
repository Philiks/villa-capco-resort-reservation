# Villa Capco Resort
## About
A resort management system complete with **booking**, **book cancellation**, **session management (login & logout)**, **forgot password**, **email verification**, and **admin panel**.
This system handles different roles: **admin**, **authenticated user**, and **unauthenticated user**.
role | allowed actions
-- | --
admin | change *per night* rate, monitor reviews, change availability of rooms.
authenticated user | book a room and review & rate the resort experience.
unauthenticated user | book a room
> Authenticated users are those users who created an account for the website. Unauthenticated users on the otherhand did not create an account. Both users *can* book a room so creating an account is *not required*.<br>
> You can read more about the roles and permission [here](#use-case-diagram).

## Installation
### Prerequisite
- [PHP](https://www.php.net/) *at least version 8.1.0*
- [Composer](https://getcomposer.org/) *at least version 2.3.4*
- [Node.JS](https://nodejs.org/en/) *at least version 16.14.0*
- [MySQL](https://www.mysql.com/) *at least version 8.0.29* **or** [MariaDB](https://mariadb.org/) *at least version 10.7.3*
> If you're using **Windows OS**, you could install [XAMPP](https://www.apachefriends.org/download.html) *select the middle option as the first installer contains the previous version while the last contains the latest unstable release* in short the middle installer is the **latest stable release**. You can use the *PHP* and *MySQL* that is included in the *XAMPP*. Just put them in your *environment variable path.*
> *Composer* also has a [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe) for **Windows OS**. This is the easiest way to install *Composer* in your machine.

### Guide
Clone the repository and go to `resort-reservation` directory.
```console
$ git clone https://github.com/Philiks/resort-reservation.git
$ cd resort-reservation
```
console the `.env.example` and named it `.env`.
> This contains the environment variables such as **application name**, **database connection**, and **url**.
```console
$ cp .env.example .env
```
Create database.
> You may create the database by any method that you prefer. The snippet below uses the MariaDB CLI.
```console
$ mariadb -u root -p
MariaDB [(none)]> CREATE DATABASE resort_reservation;
MariaDB [(none)]> quit
```
Install composer packages.
```console
$ composer install
```
Install node packages.
```console
$ npm install
```
Generate application key.
```console
$ php artisan key:generate
```
Create a symbolic link to access storage static files from public.
```console
$ php artisan storage:link
```
Migrate `database/migrations` files and run `database/seeders` as well.
```console
$ php artisan migrate --seed
```
Finally, start the laravel server.
> This is the only step you need to do if you've already done every steps.<br>
> You should not terminate this command while you're using the website. Otherwise press `ctrl + C` to terminate the command. 
```console
$ php artisan serve
```

## Routes
There are different routes that you can traverse. To start, just go to `localhost:8000/` to go to the homepage. From there, you can visit different pages meant for the users (both authenticated and unauthenticated).<br>
To access the admin panel, you must go to the admin subdomain `admin.localhost:8000/`. This will redirect to login page if you have not started any session yet. Here is the admin credentials provided by the seeder:

**Email:** admin@admin.com<br>
**Password:** superadmin

## Diagrams
### Sequence Diagrams
Shows the timeline of different users.
#### Unauthenticated User
![unauthenticated-user-sequence-diagram](./diagrams/unauth_sequence_diagram.png)
#### Authenticated User
![authenticated-user-sequence-diagram](./diagrams/auth_sequence_diagram.png)
#### Admin
![admin-sequence-diagram](./diagrams/admin_sequence_diagram.png)
### Entity Relationship Diagram (ERD)
Shows the relationship of database tables with their cardinality (many-to-many, one-to-many, etc).
![erd-diagram](./diagrams/erd.png)
### Use Case Diagram
Shows the different actions that each roles can do.
![use-case-diagram](./diagrams/use_case_diagram.png)