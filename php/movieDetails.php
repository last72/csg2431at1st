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

// Ratings
echo '<h2>Rating</h2></br>';

$rating_query = "SELECT AVG(rating) FROM ratings ".'WHERE movie_id ='.$_GET['movie_id'];
  
  // execute the query
$rating_results = mysqli_query($connection, $rating_query);
$row = $rating_results->fetch_assoc();
$avg_birth_year = round($row['AVG(rating)']);


echo 'Average Rating: '.$avg_birth_year.'</br>';
echo '<a href="newrating.php">leave rating</a></br>';


echo '<h2>Discussion</h2></br>';


$discussion_query = "SELECT * FROM discussion ".'WHERE movie_id ='.$_GET['movie_id'].' ORDER BY post_date';
  
  // execute the query
  $discussion_results = mysqli_query($connection, $discussion_query);

  
  //start the table in which our user list will be shown
  echo '<table><tr>';
  echo '<th>post date</th><th>user name</th><th>content</th>';
  echo '</tr>';
  
  //  loop through the result and display them
  while ($row = $discussion_results->fetch_assoc())
  {
      echo '<td>'.$row['post_date'].'</td>';
      echo '<td>'.$row['username'].'</td>';
      echo '<td>'.$row['content'].'</td>';

	  echo '</tr>';
  }
  echo '</table>';




}

  echo '<a href="../index.php">Back to Home</a>';
  ?>
  
  </body>
</html>