User Login and Profile Management System
    This project implements a user registration, login and profile management system using PHP, MySQL, HTML, CSS, JavaScript (AJAX), jQuery.

Features
    User registration with name, email and password
    Login with email and password
    Session management for logged in users
    View and update user profile details
    Responsive design for mobile and desktop
    Client-side form validation using jQuery
    Database integration with MySQL
    
Pages
    The site contains the following pages:
      index.php - User registration and login page
      profile.php - User profile page to view/update details
      
Frontend Tech
    The frontend uses:
      HTML5 for content and structure
      CSS3 for styling and layout
      JavaScript for client-side logic
      jQuery for DOM manipulation and AJAX requests
      SweetAlert2 for alert popups
      
Backend Tech
    The backend uses:
      PHP 7.4 for server-side scripting
      MySQL for database creation and querying
      Sessions for user authentication
      
Database Design
    The MySQL database schema is available in guvi_sql.txt. It contains a single users table with columns for:
      id
      name
      email
      password (hashed)
      date_of_birth
      age
      address
      hobbies
      job
      skills
Responsive Design
The site layout is fully responsive using CSS media queries and fluid containers.

Form Validation
Client-side form validation is implemented using jQuery. Server-side validation is done in PHP.

Accessibility
    Semantic HTML is used for better accessibility.
    All images have alternate text.
    Color contrast meets WCAG standards.
    
Installation
    Import the MySQL schema from guvi_sql.txt
    Update the database configuration in config.php
    Deploy source files to a server with PHP 7.4+ and MySQL
