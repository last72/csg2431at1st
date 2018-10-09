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

The version control has done using github. recent commits can be viewed in **extra/Commits last72_csg2431at1st 04102018.pdf**


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

Second feedback on 08/10/2018
```
I notice you can ban people for negative numbers of hours, so the validation could be tweaked there.
```

### Site Statistics (Mark 6)
- [X] Feature: Build a statistics page that shows number of users, average user age, number of movies, most discussed movies, and highest average rating movie.
- [X] Access level: Admin exclusive.
* Actual time taken: About 2 Hours (03/10/2018)
* Feedback from lecturer:
```
The statistics page is working well, although some parts could be tweaked a little:
When determining most discussed and most highly rated movie, you can do it in one query by including a join so that you can select the movie name at the same time.
If using multiple queries, it would be best to add an ORDER BY to the first query to ensure that the first row is indeed the one with the most discussion.
```

### Advanced Search Capabilities (Mark 6)
- [X] Feature: Create advanced search feature that can use director, summary, release year, or duration search.
* Actual time taken: 2 Hours (03/10/2018) + 30 Minutes (04/10/2018)
* Things need to be fixed: more than/exact/less than option in duration and release year. (php/advancedsearchresult.php) - Fixed (04/10/2018)
* Feedback from lecturer:
```
The advanced search is working well.  Did you consider making the values
of the drop down list options actually “=”, “<” and “>”, so that you could use them directly in the query rather than needing a function to determine the correct value?
```

## Built With

* [Xammp](https://www.apachefriends.org/index.html) - Main developing software.
* [VSCode](https://code.visualstudio.com/) - Used for coding.
* [Github desktop](https://desktop.github.com/) - To collaborate and keep the versions.
* [Chrome](https://www.google.com/chrome/) - To test end-user experience.

# Testing account information
- ID: 1, PW: 1, access_level: member
- ID: 2, PW: 2, access_level: admin
- ID: 3, PW: 3, access_level: moderator
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