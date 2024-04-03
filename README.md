# Library Management System

This is a web-based library management system designed to efficiently manage books, users, and book transactions in a library setting.

## Features

### User Authentication:
- User roles are displayed in the sidebar.
- Logout functionality is implemented with a logout link (logout.php).

### Sidebar Navigation:
- **Dashboard:** Link to index.php.
- **Book Management:**
  - **Add Book:** Link to add_book.php.
  - **View All Books:** Link to all_book.php.
  - **Update Book:** Link to update_book.php.
  - **Delete Book:** Link to delete_book.php.
- **User Management:**
  - **Add User:** Link to add_user.php.
  - **Activate User:** Link to activate_user.php.
  - **View Single User:** Link to view_user.php.
  - **View All Users:** Link to all_user_info.php.
  - **Edit User:** Link to edit_user.php.
  - **Delete User:** Link to delete_user.php.
- **Order Management:**
  - **Issue Book:** Link to issue_book.php.
  - **Return Book:** Link to return_book.php.
  - **Book Transaction:** Link to transtion.php.
- **Profile Management:**
  - **User Profile:** Link to profile.php.
  - **Update Profile:** Link to update_user_profile.php.
  - **Change Password:** Link to change_pass.php.

### Header:
- **Menu Toggle:** Implemented with a checkbox input (menu-toggle) to toggle the sidebar.
- **Search Icon:** Placeholder for search functionality.
- **Notification Icons:** Placeholder for notification functionality.
- **User Profile:** Displayed with the user's profile picture and logout link.

### Main Content:
- **Page Header:** Displayed with the title (\$headerContent) and navigation breadcrumbs.
- **Page Content:** Main content area placeholder.

### Styling:
- Bootstrap CSS and custom CSS for styling the interface.
- Icons from Line Awesome library used for sidebar and header icons.
- Dropdown menus for better navigation experience.

## Technologies Used
- PHP
- MySQL
- HTML
- CSS (including Bootstrap)
- JavaScript

## Getting Started
1. Clone the repository.
2. Import the database schema from the `database.sql` file into your MySQL database.
3. Configure the database connection in the `inc/config.php` file.
4. Serve the PHP files using a local server environment like XAMPP or WAMP.
5. Access the application through the web browser.

## Contributors
- Chirag Mistry

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
