<?php
// connect to database
  require '../func/dbconnection.php';

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
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
<?php require 'navigationbar.php'; ?>
<div class="container">

<h2><strong>Movies Details</strong></h2>



<?php
  //  delete user if del_id GET data exists
  if (isset($_GET['movie_id']))
  {
  $query = "SELECT * FROM movies ".'WHERE movie_id ='.$_GET['movie_id'];
  
  // execute the query
  $results = mysqli_query($connection, $query);

  $_SESSION['movie_id'] = $_GET['movie_id'];


  
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

  echo '</br></br>';

// Ratings
echo '<h2>Rating</h2></br>';

$rating_query = "SELECT AVG(rating) FROM ratings ".'WHERE movie_id ='.$_GET['movie_id'];
  
  // execute the query
$rating_results = mysqli_query($connection, $rating_query);
$row = $rating_results->fetch_assoc();
$avg_rating = round($row['AVG(rating)']);

if($avg_rating != '0')
{
  echo 'Average Rating: '.$avg_rating.'</br>';
}
else
{
  echo '<p>There is no discussion yet. Leave fisrt comment on this movie!</p>';
}

echo '</br>';

if ( $_SESSION['level'] == 'admin'  or $_SESSION['level'] == 'moderator' or $_SESSION['level'] == 'member')
    {
      require 'newrating.php';
    }

// discussions
echo '</br></br>';
echo '<h2>Discussion</h2></br>';


$discussion_query = "SELECT * FROM discussion ".'WHERE movie_id ='.$_GET['movie_id'].' ORDER BY post_date';
  // execute the query
$discussion_results = mysqli_query($connection, $discussion_query);



  if ($discussion_results->num_rows)
{

  //start the table in which our user list will be shown
  echo '<table><tr>';
  echo '<th>Post Date</th><th>User Name</th><th>Content</th>';
  if ($_SESSION['level'] == 'moderator')
      {
        echo '<th>Manage</th>';
      }
  echo '</tr>';
  
  //  loop through the result and display them
  while ($row = $discussion_results->fetch_assoc())
  {
      echo '<td>'.$row['post_date'].'</td>';

      if (!$_SESSION['level'] == '' )
      {
        echo '<td><a href="userDetails.php?username='.$row['username'].'">'.$row['username'].'</a></td>';
      }
      else
      {
        echo '<td>'.$row['username'].'</td>';
      }

      echo '<td>'.$row['content'].'</td>';

      // delete discusstion link for exclusively moderators
      if ($_SESSION['level'] == 'moderator')
      {
        echo '<td><a href="deletediscussion.php?discussionid='.$row['discussion_id'].'"
        onclick="return confirm(\'Are you sure you want to delete this discussion?\'); ">Delete</a></td>';
      }

	  echo '</tr>';
  }
  echo '</table></br>';
}
  else
  {
    echo '<p>There is no discussion yet. Leave fisrt comment on this movie!</p>';
  }
  

  if ( $_SESSION['level'] == 'admin' or $_SESSION['level'] == 'moderator' or $_SESSION['level'] == 'member' )
  {
    require 'newdiscussion.php';
  }


}

  ?>
  </div>
  </body>
</html>