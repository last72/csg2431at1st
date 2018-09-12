<?php require '../func/dbconnection.php';
if (!( $_SESSION['level'] == 'admin' or $_SESSION['level'] == 'editor' or $_SESSION['level'] == 'member' ))
{
header('Location: ../index.php');
exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>movie rating Results</title>
</head>

<body>
<?php
	//create short variable names from the data received from the form
	$rating = $_POST['rating'];
  
  // we create this variable and set it to an empty string... if it remains empty by the end
  // of our validation code, then there was no error found
  $error_message = '';

  // first we'll check if any of our required fields are empty all at once
  if (empty($rating))
  {
    $error_message = 'rating was blank.';
  }
    
  // Check the rating is number or not.
  elseif (!is_numeric($rating))
  {
    $error_message = 'Your rating is not numeric';
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
		echo '<p>'.$db->error.'</p>';
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
  <a href="../">Go Home</a>
</body>
</html>