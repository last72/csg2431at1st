<?php
    require './func/dbconnection.php';
    //Start or resume login session
    session_start();
    
    //If the "uname" session variable is not set or is empty, redirect to login page
    if ( !isset($_SESSION['uname']) || $_SESSION['uname'] == '' )
  {
    header('Location: login.php');
    exit;
  }
    
    $inactive = 900; // Set timeout period in seconds

    if (isset($_SESSION['last_login_timestamp'])) {
        $session_life = time() - $_SESSION['last_login_timestamp'];
        if ($session_life > $inactive) {
            session_destroy();
            header("Location: logout.php");
            echo "session timeout.";
        }
}
$_SESSION['last_login_timestamp'] = time();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
    .FormLayout{
    	margin: 20px;
    }
</style>
</head>
<body>
	<h1>Index page</h1>
	<a href="logout.php">Logout</a></li>
</body>
</html>