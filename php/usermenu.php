<?php
//Start or resume a session
session_start();

//If the "uname" session variable is not set or is empty, redirect to login page
if ( !isset($_SESSION['uname']) || $_SESSION['uname'] == '' )
{
	exit;
}

echo '<p>Welcome, '.$_SESSION['uname'].' ('.$_SESSION['level'].')</p>';
echo '<p>The '.$_SESSION['level'].' menu is below.</p>';

//Show appropriate menu based on access level session variable
if ( $_SESSION['level'] == 'admin' )
{
	echo '* <a href="php/registration.php">New User</a><br />';
	echo '* <a href="php/listUsers.php">List User</a><br />';
	echo '* <a href="php/editUser.php">Edit User</a><br />';

	echo '* <a href="php/newmovieregi.php">New Movie</a><br />';
	echo '* <a href="php/listMovies.php">List Movie</a><br />';
	echo '* <a href="php/editMovie.php">Edit Movie</a><br />';

}

if ( $_SESSION['level'] == 'editor' )
{
	echo '* <a href="php/registration.php">New User</a><br />';
	
	echo '* <a href="php/newmovieregi.php">New Movie</a><br />';
	echo '* <a href="php/listMovies.php">List Movie</a><br />';
	echo '* <a href="php/editMovie.php">Edit Movie</a><br />';
}


if ( $_SESSION['level'] == 'member' )
{
	echo '* <a href="php/listMovies.php">List Movie</a><br />';
}


echo '<br /><p><a href="logout.php">Log Out</a></p>';

?>
