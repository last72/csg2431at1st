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
  <title>User Registration Results</title>
</head>

<body>

<?php require 'navigationbar.php'; ?>

<div class="container">
<?php
	//create short variable names from the data received from the form
	$moviename = $_POST['moviename'];
	$release_year = $_POST['release_year'];
	$director = $_POST['director'];
	$writers = $_POST['writers'];
	$duration = $_POST['duration']; 
  $summary = $_POST['summary'];
  
  // we create this variable and set it to an empty string... if it remains empty by the end
  // of our validation code, then there was no error found
  $error_message = '';

  // first we'll check if any of our required fields are empty all at once
  if (empty($moviename) || empty($release_year) || empty($director) || empty($writers) || empty($duration))
  {
    $error_message = 'One of the required values was  blank.';
  }
    
  // Check the release year is number or not.
  elseif (!is_numeric($release_year))
  {
    $error_message = 'Your release year is not numeric';
  }

  // Check the release year is valid or not.
  elseif (strlen($release_year) != 4)
  {
    $error_message = 'Your release year is not valid';
  }

  // Check the duration is number or not.
  elseif (!is_numeric($duration))
  {
    $error_message = 'Your duration is not numeric';
  }

    // now we'll check if the movie already exists in the database
    $duplicatemovie_query = "SELECT movie_id FROM movies WHERE movie_name = '".$moviename."' AND release_year = '".$release_year."'";
    $duplicatemovie_results = mysqli_query($connection,$duplicatemovie_query);

    if (@$duplicatemovie_results->num_rows > 0)
    {
      $error_message = 'Movie already exist.';
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
  else
  {
    //  if there was no error, show success message
    // (and them the script continues to the HTML section that displays the results)
    echo '<p><strong>Form submitted sucessfully!</strong></p>';

    $query = "INSERT INTO movies VALUE (NULL, '".$moviename."', '".$release_year."',
  '".$director."', '".$writers."', '".$duration."', '".$summary."')";


  $result = mysqli_query($connection, $query);

  if ($result)
	{
		echo '<p>Movie details inserted into database!</p>';
	}
	else
	{
		echo '<p>Error inserting details. Error message:</p>';
		echo '<p>'.mysqli_error($connection).'</p>';
  }
  }
?>


<h2><strong>New Movie Details</strong></h2>
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2"><strong>Movie Details</strong></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>moviename</td>
      <td> 
        <?php echo $moviename; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>release_year</td>
      <td> 
        <?php echo $release_year; ?></td>
    </tr>
    
    <tr style="background-color: #FFFFFF;"> 
      <td>director</td>
      <td> 
        <?php echo $director; ?></td>
    </tr>
    
    <tr style="background-color: #FFFFFF;"> 
      <td>writers</td>
      <td> 
        <?php echo $writers; ?></td>
    </tr>

    <tr style="background-color: #FFFFFF;"> 
      <td>duration</td>
      <td> 
        <?php echo $duration; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>summary</td>
      <td> 
        <?php echo $summary; ?></td>
    </tr>
  </table>
  <p><strong>Click Home at the top to continue.</strong></p>
  </div>
</body>
</html>
