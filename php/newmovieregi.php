<?php
//Start or resume a session
session_start();

  if (!( $_SESSION['level'] == 'admin' or $_SESSION['level'] == 'editor' ))
{
    header('Location: ../index.php');
    exit;
  }


?>

<!DOCTYPE html>
<html>
<head>
  <title>Movie Registration Form</title>
</head>

<body>
<h2><strong>New Movie Details</strong></h2>
<form name="newMovieForm" method="post" action="newmovieregiresult.php">
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
  <tr>
      <td colspan="2"><strong>Movie Details</strong></td>
    </tr>
  <tr style="background-color: #FFFFFF;"> 
      <td>Moviename</td>
      <td> 
        <input name="moviename" type="text" style="width: 200px;" maxlength="100" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Release year</td>
      <td> 
        <input name="release_year" type="text" style="width: 200px;" maxlength="20" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Director</td>
      <td> 
        <input name="director" type="text" style="width: 200px;" maxlength="100" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Writers</td>
      <td> 
        <input name="writers" type="text" style="width: 200px;" maxlength="100" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Duration</td>
      <td> 
        <input name="duration" type="text" style="width: 200px;" maxlength="4" />*</td>
    </tr>
    <td>Summary</td>
      <td> 
        <input name="summary" type="text" style="width: 200px;" maxlength="100" />*</td>
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
