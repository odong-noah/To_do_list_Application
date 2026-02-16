<?php
die();

/*
=====================================================
TO DO LIST APPLICATION - MANIFEST
=====================================================
Last update: February 12th 2026

System Name:
To Do List Management System

User Interface:
https://

Dashboard:
https:

=====================================================
PURPOSE
=====================================================
The To Do List Management System is a productivity-focused
web application designed to help users manage daily tasks,
track deadlines, organize activities using a calendar,
and store quick notes via a sticky wall feature.

The system emphasizes:
- Simplicity
- Strong password security
- Task organization
- User ownership of data
- Clean and intuitive UI/UX

=====================================================
CORE FEATURES
=====================================================
- Secure user registration and login
- Strong password enforcement (minimum 8 characters,
  mixed letters, numbers, and symbols)
- Task creation and categorization (Personal / Work)
- Task status management (Pending / Completed / Overdue)
- Expandable task details (date, category, status)
- Paginated task display using manual numeric sliders
  (5 tasks per slide)
- Calendar modal for date selection
- Sticky Wall modal for date-based note creation
- Sticky note search by date
- User-specific data isolation
- Modern Bootstrap-based UI with icons and hover effects

=====================================================
FOLDER STRUCTURE
=====================================================
Base folder:

/To_do_list

    /Assets
        To_do_list_index.css
        To_do_list_index.js
        To_do_list_login.css
        To_do_list_login.js
        To_do_list_signup.css  
        To_do_list_signup.js       
    

    /config
        dataconnect.php

    /controllers
        auth_guard.php
        To_do_list_dashboard_api.php
        To_do_list_login_api.php
        To_do_list_signup_api.php
        To_do_list_delete_task_api.php
        To_do_list_edit_account_api.php
        To_do_list_stickywall_api.php
        To_do_list_add_task_api.php

    /Modals
        To_do_list_add_task.php
        To_do_list_delete_task.php
        To_do_list_edit_account.php
        To_do_list_index_stickywall.php
        To_do_list_index_calender.php
        To_do_list_logout_modal.php

    To_do_list_index.php
    To_do_list_login.php
    To_do_list_signup.php
    MANIFEST.PHP

=====================================================
FILES TO NOTE
=====================================================
- dataconnect.php
  Core database connection, security helpers,
  session handling, and input sanitization.

- auth_guard.php
  Prevents unauthorized access to protected pages.

-  To_do_list_signup.php
  User registration interface with strong password
  enforcement and confirmation validation.

-  To_do_list_login.php
  Authentication interface for registered users.

-  To_do_list_index.php
  Main application interface:
  - Task list
  - Expandable task details
  - Task pagination sliders
  - Calendar modal
  - Sticky Wall modal

- actions
  Server-side logic for all CRUD operations.

=====================================================
DATABASE
=====================================================
Database Name:
to_do_list

-----------------------------------------------------
TABLE: to_do_list_user
-----------------------------------------------------
Stores registered user information.

Fields:
- to_do_list_user_id (INT, PK, AUTO_INCREMENT)
- to_do_list_user_username (VARCHAR, UNIQUE)
- to_do_list_user_email (VARCHAR, UNIQUE)
- to_do_list_user_password (VARCHAR, HASHED)
- to_do_list_user_created_at (TIMESTAMP)

-----------------------------------------------------
TABLE: to_do_list_task
-----------------------------------------------------
Stores user tasks.

Fields:
- to_do_list_task_id (INT, PK, AUTO_INCREMENT)
- to_do_list_user_id (INT, FK)
- to_do_list_task_category (VARCHAR)
- to_do_list_task_title (VARCHAR)
- to_do_list_task_description (TEXT)
- to_do_list_task_date (DATE)
- to_do_list_task_created_at (TIMESTAMP)

Relationship:
- Many tasks belong to one user
- ON DELETE CASCADE enforced

-----------------------------------------------------
TABLE: to_do_list_stickywall
-----------------------------------------------------
Stores sticky wall notes.

Fields:
- to_do_list_stickywall_id (INT, PK, AUTO_INCREMENT)
- to_do_list_user_id (INT, FK)
- to_do_list_stickywall_date (DATE)
- to_do_list_stickywall_title (VARCHAR)
- to_do_list_stickywall_description (TEXT)
- to_do_list_stickywall_created_at (TIMESTAMP)

Relationship:
- Many sticky notes belong to one user
- ON DELETE CASCADE enforced

=====================================================
SECURITY RULES
=====================================================
- Passwords must be at least 8 characters
- Passwords must contain:
  - Letters
  - Numbers
  - Symbols
- Only strong passwords are accepted
- Passwords must match confirmation field
- Passwords are hashed using password_hash()
- Sessions are validated on every protected route
- User data is strictly isolated per session

=====================================================
UI & UX BEHAVIOR
=====================================================
- Tasks expand inline when the arrow icon is clicked
- Expanded view shows:
  - Due date
  - Category (Personal / Work)
  - Status
  - Mark as Complete option
- Tasks are displayed in slides of 5
- Numeric pagination controls allow manual navigation
- Calendar opens as a modal for date selection
- Sticky Wall opens in a modal
- Sticky notes are organized by creation date
- Hover effects applied uniformly across navigation items

=====================================================
API / ACTION ENDPOINTS
=====================================================
actions/To_do_list_signup_api.php
-- Handles new user registration

actions/To_do_list_login_api.php
-- Handles user authentication

actions/To_do_list_add_task_api.php
-- Creates a new task

actions/To_do_list_edit_account_api.php
-- edit account details

actions/ To_do_list_delete_task_api.php
-- Deletes a task

actions/ To_do_list_add_task_api.php
-- Saves a sticky note

actions/ To_do_list_stickywall_api.php
-- Fetches sticky notes by date

      
=====================================================
HOW TO SET UP THIS PROJECT
=====================================================
1. Create the database "to_do_list"
2. Run the provided SQL schema
3. Update dataconnect.php with your DataBase credentials
4. Upload project files to server
5. Ensure HTTPS is enabled
6. Access To_do_list_signup.php to register users

=====================================================
HOW TO RUN THE PROJECT
=====================================================
Open your browser and navigate to:

https://

=====================================================
END OF MANIFEST
=====================================================
*/


