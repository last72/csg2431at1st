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

  if (!( $_SESSION['level'] == 'admin'))
    {
    header('Location: ../index.php');
    exit;
    }

    ?>

<!DOCTYPE html>
<html>
<head>
  <script src="../js/validation.js"></script>
</head>

<body>
<h3><strong>Access level changing</strong></h3>
<form name="accesslevelchange" method="post" action="accesslevelchangeresult.php" onsubmit="return ValidateaccesslevelForm();">
 <input name="username" type="hidden" value="<?php echo $_SESSION['userdetail'];  ?>" />
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
  <tr>
      <td colspan="2"><strong>Access level changing</strong></td>
    </tr>
  <tr style="background-color: #FFFFFF;"> 
      <td>Access level</td>
      <td>         
        <select name="accesslevel" style="width: 200px;" required>
            <option value="admin">Admin</option>
            <option value="moderator">Moderator</option>
            <option value="member">Member</option>    
        </select>
        
        </td>
    </tr>
    
    <tr style="background-color: #FFFFFF;"> 
      <td colspan=2> 
		<input type="submit" name="submit" value="Submit"


    <?php
  if($_SESSION['uname'] == $_SESSION['userdetail'])
  {
    echo 'onclick="return confirm(\'If you change to non-admin user, you will lost your admin access. Would you proceed?\');"';
  }



    ?>
    
    
    /></td>
    </tr>
  </table>
</form>
</body>
</html>


