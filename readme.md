# To-Do List Application

This is a simple To-Do List application built with Laravel 5.3, PHP 7.1, jQuery, and SCSS. The application allows users to create, edit, delete tasks, and track task completion. It also supports user authentication, ensuring that each user can manage their own tasks.

## Technologies

- **Backend**: Laravel 5.3, PHP 7.1
- **Frontend**: jQuery, SCSS, Bootstrap 4
- **Database**: MySQL
- **Containerization**: Docker, Docker Compose

## Requirements

- Docker
- Docker Compose
- Git

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
```

### 2. Copy `.env.example` to `.env`
Create the environment configuration file from the example provided:
```bash
cp .env.example .env
```
Then edit the .env file and configure any necessary environment variables. Example for MySQL:
```makefile
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

### 3. Build and Run Docker Containers
To build and start the Docker containers, run:
```bash
docker-compose up --build -d
```
This will start the containers in detached mode. It creates the following services:

* app: The Laravel PHP application.
* db: The MySQL database.

### 4. Install PHP Dependencies
Once the containers are up, install PHP dependencies inside the app container:
```bash
docker-compose exec app composer install
```

### 5. Run Migrations
To set up the database schema, run the migrations:
```bash
docker-compose exec app php artisan migrate
```

### 6. Access the Application
You can now access the application by visiting:
```
http://localhost
```
If you're using a different port or IP for Docker, adjust the URL accordingly.

## Useful Docker Commands
* Stop containers: `docker-compose down`
* Rebuild containers: `docker-compose up --build -d`
* Access the app container: `docker-compose exec app bash`
