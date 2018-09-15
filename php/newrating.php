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
  <title>Leave rating</title>
	<link rel="stylesheet" type="text/css" href="css/validation.css">
</head>

<body>
<h3><strong>Movie Rating</strong></h3>
<form name="ratingForm" method="post" action="newratingresult.php" onsubmit="return ValidateMovieForm();">
 <input name="movie_id" type="hidden" value="<?php echo $_SESSION['movie_id'];  ?>" />
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
  <tr>
      <td colspan="2"><strong>Movie Rating</strong></td>
    </tr>
  <tr style="background-color: #FFFFFF;"> 
      <td>Rating</td>
      <td>         
        <select name="rating" style="width: 200px;" required>
          <?php
            for ($i=10; $i>=1; $i--)
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
  <?php
  // check status of rating update.
  if (isset($_SESSION['updated_rating']) && ($_SESSION['updated_rating'] != ''))
  {
    // echo '<p>The rating is updated to '.$_SESSION['updated_rating'].'</p>';
    echo "<script type='text/javascript'>alert('Now the rating is updated to ".$_SESSION['updated_rating']."');</script>";
    $_SESSION['updated_rating'] = '';
  }
  ?>
</form>
</body>
</html>
