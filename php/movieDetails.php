<?php //include '../func/dbconnection.php';?>
<?php   // connect to database
  // @ $db = new mysqli('localhost', 'root', 't00r', 'movietalkat1');
  require '../func/dbconnection.php';
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>Movies Details</title>
  <style type="text/css">
    th,td {border: 1px solid black; width: 150px;}
  </style>
</head>

<body>
<h2><strong>Movies Details</strong></h2>



<?php
  //  delete user if del_id GET data exists
  if (isset($_GET['movie_id']))
  {
  $query = "SELECT * FROM movies ".'WHERE movie_id ='.$_GET['movie_id'];
  
  // execute the query
  $results = mysqli_query($connection, $query);

  
  //start the table in which our user list will be shown
  echo '<table><tr>';
  echo '<th>Movie name</th><th>Release year</th><th>Director</th><th>Writers</th><th>Duration</th><th>Summary</th>';
  echo '</tr>';
  
  //  loop through the result and display them
  while ($row = $results->fetch_assoc())
  {
      echo '<td>'.$row['movie_name'].'</td>';
      echo '<td>'.$row['release_year'].'</td>';
      echo '<td>'.$row['director'].'</td>';
      echo '<td>'.$row['writers'].'</td>';
      echo '<td>'.$row['duration'].'</td>';
      echo '<td>'.$row['summary'].'</td>';

	  echo '</tr>';
  }
  echo '</table>';
}

  echo '<a href="../index.php">Back to Home</a>';
  ?>
  
  </body>
</html>