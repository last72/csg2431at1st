<?php
// connect to database
require '../func/dbconnection.php';

// Start or resume a session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check the access level
if (!isset($_SESSION['level']))
{
  $_SESSION['level'] = '';
}

  if ( $_SESSION['level'] != 'admin' )
  {
    header('Location: ../index.php');
    exit;
  }


?>
<!-- // connect to database -->
<!DOCTYPE html>
<html>
<head>
  <title>List Users</title>
  <style type="text/css">
    th,td {border: 1px solid black; width: 150px;}
  </style>
</head>

<body>
<?php require 'navigationbar.php'; ?>

<div class="container">
<h2><strong>List User</strong></h2>



<?php
  //  delete user if del_id GET data exists
  if (isset($_GET['del_id']))
  {
    echo 'Delete in progress';
    
    // delete user account
	  $del_query = 'DELETE FROM users WHERE username = \''.$_GET['del_id'].'\'';
    $del_results = mysqli_query($connection, $del_query);
    
    // delete user's ratings
    $delrating_query = "DELETE FROM ratings WHERE username = '".$_GET['del_id']."'";
    $delrating_result = mysqli_query($connection, $delrating_query);

    // delete user's discussions
    $deldiscussion_query = "DELETE FROM discussion WHERE username = '".$_GET['del_id']."'";
    $deldiscussion_result = mysqli_query($connection, $deldiscussion_query);
  }
  
  $query = "SELECT * FROM users ORDER BY username";
  
  // execute the query
  $results = mysqli_query($connection, $query);
  
  // show how many rows the query returned
  echo '<p>'.$results->num_rows.' users found.</p>';
  
  //start the table in which our user list will be shown
  echo '<table><tr>';
  echo '<th>Username</th><th>Real Name</th><th>Email</th><th>Birth Year</th><th>Country</th><th>Access level</th><th>Manage</th>';
  echo '</tr>';
  
  //  loop through the result and display them
  while ($row = $results->fetch_assoc())
  {
      echo '<td>'.$row['username'].'</td>';
      echo '<td>'.$row['real_name'].'</td>';
      echo '<td>'.$row['email'].'</td>';
      echo '<td>'.$row['birth_year'].'</td>';
      echo '<td>'.$row['country'].'</td>';
      echo '<td>'.$row['access_level'].'</td>';

      echo '<td><a href="userDetails.php?username='.$row['username'].'"">Details</a> ';
	    echo '<a href="editUser.php?edit_id='.$row['username'].'">Edit</a> ';
	    echo '<a href="listUsers.php?del_id='.$row['username'].'"
	    onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a></td></tr>';
  }
  echo '</table>';
  ?>
  </div>
  </body>
</html>