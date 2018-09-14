# csg2431at1st
This repository is made for CSG2431 AT1

## Database

The SQL Database file is **movietalkat1.sql** and it's under **func** folder.


## Weekly works

###  ~~Module 1: Introduction to Web Environments, Architecture of Web Applications & Protocols~~
Focus on deploying your development environment and familiarising yourself with it. Make sure you know how to start/stop Apache and MySQL, where code files go, how to request files from your server via your browser… Become familiar with the process of editing a file, saving it and then reloading it in your browser. Read the assignment brief a few times so that you have it in mind in future modules.
###  ~~Module 2: Database Design for Web Applications~~
Now that you’ve covered the creation of databases in phpMyAdmin, try to create the database you will need for the assignment. It is detailed in the assignment brief. Insert some sample data into the tables if you wish. Also spend some time getting familiar with using phpMyAdmin to administer your database.
### Module 3: Forms, Form Processing & Validation
Now that you’ve covered forms and validation, look through the assignment brief and identify all of the major forms – e.g. registration forms, log in forms, forms to create things… Create the forms in HTML files and write JavaScript code to validate them. Don’t worry about the forms not being connected to anything at this stage. Spend some time working on the overall structure of your site/system at this stage – all of the database-driven parts can have placeholders for now. Just flesh out the main pages and get the links between them working.
* ~~Woongyeol - Sign up page, movie registration page~~
* Tash - comment leaving, sign in page, Search page
### ~~Module 4: Form, Web & Database Interaction~~
Now that you’ve covered database interaction, you can really start to work on the functional parts of the assignment. Having the forms, database and general structure of the site will really pay off now, since most of what you need to do is add the code to interact with the database (select, insert, update, delete).
* ~~Woongyeol - Sign up page, movie registration page (Insert, Update, Delete data works)~~
* Tash - comment leaving, ~~sign in page, ~~Search page

* ~~Woongyeol - comment leaving, Search page~~

### ~~Module 5: Control Structures, Calculations & Date/Time Values~~
This week covers more database interaction and some general coding concepts. Continue working on the functional parts of the assignment. Remember to test everything thoroughly, and spend time making sure you understand what each line of code does, rather than blindly copy-pasting lines of code from various places.
### ~~Module 6: Sessions, State Management & User Authentication~~
Now that you’ve covered sessions, you can implement them in your assignment to control access to authorised users. Remember to be consistent and thorough in how you implement sessions.
* ~~Create a login page that requests an email address (as the username) and password, checks them against the database, sets appropriate session variables, and redirects to a main menu / home page.~~
* ~~Check session variables to ensure that the main menu / home page and other pages (e.g. ones to add, edit and delete users) can only be accessed by people who have logged in.~~
* ~~Add a logout page which destroys the session data and redirects the user to the login page.  Add a link to the logout page to all pages requiring the user to be logged in (see goal 2).~~
* ~~Add an access level field to your database's userdetails table, and give any existing users an access level of 'admin', 'editor' or 'guest'.~~  ~~Restrict access to the register and delete page to admin only, the edit page to editor or admin only, and all other pages available to all access levels.~~
### Module 7: ~~Advanced State Management & User/Event Tracking~~
While some of the content in this module is likely to be useful in the second assignment, it won’t introduce anything necessary in assignment 1. Spend the week finalising your assignment code and consider adding extra features or functionality if you can



## Authors

* **Woongyeol Choi** - *Web Developer* - [last72](https://github.com/last72/)- wchoi0@our.ecu.ecu.au
* **Tashi Duks** - *Web Developer* - [TashiDuks](https://github.com/TashiDuks)

## Acknowledgments

* Xammp are used in developing.


# Problems
* ~~in php/newmovieregiresult.php, I couldn't put result to database as we changed the connection code to func/dbconnedtion.php I just addedd ~~
```
@ $db = new mysqli('localhost', 'root', 't00r', 'movietalkat1');
```
~~as temporary solution. ~~

# Regarding to Assessement, Requirements
* Hasing and securing password is extra mark in assessment. not required though.
* ~~grap avarage birth year from database and suggest as recommendation.~~
* ~~Dropdown list for countries~~
* ~~the access level need to be check in every webpage. Like delete function need to be activated only to admin even if they type in get variables in url.~~
* ~~Even if they don't have link to function or page, they can still directly access to it.~~
* SQL injection protection.

# Solved issues
* $del_query = 'DELETE FROM users WHERE username = \''.$_GET['del_id'].'\'';
 * the username need to be covered in '' because it's string. a number do not require that.
* ``` @ $db = new mysqli('localhost', 'root', 't00r', 'movietalkat1');``` is replaced with ```require '../func/dbconnection.php';``` and use ``` $result = mysqli_query($connection,$query);``` instead of ```$result = $db->query($query);```
* ```mysqli_error($connection)``` will replace ```$db->error```.


# Testing account information
* Username: admin, Password: admin
* Username: editor, Password: editor
* Username: member, Password: member
 

# Sitemap diagram
Current Sitemap
![Sitemap](/img/diagram.png?raw=true "Sitemap")

Example Sitemap
![Sitemap](/img/sitemapexample.png?raw=true "exampleSitemap")

# Final Feedback from Lecturer
- [X] Good work, looks like the functionalityis mostly implemented.
- [X] I didn't see any link to the edit profile pagein the member site, but instead there is an edit user page in the admin section...  double check the requirements in the brief.
- [ ] If a member has already rated a movie, they should be able to update/change their rating if they try to rate it again.
- [ ] The navigation around the site could be better - a lot of pages only have a back link, so you have to slowly retrace your steps back to the home page before doing something else.
