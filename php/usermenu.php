<?php
//Start or resume a session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//If the "uname" session variable is not set or is empty, redirect to login page
if ( !isset($_SESSION['uname']) || $_SESSION['uname'] == '' )
{
	echo '* You are not logged in. Log in to see more options<br />';
	echo '* <a href="php/listMovies.php">List Movie</a><br />';
}

else
{
echo '<p>Welcome, '.$_SESSION['uname'].' ('.$_SESSION['level'].')</p>';
echo '<p>The '.$_SESSION['level'].' menu is below.</p>';

//Show appropriate menu based on access level session variable
// Admin menu
if ( $_SESSION['level'] == 'admin' )
{
	echo '* <a href="php/listUsers.php">List User</a><br />';

	echo '* <a href="php/newmovieregi.php">New Movie</a><br />';
	echo '* <a href="php/listMovies.php">List Movie</a><br />';

}

// member menu
if ( $_SESSION['level'] == 'member' )
{
	echo '* <a href="php/listMovies.php">List Movie</a><br />';
	echo '* <a href="php/editUser.php?edit_id='.$_SESSION['uname'].'">Edit Profile</a><br />';
	echo '* <a href="php/userDetails.php?username='.$_SESSION['uname'].'">View Profile</a><br />';
}	

}


?>
