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

  if (!( $_SESSION['level'] == 'admin' or $_SESSION['level'] == 'moderator' or $_SESSION['level'] == 'member' ))
    {
    header('Location: ../index.php');
    exit;
    }

    ?>

<!DOCTYPE html>
<html>
<head>
  <title>discussion rating</title>
  <script src="../js/validation.js"></script>
</head>

<body>
<h3><strong>Movie Discussion</strong></h3>
<form name="DiscussiongForm" method="post" action="newdiscussionresult.php" onsubmit="return ValidateDiscussiongForm();">
 <input name="movie_id" type="hidden" value="<?php echo $_SESSION['movie_id'];  ?>" />
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
  <tr>
      <td colspan="2"><strong>Movie Discussion</strong></td>
    </tr>
  
    <tr style="background-color: #FFFFFF;"> 
      <td>Comment</td>
      <td> 
        <textarea name="content" type="text" style="width: 200px;" maxlength="100" ></textarea>*</td>
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
