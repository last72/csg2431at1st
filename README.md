# csg2431at1st
This repository is made for CSG2431 AT2 based on [AT1](https://github.com/last72/csg2431at1st/releases/tag/v1.0)
The folder need to be deployed in development folder (in xammp, htdoc folder).
Woongyeol Choi, Student email: wchoi0@our.ecu.ecu.au, Student number: 10445178

## Database
The SQL Database file is **movietalkat1.sql** and it's under **func** folder.
Use import function in myphpadmin to demonstrate development environment.
Remove previous **movietalkat1** in phpMyAdmin and import the SQL if you have it.

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

Second feedback on 08/10/2018 (Fixed 09/10/2018)
```
I notice you can ban people for negative numbers of hours, so the validation could be tweaked there.
```

### Site Statistics (Mark 6)
- [X] Feature: Build a statistics page that shows number of users, average user age, number of movies, most discussed movies, and highest average rating movie.
- [X] Access level: Admin exclusive.
* Actual time taken: About 2 Hours (03/10/2018)
* Feedback from lecturer: (Fixed 09/10/2018)
```
The statistics page is working well, although some parts could be tweaked a little:
When determining most discussed and most highly rated movie, you can do it in one query by including a join so that you can select the movie name at the same time.
If using multiple queries, it would be best to add an ORDER BY to the first query to ensure that the first row is indeed the one with the most discussion.
```

### Advanced Search Capabilities (Mark 6)
- [X] Feature: Create advanced search feature that can use director, summary, release year, or duration search.
* Actual time taken: 2 Hours (03/10/2018) + 30 Minutes (04/10/2018)
* Things need to be fixed: more than/exact/less than option in duration and release year. (php/advancedsearchresult.php) - Fixed (04/10/2018)
* Feedback from lecturer: (Fixed 09/10/2018)
```
The advanced search is working well.  Did you consider making the values
of the drop down list options actually “=”, “<” and “>”, so that you could use them directly in the query rather than needing a function to determine the correct value?
```

## Final feedback from lecture
```
Nice work, all of the issues mentioned have been fixed up well.
Didn’t spot any other issues, but of course I am not looking at the files as thoroughly as when marking.  Be sure to always have a thorough test of all functionality and double check the brief for any little things that may have been overlooked.
```
Received on 11/10/2018

## Built With

* [Xammp](https://www.apachefriends.org/index.html) - Main developing software.
* [VSCode](https://code.visualstudio.com/) - Used for coding.
* [Github desktop](https://desktop.github.com/) - To collaborate and keep the versions.
* [Chrome](https://www.google.com/chrome/) - To test end-user experience.

## Test sheet 11/10/2018
* Access Level Changing
  * Only admin can see access level change form in user detail. Moderator, member and non-member can't see the form and can't access to it.
  * Access level can be changed one to another (admin to moderator, admin to member, moderator to admin, moderator to member, member to admin, member to moderator).
  * Also, It won't change their access level to member or moderator if there is no other admin.
* Moderator User Level
  * Moderator can put comment in discussion, rating, view profile, update their profile
  * Deleting discussion only visiable to moderator and admin, member and non-member can't access to it even if they type the address directly.
  * Ban user only accept interget that bigger than 1.
  * Ban user function blocks from logging in blocked user.
  * They can't block admin or moderator, they only can block members.
* Site Statistics
  * Statistics page shows number of total user, admin, moderator, and member.
  * It shows average user age based on user's birth year. It rounded in hundredths.
  * It shows number of movies.
  * It shows most discussed movie based on number of posts.
  * it shows highest rated movie and shows average rating.
  * Only admin can access to it. Moderator, member and non-member can't access.
* Advanced Search Capabilities
  * Without selecting any option, it work as normal search.
  * it include director/writers or plot summary if user select the check box.
  * Release year and duration field only accept number.
  * Also, it shows error when it isn't not important and field is empty.
  * Multiple option search works such as search term and release year mixed. It will only show the result that meet every criteria.
  * Anyone can use this including admin, moderator, member and non-member.
* Other feature
  * Register user works.
  * Register movie works.
  * View and edit profile works.
  * See other user's profile through discussion page works.

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

# Site layout
Home
![Layout](/img/Layout1.png?raw=true "Layout")

Sign in
![Layout](/img/Layout2.png?raw=true "Layout")

Home (Member)
![Layout](/img/Layout3.png?raw=true "Layout")

List Movie (Admin)
![Layout](/img/Layout4.png?raw=true "Layout")

Movie Details (Admin)
![Layout](/img/Layout5.png?raw=true "Layout")


# Syntax
* ```require '../func/dbconnection.php';``` to Connect DB.
* ```mysqli_query($connection,$query);``` to use SQL query.
* ```mysqli_error($connection)``` to show db error.


# Author

* **Woongyeol Choi** - *Web Developer* - [last72](https://github.com/last72/)
Student email: wchoi0@our.ecu.ecu.au, Student number: 10445178