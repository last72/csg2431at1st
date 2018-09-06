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
	echo '* <a href="view.php">View Stuff</a><br />';
	echo '* <a href="edit.php">Edit Stuff</a><br />';
	echo '* <a href="delete.php">Delete Stuff</a>';
}

if ( $_SESSION['level'] == 'member' )
{
	echo '* <a href="view.php">View Stuff</a>';
}

echo '<p><a href="logout.php">Log Out</a></p>';
?>