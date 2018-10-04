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
?>

<!DOCTYPE html>
<html>
<head>
  <title>Advanced search result</title>
  <style type="text/css">
    th,td {border: 1px solid black; width: 150px;}
  </style>
</head>

<body>

<?php require 'navigationbar.php'; ?>

<div class="container">


<h2><strong>Advanced search result</strong></h2>

<?php
  //  delete user if del_id GET data exists
  if (isset($_GET['del_id']) && ($_SESSION['level'] == 'admin'))
  {
	  
	  $del_query = 'DELETE FROM movies WHERE movie_id = '.$_GET['del_id'];
    $del_results = mysqli_query($connection,$del_query);

    $del_rating_query = 'DELETE FROM ratings WHERE movie_id = '.$_GET['del_id'];
    $del_rating_results = mysqli_query($connection,$del_rating_query);

    $del_discussion_query = 'DELETE FROM discussion WHERE movie_id = '.$_GET['del_id'];
    $del_discussion_results = mysqli_query($connection,$del_discussion_query);

  }
  



//   Validation.

$searchterm = $_POST['searchterm'];
$directorwriters_query = '';
$plotsummary_query = '';
$releaseyearvalue_query = '';
$durationvalue_query = '';


// directorwriters value if checked
if (isset($_POST['directorwriters']))
{
    $directorwriters = $_POST['directorwriters'];
    $directorwriters_query = "OR director LIKE '%".$searchterm."%' OR writers LIKE '%".$searchterm."%' ";
}
// plotsummary value if checked
if (isset($_POST['plotsummary']))
{
    $plotsummary = $_POST['plotsummary'];
    $plotsummary_query = "OR summary LIKE '%".$searchterm."%' ";
}

function strcompair($statement)
{
    if ($statement == 'lessthan')
    {
        return '<';
    }
    else if ($statement == 'exactly')
    {
        return '=';
    }
    else if ($statement == 'morethan')
    {
        return '>';
    }
    else
    {
        exit;
    }
}


    // we create this variable and set it to an empty string... if it remains empty by the end
    // of our validation code, then there was no error found
    $error_message = '';

// release year checkbox
if (isset($_POST['releaseyear']) && $_POST['releaseyear'] != 'notimportant')
{
    $releaseyear = $_POST['releaseyear'];

    // release year value
    if (isset($_POST['releaseyearvalue']) && $_POST['releaseyearvalue'] != '')
    {
        $releaseyearvalue = $_POST['releaseyearvalue'];
        $releaseyearvalue_query = "AND release_year ".strcompair($releaseyear).$releaseyearvalue." ";
    }
    else
    {
        $error_message = 'Release year is empty.';
    }
}


// duration checkbox
if (isset($_POST['duration']) && $_POST['duration'] != 'notimportant')
{
    $duration = $_POST['duration'];
    // duration value

    if (isset($_POST['durationvalue']) && $_POST['durationvalue'] != '')
    {
        $durationvalue = $_POST['durationvalue'];
        $durationvalue_query = "AND duration ".strcompair($duration).$durationvalue." ";
    }
    else
    {
        $error_message = 'Duration is empty.';
    }
}


 // if the error_message variable is not empty (i.e. an error has been found)
  if ($error_message != '')
  {
    // we'll just provide the user with the error message and a back link if there is an error
    // the exit command tells the server/PHP to stop processing the script at that point
    echo 'Error: '.$error_message.' <a href="javascript: history.back();">Go Back</a>.';
    echo '</body></html>';
    exit;
  }



$query = "SELECT * FROM movies 
        WHERE (movie_name LIKE '%".$searchterm."%' ".
        $directorwriters_query.
        $plotsummary_query.") ".
        $releaseyearvalue_query.
        $durationvalue_query."
        ORDER BY movie_name";

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


      if ( $_SESSION['level'] == 'admin' )
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

  ?>
      </div>

  </body>
</html>