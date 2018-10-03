<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="../index.php">MovieTalk</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">
<li class="nav-item active">
<a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
</li>


<?php
if ( $_SESSION['level'] == 'admin' )
{
	echo '<li class="nav-item"><a class="nav-link" href="listUsers.php">List User</a></li><br />';
	echo '<li class="nav-item"><a class="nav-link" href="newmovieregi.php">New Movie</a></li><br />';
	echo '<li class="nav-item"><a class="nav-link" href="statistics.php">Site statistics</a></li><br />';
}

?>
	<a class="nav-link" href="listMovies.php">List Movie</a>
<?php
if ( $_SESSION['level'] == 'member' or $_SESSION['level'] == 'moderator' )
{
	echo '<li class="nav-item"><a class="nav-link" href="editUser.php?edit_id='.$_SESSION['uname'].'">Edit Profile</a></li><br />';
	echo '<li class="nav-item"><a class="nav-link" href="userDetails.php?username='.$_SESSION['uname'].'">View Profile</a></li><br />';
}


echo '<li class="nav-item">
			<a class="nav-link" href="advancedsearchform.php">Advanced Search</a>
		</li>';

?>
	



	<?php 
	//If the "uname" session variable is not set or is empty, redirect to login page
	if ( !isset($_SESSION['uname']) || $_SESSION['uname'] == '' )
	{
		echo '<li class="nav-item">
			<a class="nav-link" href="login.php">Sign In</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="registration.php">Register</a>
		</li>'; 

	}
	else
	{
		echo '<li class="nav-item">
			<a class="nav-link" href="../logout.php">Sign Out</a>
		</li>';
	}
	
	?>


		    </ul>
		    <form class="form-inline my-2 my-lg-0" method="get" action="searchMovies.php">
		      <input class="form-control mr-sm-2" type="search" placeholder="Search movies" aria-label="Search" name="serach_item" required />
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		    </form>
		  </div>
		</nav>
        </div>
    