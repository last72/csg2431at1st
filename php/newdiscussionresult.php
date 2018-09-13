
<?php require '../func/dbconnection.php';
//Start or resume a session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!( $_SESSION['level'] == 'admin' or $_SESSION['level'] == 'editor' or $_SESSION['level'] == 'member' ))
{
header('Location: ../index.php');
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>movie comment Results</title>
</head>

<body>
<?php
	//create short variable names from the data received from the form
	$content = $_POST['content'];
  
  // we create this variable and set it to an empty string... if it remains empty by the end
  // of our validation code, then there was no error found
  $error_message = '';

  // first we'll check if any of our required fields are empty all at once
  if (empty($content))
  {
    $error_message = 'content was blank.';
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

    $query = "INSERT INTO discussion SET movie_id = '".$_POST['movie_id']."', username = '".$_SESSION['uname']."', content = '".$_POST['content']."', post_date = '".date("Y-m-d")."'";




  $result = mysqli_query($connection, $query);

  if ($result)
	{
    echo '<p>Movie details inserted into database!</p>';
    header('Location: movieDetails.php?movie_id='.$_POST['movie_id']);


	}
	else
	{
		echo '<p>Error inserting details. Error message:</p>';
    echo mysqli_error($connection);

  }
  }
?>


</body>
</html>
