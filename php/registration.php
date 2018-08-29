<!DOCTYPE html>
<html>
<head>
  <title>User Registration Form</title>
</head>

<body>
<h2><strong>New User Details</strong></h2>
<form name="newUserForm" method="post" action="registrationresult.php">
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
  <tr>
      <td colspan="2"><strong>Login Details</strong></td>
    </tr>
  <tr style="background-color: #FFFFFF;"> 
      <td>Username</td>
      <td> 
        <input name="username" type="text" style="width: 200px;" maxlength="100" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Password</td>
      <td> 
        <input name="password" type="password" style="width: 200px;" maxlength="20" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Confirm Password</td>
      <td> 
        <input name="confirmPassword" type="password" style="width: 200px;" maxlength="20" />*</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Personal Details</strong></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>First Name</td>
      <td> 
        <input name="firstname" type="text" style="width: 200px;" maxlength="100" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Surname</td>
      <td> 
        <input name="surname" type="text" style="width: 200px;" maxlength="100" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Birth year</td>
      <td> 
        <input name="birth_year" type="text" style="width: 200px;" maxlength="4" />*</td>
    </tr>
    <td>Country</td>
      <td> 
        <input name="country" type="text" style="width: 200px;" maxlength="100" />*</td>
    </tr>


    <tr style="background-color: #FFFFFF;"> 
      <td>Email Address</td>
      <td> 
        <input name="emailAddress" type="text" style="width: 200px;" maxlength="200" />*</td>
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
</body>
</html>
