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

  
  echo '<table>';

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
  echo '<td>Average User Age:</td>';
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
    $mostdiscussedmovie_query = "SELECT COUNT(discussion_id), movie_id FROM discussion GROUP BY movie_id";

    // execute the query
    $mostdiscussedmovieresults = mysqli_query($connection, $mostdiscussedmovie_query);

    //get single row
    $mostdiscussedmovie_row = $mostdiscussedmovieresults->fetch_assoc();

    // query for Most discussed movie name
    $mostdiscussedmoviename_query = "SELECT movie_name FROM movies WHERE movie_id = '".$mostdiscussedmovie_row['movie_id']."'";

    // execute the query
    $mostdiscussedmovienameresults = mysqli_query($connection, $mostdiscussedmoviename_query);

    //get single row
    $mostdiscussedmoviename_row = $mostdiscussedmovienameresults->fetch_assoc();

    
  
  echo '<tr>';
  echo '<td>Most discussed movie:</td>';
  echo '<td>';

  echo $mostdiscussedmoviename_row['movie_name'];
  echo '<br/>('.$mostdiscussedmovie_row['COUNT(discussion_id)'].' discussed posts)';

  echo '</td>';
  echo '</tr>';

    // Fifth row, shows highest rated movie.

    // query for Highest rated movie
    $mostratedmovie_query = "SELECT AVG(rating), movie_id FROM ratings GROUP BY movie_id ORDER BY AVG(rating) DESC";

    // execute the query
    $mostratedmovieresults = mysqli_query($connection, $mostratedmovie_query);

    //get single row
    $mostratedmovie_row = $mostratedmovieresults->fetch_assoc();

    // query for highest rated movie name
    $mostratedmoviename_query = "SELECT movie_name FROM movies WHERE movie_id = '".$mostratedmovie_row['movie_id']."'";

    // execute the query
    $mostratedmovienameresults = mysqli_query($connection, $mostratedmoviename_query);

    //get single row
    $mostratedmoviename_row = $mostratedmovienameresults->fetch_assoc();

    
  
  echo '<tr>';
  echo '<td>Most discussed movie:</td>';
  echo '<td>';

  echo $mostratedmoviename_row['movie_name'];
  echo '<br/>('.round($mostratedmovie_row['AVG(rating)'], 1).' average rating)';

  echo '</td>';
  echo '</tr>';




  echo '</table>';


  
  ?>
      </div>

  </body>
</html>