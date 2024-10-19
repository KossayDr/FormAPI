# Form Api

## Overview
The project includes a login and logout system using Laravel API.
The user can fill out a form, upload images and write notes before submitting the form.


## Features

- **User Registration**: Allows users to easily create new accounts.
- **Login**: Provides an interface to log in using email and password.
- **Logout**: Ability to securely log out of the account.
- **Image Upload**: Supports multiple images uploaded by users and stored after reduce size image without package.
- **Notes**: Allows users to add notes related to their accounts.
- **Data Validation**: Uses input validation to ensure the validity of data entered by users.
- **Unit Testing**: Includes unit tests to ensure that features work properly when creating an account and logging in.
- **API Integration**: The project includes API endpoints for task management.

## Technologies Used
- Laravel 8
- MySQL
- Sanctum (for API authentication)


## Installation
1. Clone the repository:
    ```bash
    git clone https://github.com/KossayDr/FormAPI.git
    cd Task-management

    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Set up the environment variables:
    - Copy `.env.example` to `.env`
    ```bash
    cp .env.example .env
    ```



