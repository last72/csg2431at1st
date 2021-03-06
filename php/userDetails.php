<?php
//Start or resume a session
session_start();


// Check the access level
if (!isset($_SESSION['level']))
{
  $_SESSION['level'] = '';
}

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
<?php require 'navigationbar.php'; ?>

<div class="container">
<h2><strong>User Details</strong></h2>

<?php
  if (isset($_GET['username']))
  {
	  
  $query = "SELECT * FROM users ".'WHERE username = \''.$_GET['username'].'\'';
  
  // execute the query
  $results = mysqli_query($connection, $query);
  
  // show how many rows the query returned
  
  //start the table in which our user list will be shown
  echo '<table><tr>';
  echo '<th>Username</th>
  <th>Real Name</th>
  <th>Email</th>
  <th>Birth Year</th>
  <th>Country</th>
  <th>Access level</th>
  <th>Banned Until</th>
  <th>Ban Reason</th>';
  echo '</tr>';
  
  //  loop through the result and display them
  while ($row = $results->fetch_assoc())
  {
      echo '<td>'.$row['username'].'</td>';

      if ($row['real_name'] == '')
      {
        echo '<td>Not disclosed</td>';
      }
      else
      {
        echo '<td>'.$row['real_name'].'</td>';
      }

      echo '<td>'.$row['email'].'</td>';
      echo '<td>'.$row['birth_year'].'</td>';

      if ($row['country'] == '')
      {
        echo '<td>Not disclosed</td>';
      }
      else
      {
        echo '<td>'.$row['country'].'</td>';
      }
      $userdetailaccesslevel = $row['access_level'];

      echo '<td>'.$row['access_level'].'</td>';

      if ($row['banned_until'] == '0000-00-00 00:00:00')
      {
        echo '<td>Not currently banned</td>';
      }
      else
      {
        echo '<td>'.$row['banned_until'].'</td>';
      }

      if ($row['ban_reason'] == '')
      {
        echo '<td>Not currently banned</td>';
      }
      else
      {
        echo '<td>'.$row['ban_reason'].'</td>';
      }


  }
  echo '</tr></table>';


}

  ?>

  <?php
    if ( $_SESSION['level'] == 'admin' )
    {

      $_SESSION['userdetail'] = $_GET['username'];

      echo '</br>';
      require 'accesslevelchange.php';
    
    
    }

    if (($_SESSION['level'] == 'moderator') && ($userdetailaccesslevel == 'member'))
    {

      $_SESSION['userdetail'] = $_GET['username'];

      echo '</br>';
      require 'userban.php';
    
    
    }

    echo $row['access_level'];

  ?>
  </div>
  </body>
</html>