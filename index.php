<?php
    //php code goes here
	include "./func/actions.php";
	//Start or resume a session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>MovieTalk</title>
  </head>
  <body>
    <!-- CONTAINER -->
    <div class="container">
    	<!-- NAVIGATION SECTION GOES HERE -->
	  	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="index.php">MovieTalk</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
		      </li>
					<li class="nav-item dropdown">
		        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          [dev purpose]
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						  <a class="dropdown-item" href="php/registration.php">New User</a>
		          <a class="dropdown-item" href="php/listUsers.php">List User</a>
		          <a class="dropdown-item" href="php/editUser.php">Edit User</a>
		          <div class="dropdown-divider"></div>
							<a class="dropdown-item" href="php/newmovieregi.php">New Movie</a>
							<a class="dropdown-item" href="php/listMovies.php">List Movie</a>
		          <a class="dropdown-item" href="php/editMovie.php">Edit Movie</a>
							</div>
		      </li>

	<?php 
	//If the "uname" session variable is not set or is empty, redirect to login page
	if ( !isset($_SESSION['uname']) || $_SESSION['uname'] == '' )
	{
		echo '<li class="nav-item">
			<a class="nav-link" href="login.php">Sign In</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="php/registration.php">Register</a>
		</li>';

	}
	else
	{
		echo '<li class="nav-item">
			<a class="nav-link" href="logout.php">Sign Out</a>
		</li>';
	}
	
	?>


		    </ul>
		    <form class="form-inline my-2 my-lg-0" method="get" action="php/searchMovies.php">
		      <input class="form-control mr-sm-2" type="search" placeholder="Search movies" aria-label="Search" name="serach_item" required />
		      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		    </form>
		  </div>
		</nav>
	  	<!-- END OF NAVIATION -->
			
			<?php include 'php/usermenu.php'; ?>


    </div>
    <!-- END OF CONTAINER -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>