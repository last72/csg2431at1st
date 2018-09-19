
<?php require '../func/dbconnection.php';
//Start or resume a session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!( $_SESSION['level'] == 'admin'))
{
header('Location: ../index.php');
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>access level change Results</title>
</head>

<body>
<?php
	//create short variable names from the data received from the form
	$accesslevel = $_POST['accesslevel'];
  
  // we create this variable and set it to an empty string... if it remains empty by the end
  // of our validation code, then there was no error found
  $error_message = '';

  // first we'll check if any of our required fields are empty all at once
  if (empty($accesslevel))
  {
    $error_message = 'access level was blank.';
  }



    
// now we'll check if the username already exists in the database
$howmanyadmin_query = "SELECT * FROM users WHERE access_level = 'admin'";
$howmanyadmin_results = mysqli_query($connection,$howmanyadmin_query);



if ($howmanyadmin_results->num_rows < 2 && $_POST['accesslevel'] != 'admin' && $_SESSION['uname'] == $_SESSION['userdetail'])
{
    $error_message = 'Less than 2 admin user exist. You need to have at least 1 admin user';
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

    $query = "UPDATE users SET access_level = '".$_POST['accesslevel']."' WHERE username = '".$_SESSION['userdetail']."'";








  $result = mysqli_query($connection, $query);

  if ($result)
	{
    echo '<p>Movie details inserted into database!</p>';

    if($_SESSION['uname'] == $_SESSION['userdetail'] && $_POST['accesslevel'] != 'admin')
    {
        $_SESSION['level'] = $_POST['accesslevel'];
    }

    header('Location: userDetails.php?username='.$_SESSION['userdetail']);

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
