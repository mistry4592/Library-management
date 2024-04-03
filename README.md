# Library Management System 📚

Welcome to the Library Management System repository! This project aims to provide an efficient solution for managing libraries, allowing users to browse, borrow, and return books seamlessly.

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Introduction
The Library Management System is a web-based application designed to streamline the process of managing library resources. It offers a user-friendly interface for both librarians and patrons, enabling efficient book browsing, borrowing, and returning.

## Features
- **User Authentication:** Secure login system with role-based access control. User roles are displayed in the sidebar. Logout functionality is implemented with a logout link (logout.php).
- **Sidebar Navigation:**
  - Dashboard: Link to index.php.
  - Book Management:
    - Add Book: Link to add_book.php.
    - View All Books: Link to all_book.php.
    - Update Book: Link to update_book.php.
    - Delete Book: Link to delete_book.php.
  - User Management:
    - Add User: Link to add_user.php.
    - Activate User: Link to activate_user.php.
    - View Single User: Link to view_user.php.
    - View All Users: Link to all_user_info.php.
    - Edit User: Link to edit_user.php.
    - Delete User: Link to delete_user.php.
  - Order Management:
    - Issue Book: Link to issue_book.php.
    - Return Book: Link to return_book.php.
    - Book Transaction: Link to transtion.php.
  - Profile Management:
    - User Profile: Link to profile.php.
    - Update Profile: Link to update_user_profile.php.
    - Change Password: Link to change_pass.php.
- **Header:**
  - Menu Toggle: Implemented with a checkbox input (menu-toggle) to toggle the sidebar.
  - Search Icon: Placeholder for search functionality.
  - Notification Icons: Placeholder for notification functionality.
  - User Profile: Displayed with the user's profile picture and logout link.
- **Main Content:**
  - Page Header: Displayed with the title ($headerContent) and navigation breadcrumbs.
  - Page Content: Main content area placeholder.
- **Styling:**
  - Bootstrap CSS and custom CSS for styling the interface.
  - Icons from Line Awesome library used for sidebar and header icons.
  - Dropdown menus for better navigation experience.

## Technologies Used
- **Frontend:** HTML, CSS, JavaScript, Bootstrap
- **Backend:** PHP, MySQL
- **Database:** MariaDB
- **Other Tools:** Git, GitHub, phpMyAdmin

## Installation
1. Clone the repository: `git clone https://github.com/username/library-management-system.git`
2. Import the database schema using phpMyAdmin or MySQL CLI.
3. Configure the database connection in config.php.
4. Launch the application using a web server like Apache or Nginx.

## Usage
- Access the application through your web browser.
- Login with your credentials.
- Explore available books, borrow, and return as needed.
- Admin users can manage books, users, and other system settings.

## Contributing
Contributions are welcome! Please fork the repository and submit a pull request with your enhancements. Ensure to follow the contribution guidelines.

## License
This project is licensed under the MIT License.

## Contact
For any inquiries or support, feel free to reach out to email@example.com.
