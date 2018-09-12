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
<?php
   //php code goes here
    require './func/dbconnection.php';
    //Start or resume a session
    session_start();

    //If the "uname" session variable is set and not empty, redirect to menu page
    if ( isset($_SESSION['uname']) && $_SESSION['uname'] != '' )
    {
        header('Location: index.php');
        exit;
    }

    //If form has been submitted, check login credentials
    if ( isset($_POST['tusername']) )
    {

        //Get the user's details from the database based on the username submitted in the login form
        $query = "SELECT * FROM users WHERE username='".$_POST['tusername']."'";
        //$results = $db->query($query);
        $results = mysqli_query($connection,$query);
        
        //If a matching user was found...
        if ($results->num_rows == 1)
        {
            $user = $results->fetch_assoc();
            
            
            $passwordresult = password_verify($_POST['tpassword'], $user['password']);
            echo $passwordresult;

            //if (password_verify($_POST['tpassword'], $user['password']))
            if ($_POST['tpassword'] = $user['password'])
            {
                //Set session variables then redirect to menu page
                $_SESSION['uname'] = $user['username'];
                $_SESSION['level'] = $user['access_level'];
                $_SESSION['last_login_timestamp'] = time();
                header('Location: index.php');
                exit;
                
            }
            else //If password is not valid, show error message
            {
                //echo '<div style="color: red;">Invalid password.  Try again.</div>';
                $messageno = 'Invalid Username or Password!.<br />';
            }
        }
        else //If no matching user was found, show error message
        {
            //echo '<div style="color: red;">Invalid username.  Try again.</div>';
            $messageno = 'Invalid Username or Password!.<br />';
        }

    }
?>
<div class="container">
    <div class="FormLayout"><!--
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                for go here
            </div> -->
        </div>
        <div class="row">
            <div class="col-sm-4">
                <form action="login.php" method="post">
                <fieldset><legend class="text-center">Sign In</legend>
                <div class="form-group row">
                    <label for="LabelUserName" class="col-2 col-form-label">Username:</label>
                    <div class="col-10">
                        <input type="text" class="form-control" id="inputUsername" name="tusername" placeholder="Username" required>
                    </div>
                    <label for="LabelPassword" class="col-2 col-form-label">Password:</label>
                    <div class="col-10">
                         <input type="password" class="form-control" id="inputPassword" name="tpassword" placeholder="Password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary">Login</button> &nbsp;&nbsp;
                    <?php if(isset($messageno)){echo $messageno;}?>
                </div>
                </fieldset>
                </form>
            </div>
            
        </div> 



    </div>
</div>
</body>
</html>