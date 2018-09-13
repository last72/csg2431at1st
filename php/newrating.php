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

  if (!( $_SESSION['level'] == 'admin' or $_SESSION['level'] == 'editor' or $_SESSION['level'] == 'member' ))
    {
    header('Location: ../index.php');
    exit;
    }

    ?>

<!DOCTYPE html>
<html>
<head>
  <title>movie rating</title>
	<link rel="stylesheet" type="text/css" href="css/validation.css">
</head>

<body>
<h2><strong>movie rating</strong></h2>
<form name="ratingForm" method="post" action="newratingresult.php" onsubmit="return ValidateMovieForm();">
 <input name="movie_id" type="hidden" value="<?php echo $_SESSION['movie_id'];  ?>" />
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
  <tr>
      <td colspan="2"><strong>movie rating</strong></td>
    </tr>
  <tr style="background-color: #FFFFFF;"> 
      <td>rating</td>
      <td>         
        <select name="rating" style="width: 200px;" required>
          <?php
            for ($i=10; $i>=0; $i--)
            {
              echo '<option value="'."$i".'"';
              echo '>'."$i".'</option>';
            }
          ?>
        </select>
        
        
        </td>
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
<?php   echo '<a href="../logout.php">Sign Out</a>';?>
</body>
</html>
