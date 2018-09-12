<?php 
//Start or resume a session
session_start();
include '../func/dbconnection.php';?>
<?php
  // connect to database
  @ $db = new mysqli('localhost', 'root', 't00r', 'movietalkat1');
  
  if ( $_SESSION['level'] != 'admin' )
{
  header('Location: ../index.php');
  exit;
}

  // process submitted form
  if (isset($_POST['username']))
 
 {
    //create short variable names from the data received from the form
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $confirmPassword = $_POST['confirmPassword'];
    $realname = $_POST['realname'];
    $birth_year = $_POST['birth_year'];
    $country = $_POST['country'];
    $emailAddress = $_POST['emailAddress'];
  
  // we create this variable and set it to an empty string... if it remains empty by the end
  // of our validation code, then there was no error found
  $error_message = '';

  // first we'll check if any of our required fields are empty all at once
  if (empty($username) || empty($birth_year) || empty($country) ||
  empty($password) || empty($confirmPassword))
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

  // check the username is same
  if ($username != $_GET['edit_id'])
  {
    $error_message = 'Your cannot change username';
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
	
	
	$query = "UPDATE users VALUE ('".$username."', '".$firstname."' + '".$surname."',
  '".$emailAddress."', '".$birth_year."', '".$country."', '".$hashed_password."', 'member')
	WHERE username = ".$_GET['edit_id'];
	
	$result = $db->query($query);
	
	
	
	if ($result)
	{
		echo '<p>User details updated!</p>';
	}
	else
	{
		echo '<p>Error updating details. Error message:</p>';
		echo '<p>'.$db->error.'</p>';
	}
	
  }
	  
	  
  }
  
	  //  edit user if edit_id GET data exists
  if (isset($_GET['edit_id']))
  {
      //  fetch the user's details and store them in $row
      
      echo "editing in progress ";
      $edit_query = 'SELECT * FROM users WHERE username = \''.$_GET['edit_id'].'\'';
      $result = $db->query($edit_query);
      
      $row = $result->fetch_assoc();
  }
  else
  {
	  //  if there is no user id available, redirect back to the list users page
	  header('Location: listUsers.php');
	  exit;
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit User Form</title>
</head>

<body>
<h2><strong>User Details</strong></h2>
<form name="UserForm" method="post" action="editUser.php?edit_id=<?php echo $_GET['edit_id']?>" onsubmit="return ValidateUserForm();">
  
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
  <tr>
      <td colspan="2"><strong>Login Details</strong></td>
    </tr>
  <tr style="background-color: #FFFFFF;"> 
      <td>Username</td>
      <td> 
        <input name="username" type="text" style="width: 200px;" maxlength="100" value="<?php echo
		$row ['username']; ?>" disabled/>*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Password</td>
      <td> 
        <input name="password" type="password" style="width: 200px;" maxlength="20"  />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Confirm Password</td>
      <td> 
        <input name="confirmPassword" type="password" style="width: 200px;" maxlength="20"  />*</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Personal Details</strong></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Real Name</td>
      <td> 
        <input name="realname" type="text" style="width: 200px;" maxlength="50" /></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Birth year</td>
      <td> 
        <input name="birth_year" type="text" style="width: 200px;" maxlength="4" value="<?php echo
		$row ['birth_year']; ?>" />*</td>
    </tr>
    <td>Country</td>
      <td> 
        <input name="country" type="text" style="width: 200px;" maxlength="100" value="<?php echo
		$row ['country']; ?>" />*</td>
    </tr>


    <tr style="background-color: #FFFFFF;"> 
      <td>Email Address</td>
      <td> 
        <input name="emailAddress" type="text" style="width: 200px;" maxlength="200" value="<?php echo
		$row ['email']; ?>" />*</td>
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
</form>
<?php   echo '<a href="../logout.php">Sign Out</a>'; ?>
</body>
</html>