<?php //include '../func/dbconnection.php';?>
<?php 
  //@ $db = new mysqli('localhost', 'root', 't00r', 'movietalkat1');
  require '../func/dbconnection.php';
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>User Registration Results</title>
</head>

<body>
<?php
  //create short variable names from the data received from the form
  $username = $_POST['username'];
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$birth_year = $_POST['birth_year'];
	$emailAddress = $_POST['emailAddress'];
  $country = $_POST['country'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  
  // we create this variable and set it to an empty string... if it remains empty by the end
  // of our validation code, then there was no error found
  $error_message = '';

  // first we'll check if any of our required fields are empty all at once
  if (empty($username) || empty($birth_year) || empty($emailAddress) || empty($password) || empty($confirmPassword))
  {
    $error_message = 'One of the required values was  blank.';
  }

  // now we'll check if the password is long enough
  elseif (strlen($password) < 5)
  {
    $error_message = 'Your password is not long enough.';
  }

  // now we'll check if the password fields do not match
  elseif ($password != $confirmPassword)
  {
    $error_message = 'Your password is not long enough.';
  }
  
  // to check valid email address
  elseif (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL))
  {
	  $error_message = 'The email address is not valid';
  }
  elseif (!is_numeric($birth_year))
  {
    $error_message = 'Your home birth year is not numeric';
  }

  // now we'll check if the username is too long
  elseif (strlen($username) > 100)
  {
    $error_message = 'Your username is too long.';
  }

  // now we'll check if the name is too long
  elseif (strlen($firstname) + strlen($surname) > 50)
  {
    $error_message = 'Your name is too long.';
  }

  // now we'll check if the birth year is valid
  elseif (strlen($birth_year) != '4')
  {
    $error_message = 'Your birth year is not valid.';
  }

 // now we'll check if the emailAddress is too long
  elseif (strlen($emailAddress) > 100)
  {
    $error_message = 'Your emailAddress is too long.';
  }

  // now we'll check if the country name is too long
  elseif (strlen($emailAddress) > 50)
  {
    $error_message = 'Your country name is too long.';
  }

  // now we'll check if the password is too long
  elseif (strlen($password) > 50)
  {
    $error_message = 'Your password is too long.';
  }

  // now we'll check if the username already exists in the database
  $username_query = "SELECT username FROM users WHERE username = '".$username."'";
  //$username_results = $db->query($username_query);
  $username_results = mysqli_query($connection,$username_query);

  if ($username_results->num_rows > 0)
  {
    $error_message = 'Your Username already exises, choose another.';
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

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO users VALUE ('".$username."', '".$firstname."' + '".$surname."',
  '".$emailAddress."', '".$birth_year."', '".$country."', '".$hashed_password."', 'member')";

  //$result = $db->query($query);
  $result = mysqli_query($connection,$query);

  if ($result)
	{
		echo '<p>User details inserted into database!</p>';
	}
	else
	{
		echo '<p>Error inserting details. Error message:</p>';
		echo '<p>'.$db->error.'</p>';
  }
  
  }
?>


<h2><strong>New User Details</strong></h2>
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2"><strong>Personal Details</strong></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>First Name</td>
      <td> 
        <?php echo $firstname; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Surname</td>
      <td> 
        <?php echo $surname; ?></td>
    </tr>
    
    <tr style="background-color: #FFFFFF;"> 
      <td>birth year</td>
      <td> 
        <?php echo $birth_year; ?></td>
    </tr>
    
    <tr style="background-color: #FFFFFF;"> 
      <td>Email Address</td>
      <td> 
        <?php echo $emailAddress; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>country</td>
      <td> 
        <?php echo $country; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>username</td>
      <td> 
        <?php echo $username; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Password</td>
      <td> 
        <?php echo $password; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Confirm Password</td>
      <td> 
        <?php echo $confirmPassword; ?></td>
    </tr>
  </table>
  <a href="../">Go Home</a>
</body>
</html>
