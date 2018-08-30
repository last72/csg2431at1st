<?php include '../func/dbconnection.php';?>
<?php   // connect to database
  @ $db = new mysqli('localhost', 'root', '', 'movietalkat1');
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
  if (isset($_GET['del_id']))
  {
	  
	  $del_query = 'DELETE FROM movies WHERE movie_id = '.$_GET['del_id'];
	  $del_results = $db->query($del_query);
  }
  
  $query = "SELECT * FROM movies ORDER BY movie_name";
  
  // execute the query
  $results = $db->query($query);
  
  // show how many rows the query returned
  echo '<p>'.$results->num_rows.' movies found.</p>';
  
  //start the table in which our user list will be shown
  echo '<table><tr>';
  echo '<th>Movie name</th><th>Release year</th><th>Director</th><th>Writers</th><th>Duration</th><th>Summary</th><th>Manage</th>';
  echo '</tr>';
  
  //  loop through the result and display them
  while ($row = $results->fetch_assoc())
  {
      echo '<td>'.$row['movie_id'].'</td>';
      echo '<td>'.$row['release_year'].'</td>';
      echo '<td>'.$row['director'].'</td>';
      echo '<td>'.$row['writers'].'</td>';
      echo '<td>'.$row['duration'].'</td>';
      echo '<td>'.$row['summary'].'</td>';

	  echo '<td><a href="editMovie.php?edit_id='.$row['movie_id'].'">Edit</a> ';
	  echo '<a href="listMovies.php?del_id='.$row['movie_id'].'"
	  onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a></td></tr>';
  }
  echo '</table>';
  ?>
  
  </body>
</html>