<?php
//Start or resume a session
session_start();

  if ( $_SESSION['level'] != 'admin' )
  {
    header('Location: ../index.php');
    exit;
  }


?>
<?php include '../func/dbconnection.php';?>
<?php   // connect to database
  @ $db = new mysqli('localhost', 'root', '', 'movietalkat1');
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>List Users</title>
  <style type="text/css">
    th,td {border: 1px solid black; width: 150px;}
  </style>
</head>

<body>
<h2><strong>List User</strong></h2>



<?php
  //  delete user if del_id GET data exists
  if (isset($_GET['del_id']))
  {
	  echo 'Delete in progress';
	  $del_query = 'DELETE FROM users WHERE username = \''.$_GET['del_id'].'\'';
	  $del_results = $db->query($del_query);
  }
  
  $query = "SELECT * FROM users ORDER BY username";
  
  // execute the query
  $results = $db->query($query);
  
  // show how many rows the query returned
  echo '<p>'.$results->num_rows.' users found.</p>';
  
  //start the table in which our user list will be shown
  echo '<table><tr>';
  echo '<th>Username</th><th>Name</th><th>Email</th><th>Birth Year</th><th>Country</th><th>Access level</th><th>Manage</th>';
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

	  echo '<td><a href="editUser.php?edit_id='.$row['username'].'">Edit</a> ';
	  echo '<a href="listUsers.php?del_id='.$row['username'].'"
	  onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a></td></tr>';
  }
  echo '</table>';
  echo '<a href="../index.php">Back to Home</a>';

  ?>
  
  </body>
</html>