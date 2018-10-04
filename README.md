# csg2431at1st
This repository is made for CSG2431 AT2 based on [AT1](https://github.com/last72/csg2431at1st/releases/tag/v1.0)
The folder need to be deployed in development folder (in xammp, htdoc folder).
Woongyeol Choi, Student email: wchoi0@our.ecu.ecu.au, Student number: 10445178

## Database
The SQL Database file is **movietalkat1.sql** and it's under **func** folder.
Use import function in myphpadmin to demonstrate development environment.

Create a new database called **movietalkat1** in phpMyAdmin and import the SQL.

## Acknowledgments

Test user account information
- ID: 1, PW: 1, access_level: member
- ID: 2, PW: 2, access_level: admin
- ID: 3, PW: 3, access_level: moderator


### Access Level Changing (Mark 4)
- [X] Feature: change access level of user to member, moderator, or admin in **php/userDetails.php** page.
- [X] Access level: Admin exclusive.
- [X] Things to check: Degrading admin should be done when there is more than two admin in db.
- [X] Expected time to developing: 3 hours.
* Actual time taken: 1 Hour 16 minutes (19/09/2018)
* Feedback from lecturer:
```
Nice work, it’s looking good.
Well done immediately changing the access if an admin demotes themselves.
```

### Moderator User Level (Mark 9)
- [X] Feature: Create new access level that has two distint feature on the top of member privilege (Put comment in discussion, rating, view profile, update their profile). 1. Delete any discussion post (including admin, moderator, and member's post). 2. Ban member in other users **php/userDetails.php** page.
- [X] Things to create: Under **users** table, banned_until DATETIME column and a ban_reason VARCHAR column which can be empty.
- [X] Things to check: Delete confirm message when deleting discussions. When user login, current time needs to be bigger than banned_until value. Otherwise, a message shows banned_until time and ban_reason.
- [X] Expected time to developing: 5 hours.
* Actual time taken: About 2 Hours (26/09/2018)
* Feedback from lecturer: (Fixed 28/09/2018)
```
Just realised – remember to update the registration page to account for the new columns.  At the moment, registering is causing a “Column count doesn't match value count at row 1” error due to the extra columns regarding bans.
```

### Site Statistics (Mark 6)
- [X] Feature: Build a statistics page that shows number of users, average user age, number of movies, most discussed movies, and highest average rating movie.
- [X] Access level: Admin exclusive.
* Actual time taken: About 2 Hours (03/10/2018)

### Advanced Search Capabilities (Mark 6)
- [X] Feature: Create advanced search feature that can use director, summary, release year, or duration search.
* Actual time taken: 2 Hours (03/10/2018) + 30 Minutes (04/10/2018)

* Things need to be fixed: more than/exact/less than option in duration and release year. (php/advancedsearchresult.php) - Fixed (04/10/2018)





## Built With

* [Xammp](https://www.apachefriends.org/index.html) - Main developing software.
* [VSCode](https://code.visualstudio.com/) - Used for coding.
* [Github desktop](https://desktop.github.com/) - To collaborate and keep the versions.
* [Chrome](https://www.google.com/chrome/) - To test end-user experience.

# Problems

# Solved issues

# Testing account information
* Username: admin, Password: admin
* Username: member, Password: member
 
# Sitemap diagram
Current Sitemap
![Sitemap](/img/diagram.png?raw=true "Sitemap")

Example Sitemap
![Sitemap](/img/sitemapexample.png?raw=true "exampleSitemap")

# Syntax
* ```require '../func/dbconnection.php';``` to Connect DB.
* ```mysqli_query($connection,$query);``` to use SQL query.
* ```mysqli_error($connection)``` to show db error.


# Author

* **Woongyeol Choi** - *Web Developer* - [last72](https://github.com/last72/)
Student email: wchoi0@our.ecu.ecu.au, Student number: 10445178