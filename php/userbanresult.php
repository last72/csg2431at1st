
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
</head>

<body>
<?php


if(isset($_GET['unban']))
{
    $query = "UPDATE users SET banned_until = '', 
    ban_reason = '' WHERE username = '".$_SESSION['userdetail']."'";


     $result = mysqli_query($connection, $query);
     header('Location: userDetails.php?username='.$_SESSION['userdetail']);

}
else
{
	//create short variable names from the data received from the form
	$banhours = $_POST['banhours'];
	$banreason = $_POST['banreason'];
  
  // of our validation code, then there was no error found
  $error_message = '';

  // first we'll check if any of our required fields are empty all at once
  if (empty($banhours))
  {
    $error_message = 'banhours was blank.';
  }
  if (!is_numeric($banhours))
  {
    $error_message = 'banhours is not number';
  }

  if($banhours > 876000)
  {
      $error_message = 'Max ban time is 100 years.';
  }

  if (empty($banreason))
  {
    $error_message = 'banreason was blank.';
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

    $query = "UPDATE users SET banned_until = DATE_ADD(NOW(), INTERVAL ".$banhours." HOUR), 
    ban_reason = '".$banreason."' WHERE username = '".$_SESSION['userdetail']."'";


  $result = mysqli_query($connection, $query);

  if ($result)
	{
    echo '<p>Movie details inserted into database!</p>';

    header('Location: userDetails.php?username='.$_SESSION['userdetail']);

	}
	else
	{
		echo '<p>Error inserting details. Error message:</p>';
    echo mysqli_error($connection); 

  }
  }
}
?>


</body>
</html>
