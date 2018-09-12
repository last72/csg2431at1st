<?php   // connect to database
  require '../func/dbconnection.php';


//Start or resume a session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
  ?>

  
<!DOCTYPE html>
<html>
<head>
  <title>List Movies</title>
  <style type="text/css">
    th,td {border: 1px solid black; width: 150px;}
  </style>
</head>

<body>
<h2><strong>List Movies</strong></h2>



<?php
  //  delete user if del_id GET data exists
  if (isset($_GET['del_id']) && ($_SESSION['level'] == 'admin'))
  {
	  
	  $del_query = 'DELETE FROM movies WHERE movie_id = '.$_GET['del_id'];
    $del_results = mysqli_query($connection,$del_query);

  }
  
  $query = "SELECT * FROM movies ORDER BY movie_name";
  
  // execute the query
  $results = mysqli_query($connection, $query);
  
  // show how many rows the query returned
  echo '<p>'.$results->num_rows.' movies found.</p>';
  
  //start the table in which our user list will be shown
  echo '<table><tr>';
  echo '<th>Movie name</th><th>Release year</th><th>Manage</th>';
  echo '</tr>';
  
  //  loop through the result and display them
  while ($row = $results->fetch_assoc())
  {
      echo '<td>'.$row['movie_name'].'</td>';
      echo '<td>'.$row['release_year'].'</td>';

      echo '<td><a href="movieDetails.php?movie_id='.$row['movie_id'].'">Details</a> ';


      if ( $_SESSION['level'] == 'admin' or $_SESSION['level'] == 'editor' )
      {
        echo '<a href="editMovie.php?edit_id='.$row['movie_id'].'">Edit</a> ';
      }

      if ( $_SESSION['level'] == 'admin')
      {
        echo '<a href="listMovies.php?del_id='.$row['movie_id'].'"
        onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a>';
      }

      echo '</td></tr>';
      


      
  }
  echo '</table>';

  echo '<a href="../index.php">Back to Home</a>';
  ?>
  
  </body>
</html>