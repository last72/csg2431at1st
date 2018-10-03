<?php
//Start or resume a session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
// db connection
if (!DBHOST)
{
  require '../func/dbconnection.php';
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
	<link rel="stylesheet" type="text/javascript" href="../js/validation.js">
</head>

<body>
<h3><strong>Ban user</strong></h3>
<form name="banuser" method="post" action="userbanresult.php" onsubmit="return ValidatebanuserForm();">

<input name="username" type="hidden" value="<?php echo $_SESSION['userdetail'];  ?>" />
<p>Ban member for: <input type="number" name="banhours" required/> hours.<br/>
Reason for ban: <input type="text" name="banreason" required/>

<input type="submit" name="submit" value="Submit" /></p>

</form>
<br/>
<h3><strong>Unban user</strong></h3>
<p>Click <a href="userbanresult.php?unban=true">here</a> to remove any existing ban for this user.</p>
</body>
</html>


