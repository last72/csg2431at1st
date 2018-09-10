<?php
//Start or resume a session
session_start();

  if ( $_SESSION['level'] == '' )
  {
    header('Location: ../index.php');
    exit;
  }

?>
<?php include '../func/dbconnection.php';?>
<?php   // connect to database
  @ $db = new mysqli('localhost', 'root', 't00r', 'movietalkat1');
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
<h2><strong>List User</strong></h2>

<?php
  //  delete user if del_id GET data exists
  if (isset($_GET['username']))
  {
	  
  $query = "SELECT * FROM users ".'WHERE username = \''.$_GET['username'].'\'';
  
  // execute the query
  $results = $db->query($query);
  
  // show how many rows the query returned
  
  //start the table in which our user list will be shown
  echo '<table><tr>';
  echo '<th>Username</th><th>Name</th><th>Email</th><th>Birth Year</th><th>Country</th><th>Access level</th>';
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

	//   echo '</tr>';
  }
  echo '</tr></table>';

}
  echo '<a href="../index.php">Back to Home</a>';
  echo '<a href="../logout.php">Sign Out</a>';

  ?>
  
  </body>
</html>