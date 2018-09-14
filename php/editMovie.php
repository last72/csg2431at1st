<?php 
  //Start or resume a session
  session_start();
  // connect to database

require '../func/dbconnection.php';

if (!( $_SESSION['level'] == 'admin' or $_SESSION['level'] == 'editor' ))
{
  header('Location: ../index.php');
  exit;
}

  
  // process submitted form
  if (isset($_POST['moviename']))
 
 
 {
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
  if (empty($moviename) || empty($release_year) || empty($director) || empty($writers) || empty($duration) || empty($summary))
 {
    $error_message = 'One of the required values was  blank.';
  }

   // Check the release year is number or not.
   elseif (!is_numeric($release_year))
   {
     $error_message = 'Your release year is not numeric';
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
	
	
	$query = "UPDATE movies SET summary = '".$summary."', movie_name = '".$moviename."' , release_year = '".$release_year."', director =
	'".$director."', writers = '".$writers."', duration = '".$duration."'
	WHERE movie_id = ".$_GET['edit_id'] ;
	
  $result = mysqli_query($connection, $query);
	
	
	
	if ($result)
	{
		echo '<p>Movie details updated!</p>';
	}
	else
	{
		echo '<p>Error updating details. Error message:</p>';
		echo '<p>'.mysqli_error($connection).'</p>';
	}
	
  }
	  
	  
  }
  
	  //  edit user if edit_id GET data exists
  if (isset($_GET['edit_id']))
  {
      //  fetch the user's details and store them in $row
      
      echo "editing in progress ";
      $edit_query = 'SELECT * FROM movies WHERE movie_id = \''.$_GET['edit_id'].'\'';
      $result = mysqli_query($connection, $edit_query);
      $row = $result->fetch_assoc();

  }
  else
  {
	  //  if there is no user id available, redirect back to the list users page
	  header('Location: listMovies.php');
	  exit;
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Movie Form</title>
</head>

<body>
<h2><strong>User Details</strong></h2>
<form name="editUserForm" method="post" action="editMovie.php?edit_id=<?php echo $_GET['edit_id']?>">
  
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
  <tr>
      <td colspan="2"><strong>Movie Details</strong></td>
    </tr>
  <tr style="background-color: #FFFFFF;"> 
      <td>Moviename</td>
      <td> 
        <input name="moviename" type="text" style="width: 200px;" maxlength="100" value="<?php echo $row ['movie_name']; ?>" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Release year</td>
      <td> 
        <input name="release_year" type="text" style="width: 200px;" maxlength="20" value="<?php echo $row ['release_year']; ?>" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Director</td>
      <td> 
        <input name="director" type="text" style="width: 200px;" maxlength="100" value="<?php echo $row ['director']; ?>" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Writers</td>
      <td> 
        <input name="writers" type="text" style="width: 200px;" maxlength="100" value="<?php echo $row ['writers']; ?>" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Duration</td>
      <td> 
        <input name="duration" type="text" style="width: 200px;" maxlength="4" value="<?php echo $row ['duration']; ?>" />*</td>
    </tr>
    <td>Summary</td>
      <td> 
        <input name="summary" type="text" style="width: 200px;" maxlength="100" value="<?php echo $row ['summary']; ?>" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td> 
        <input type="reset" name="reset" value="Reset" />
		<input type="submit" name="submit" value="Submit" /></td>
      <td> 
        <div align="right">* indicates required field</div></td>
    </tr>
  </table>
  <a href="javascript: history.back();">Go Back</a>
  <?php echo '<a href="../logout.php">Sign Out</a>'; ?>

</form>
</body>
</html>