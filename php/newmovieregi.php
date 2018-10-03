<?php
// connect to database
require '../func/dbconnection.php';

// Start or resume a session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check the access level
if (!isset($_SESSION['level']))
{
  $_SESSION['level'] = '';
}


  if (!( $_SESSION['level'] == 'admin' ))
{
    header('Location: ../index.php');
    exit;
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Movie Registration Form</title>
  <script src="../js/validation.js"></script>
</head>

<body>
<?php require 'navigationbar.php'; ?>

<div class="container">

<h2><strong>New Movie Details</strong></h2>
<form name="MovieForm" method="post" action="newmovieregiresult.php" onsubmit="return ValidateMovieForm();">
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
  <tr>
      <td colspan="2"><strong>Movie Details</strong></td>
    </tr>
  <tr style="background-color: #FFFFFF;"> 
      <td>Moviename</td>
      <td> 
        <input name="moviename" type="text" style="width: 200px;" maxlength="100" required/>*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Release year</td>
      <td> 
        <!-- <input name="release_year" type="text" style="width: 200px;" maxlength="20" required/>*</td> -->

        <select name="release_year" style="width: 200px;" required>
          <?php
          $avg_query = "SELECT AVG(release_year) FROM movies";
          $result = mysqli_query($connection,$avg_query);
          $row = $result->fetch_assoc();
          $avg_release_year = round($row['AVG(release_year)']);

            for ($i=date("Y"); $i>=date("Y")-1000; $i--)
            {
              echo '<option value="'."$i".'"';
              
              if ($i == "$avg_release_year")
              {
                echo ' selected="selected"';
              }

              echo '>'."$i".'</option>';
            }
          ?>
        </select>*
    </tr>



    <tr style="background-color: #FFFFFF;"> 
      <td>Director</td>
      <td> 
        <input name="director" type="text" style="width: 200px;" maxlength="100" required/>*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Writers</td>
      <td> 
        <input name="writers" type="text" style="width: 200px;" maxlength="100" required/>*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Duration</td>
      <td> 
        <input name="duration" type="text" style="width: 200px;" maxlength="4" required/>*</td>
    </tr>
    <td>Summary</td>
      <td> 
        <input name="summary" type="text" style="width: 200px;" maxlength="100"/></td>
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
</div>
</body>
</html>
