
<?php require '../func/dbconnection.php';
//Start or resume a session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!( $_SESSION['level'] == 'moderator'))
{
header('Location: ../index.php');
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>delete discussion</title>
</head>

<body>
<?php
    $discussion = 
    $_GET['discussionid'];
  
  // first we'll check if any of our required fields are empty all at once
  if (empty($discussion))
  {
    $error_message = 'discussion was not selected.';
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

    $query = "DELETE FROM discussion WHERE discussion_id = ".$discussion;



  $result = mysqli_query($connection, $query);

  if ($result)
	{
    echo '<p>Movie details inserted into database!</p>';
    header('Location: movieDetails.php?movie_id='.$_SESSION['movie_id']);


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
