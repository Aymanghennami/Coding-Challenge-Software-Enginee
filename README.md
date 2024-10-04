# My Awesome Product Management System

## Table of Contents

- [Description](#description)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running Tests](#running-tests)
- [Contributing](#contributing)
- [License](#license)

## Description

This is a Laravel project for managing products and categories with features including CRUD operations, filtering, and sorting.

## Prerequisites

Before you begin, ensure you have the following installed:

- [PHP](https://www.php.net/downloads) (>= 8.0)
- [Composer](https://getcomposer.org/download/)
- [Laravel](https://laravel.com/docs/11.x/installation) (version 11.x or higher)
- A database server (MySQL, PostgreSQL, SQLite, etc.)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/Aymanghennami/Coding-Challenge-Software-Enginee.git
2. **Navigate to the project folder:**

   ```bash
   cd product-management

 3. Install Packages 

```bash
composer install
```


4. Copy `.env` file 

```bash

cp .env.example .env

```

5. Generate app key 

```bash
php artisan key:generate
```

6. Setting up your database credentials in your `.env` file.
7. Seed Database: 

```bash

php artisan migrate:fresh --seed

```
10. Run 

```bash

php artisan serve

```
## Running Tests

To ensure your application functions correctly, you can run automated tests. Follow these steps to run the tests for your project:

1. **Set Up the Test Database:**

   Before running tests, ensure you have a separate database configured for testing. This can be done by creating a new database and updating your `.env.testing` file with the appropriate settings. 

   Example `.env.testing` configuration:

2.**Run the Tests::**
    ```bash

    php artisan test
    ```
3.**Running Specific Tests**

```bash

    php artisan test tests/Feature/YourTestFile.php

    ```
 
### Explanation of Each Step:

1. **Clone the Repository**: Provides a way for users to get the project code from GitHub.
2. **Navigate to the Project Folder**: Instructions to move into the cloned project directory.
3. **Install Dependencies**: Installs the necessary PHP libraries and packages using Composer.
4. **Copy the Environment File**: Prepares the environment configuration.
5. **Generate Application Key**: Sets up the application key for session encryption.
6. **Database Configuration**: Guides users on how to set up the database connection.
7. **Run Migrations**: Applies database migrations to set up the database schema.
8. **Seed the Database**: Optionally fills the database with initial data.
9. **Run the Application**: Starts the local server to test the application in a web browser.

### Note:

Make sure to customize any sections related to your database connection, seeding data, or any other project-specific configurations. This `README.md` will provide clear, structured guidance for anyone using or contributing to your project.



   
