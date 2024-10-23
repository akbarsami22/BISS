# Book Information Management System

This is a Laravel 11-based web application designed to manage a collection of books with essential features like user authentication, AJAX integration for seamless form submissions, and full CRUD (Create, Read, Update, Delete) operations for managing book details. The system allows users to securely log in and manage books, including attributes such as title, author, publisher, and year published.

## Features

- **User Authentication:** Secure login and access management to protect the system.
- **AJAX Integration:** Smooth, real-time form submissions and interactions for a better user experience.
- **CRUD Operations:** Easily create, read, update, and delete book entries.
- **Manage Book Attributes:** Store and manage details like the title, author, publisher, and year published.

## Installation

Follow these steps to set up the project on your local machine:

1. **Clone the repository:**

    ```bash
    git clone https://github.com/akbarsami22/BISS.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd BISS
    ```

3. **Install dependencies:**

    ```bash
    composer install
    ```

4. **Set up the environment:**

    - Copy the `.env.example` to create your `.env` file:

        ```bash
        cp .env.example .env
        ```

    - Configure the `.env` file with your database credentials and other necessary details.

5. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

6. **Run database migrations:**

    ```bash
    php artisan migrate
    ```

7. **Serve the application:**

    ```bash
    php artisan serve
    ```

## Usage

### Authentication

- **Login:** Only registered users can access the book management features. The login process is securely handled with user authentication and validation.
- **Access Management:** Users can view, edit, or delete books after authentication.

### AJAX Form Submission

The application uses AJAX for real-time form submissions to add, edit, or delete book entries without reloading the page, making the interaction fast and user-friendly.

### CRUD Operations

- **Create:** Add new books by entering the title, author, publisher, and year published.
- **Read:** View the list of books, with details shown in a clean and structured table.
- **Update:** Modify book details using the edit feature.
- **Delete:** Remove unwanted book entries.

## Project Structure

- **Controllers:** Handles the logic for book management and authentication.
- **Models:** Represents the `Book` entity and interacts with the database.
- **Views:** Blade templates to display the user interface and AJAX-based form handling.

## Output

![biss-4](https://github.com/user-attachments/assets/ee27c4f3-4dee-4962-90dc-555080b2fa8a)

<h4 align="center">Register Page</h4>

![biss-5](https://github.com/user-attachments/assets/35c253fa-827b-4c25-ae61-c8dd17267276)

<h4 align="center">Login Page</h4>

![biss-1](https://github.com/user-attachments/assets/91043a1b-2a50-4a8e-bafa-c0b1d4f10c15)

<h4 align="center">Home Page</h4>

![biss-3](https://github.com/user-attachments/assets/a7d2c953-7ae3-4506-b10b-509c7508dc38)

<h4 align="center">AddBook Page</h4>


![biss-2](https://github.com/user-attachments/assets/5025286a-429c-4b35-808f-d1e0280d23c6)

<h4 align="center">UpdateBook Page</h4>



## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
