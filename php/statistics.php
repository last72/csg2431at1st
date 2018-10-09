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

// Only admin can enter this page
if (!( $_SESSION['level'] == 'admin'))
{
  header('Location: ../index.php');
  exit;
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Site Statistics</title>
  <style type="text/css">
    th,td {border: 1px solid black; width: 150px;}
  </style>
</head>

<body>

<?php require 'navigationbar.php'; ?>

<div class="container">


<h2><strong>Site Statistics</strong></h2>

<?php

    // query for number of total user
    $numberoftotalusers_query = "SELECT COUNT(username) FROM users";

    // execute the query
    $numberoftotalusersresults = mysqli_query($connection, $numberoftotalusers_query);

    //get single row
    $numberoftotaluser_row = $numberoftotalusersresults->fetch_assoc();


    // query for number of each accesslevle user
    $numberofusers_query = "SELECT COUNT(username), access_level FROM users GROUP BY access_level";

    // execute the query
    $numberofusersresults = mysqli_query($connection, $numberofusers_query);

  
  echo '<table style="width:80%">';

  // First row, shows total number of user and each access level.
  echo '<tr>';
  echo '<td>Users:</td>';
  echo '<td>';

  echo 'Total: '.$numberoftotaluser_row['COUNT(username)'].'<br/>(';

  while ($numberofusers_row = $numberofusersresults->fetch_assoc())
  {
      echo $numberofusers_row['COUNT(username)'].' '.$numberofusers_row['access_level'].' ';
  }

  echo ')</td>';
  echo '</tr>';

  // Second row, shows average of user.

    // query for average user age
    $averageuserage_query = "SELECT AVG(birth_year) FROM users";

    // execute the query
    $averageuserageresults = mysqli_query($connection, $averageuserage_query);

    //get single row
    $averageuserage_row = $averageuserageresults->fetch_assoc();
  
    // calculate and round up
    $averageuserage_inage = round(date("Y")-$averageuserage_row['AVG(birth_year)'],1);



  echo '<tr>';
  echo '<td>Average User Age:<br/>(based on birth year)</td>';
  echo '<td>';

  echo $averageuserage_inage;

  echo '</td>';
  echo '</tr>';

  // Third row, shows number of movies.

    // query for average user age
    $numberofmovies_query = "SELECT COUNT(movie_id) FROM movies";

    // execute the query
    $numberofmoviesresults = mysqli_query($connection, $numberofmovies_query);

    //get single row
    $numberofmovies_row = $numberofmoviesresults->fetch_assoc();
  
  echo '<tr>';
  echo '<td>Number of movies:</td>';
  echo '<td>';

  echo $numberofmovies_row['COUNT(movie_id)'];

  echo '</td>';
  echo '</tr>';


   // Fourth row, shows Most discussed movie.

    // query for Most discussed movie
    $mostdiscussedmovie_query = "SELECT movie_name, count(discussion_id) AS discussions 
    FROM discussion INNER JOIN movies ON movies.movie_id = discussion.movie_id GROUP BY movie_name  
    ORDER BY `discussions`  DESC";

    // execute the query
    $mostdiscussedmovieresults = mysqli_query($connection, $mostdiscussedmovie_query);

    //get single row
    $mostdiscussedmovie_row = $mostdiscussedmovieresults->fetch_assoc();

    
  
  echo '<tr>';
  echo '<td>Most discussed movie:</td>';
  echo '<td>';

  echo $mostdiscussedmovie_row['movie_name'];
  echo '<br/>('.$mostdiscussedmovie_row['discussions'].' discussed posts)';

  echo '</td>';
  echo '</tr>';

    // Fifth row, shows highest rated movie.

    // query for Highest rated movie
    $mostratedmovie_query = "SELECT AVG(rating) AS ratings, movie_name 
    FROM ratings INNER JOIN movies ON ratings.movie_id = movies.movie_id GROUP BY movie_name 
    ORDER BY ratings DESC";

    // execute the query
    $mostratedmovieresults = mysqli_query($connection, $mostratedmovie_query);

    //get single row
    $mostratedmovie_row = $mostratedmovieresults->fetch_assoc();

    
  
  echo '<tr>';
  echo '<td>Most discussed movie:</td>';
  echo '<td>';

  echo $mostratedmovie_row['movie_name'];
  echo '<br/>('.round($mostratedmovie_row['ratings'], 1).' average rating)';

  echo '</td>';
  echo '</tr>';




  echo '</table>';


  
  ?>
      </div>

  </body>
</html>