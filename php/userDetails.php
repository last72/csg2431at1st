<?php
//Start or resume a session
session_start();


  if ( $_SESSION['level'] == '' )
  {
    header('Location: ../index.php');
    exit;
  }

// connect to database
require '../func/dbconnection.php';

  ?>
<!DOCTYPE html>
<html>
<head>
  <title>User Details</title>
  <style type="text/css">
    th,td {border: 1px solid black; width: 150px;}
  </style>
</head>
<body>
<h2><strong>User Details</strong></h2>

<?php
  //  delete user if del_id GET data exists
  if (isset($_GET['username']))
  {
	  
  $query = "SELECT * FROM users ".'WHERE username = \''.$_GET['username'].'\'';
  
  // execute the query
  $results = mysqli_query($connection, $query);
  
  // show how many rows the query returned
  
  //start the table in which our user list will be shown
  echo '<table><tr>';
  echo '<th>Username</th><th>Real Name</th><th>Email</th><th>Birth Year</th><th>Country</th><th>Access level</th>';
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
  }
  echo '</tr></table>';

}
  echo '<a href="../index.php">Back to Home</a>';
  echo '<a href="../logout.php">Sign Out</a>';

  ?>
  
  </body>
</html>