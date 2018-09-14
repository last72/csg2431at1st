//User php/registration.php validation
function ValidateUserForm()
    {
			if (document.UserForm.username.value == '')
			{
				alert('User name field cannot be blank.');
			document.UserForm.username.focus();
			return false;
			}
		
    if (document.UserForm.birth_year.value == '')
	  {
	    alert('Birth year field cannot be blank.');
		document.UserForm.birth_year.focus();
		return false;
	  }

    if (isNaN(document.UserForm.birth_year.value))
	  {
	    alert('Birth year field must be a number.');
		document.UserForm.birth_year.focus();
		return false;
	  }
	  
    if (document.UserForm.username.value == '')
	  {
	    alert('Username cannot be blank.');
		document.UserForm.username.focus();
		return false;
	  }
	  
    if (document.UserForm.emailAddress.value == '')
	  {
	    alert('Email Address field cannot be blank.');
		document.UserForm.emailAddress.focus();
		return false;
		}
		
		//eamil validation
		var emailstring = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		var emailvalidresult = emailstring.test(String(document.UserForm.emailAddress.value).toLowerCase());
		if (!emailvalidresult)
	  {
	    alert('Email Address is not valid.');
		document.UserForm.emailAddress.focus();
		return false;
		}
	  
    if (document.UserForm.password.value == '')
	  {
	    alert('Password field cannot be blank.');
		document.UserForm.password.focus();
		return false;
	  }

    if (document.UserForm.password.value.length < 5)
    {
      alert('Password mush be at least 5 characters long.');
      document.UserForm.password.focus();
      return false;
    }

    if (document.UserForm.confirmPassword.value == '')
	  {
	    alert('Confirm Password field cannot be blank.');
		document.UserForm.confirmPassword.focus();
		return false;
	  }

    if (document.UserForm.password.value != document.UserForm.confirmPassword.value)
    {
      alert('Password fields do not match.');
      document.UserForm.confirmPassword.focus();
      return false;
    }
	  
	  return true;
	}

// Validate php/newmovierigi.php form
function ValidateMovieForm()
{
	if (document.MovieForm.moviename.value == '')
	{
		alert('Movie name field cannot be blank.');
	document.MovieForm.moviename.focus();
	return false;
	}

	if (document.MovieForm.release_year.value == '')
	{
		alert('release_year cannot be blank.');
	document.MovieForm.release_year.focus();
	return false;
	}

	if (isNaN(document.MovieForm.release_year.value))
	{
		alert('release year field must be a number.');
	document.MovieForm.release_year.focus();
	return false;
	}
	
	if (document.MovieForm.director.value == '')
	{
		alert('director cannot be blank.');
	document.MovieForm.director.focus();
	return false;
	}
	
	if (document.MovieForm.writers.value == '')
	{
		alert('writers field cannot be blank.');
	document.MovieForm.writers.focus();
	return false;
	}
	
	if (document.MovieForm.duration.value == '')
	{
		alert('duration cannot be blank.');
	document.MovieForm.duration.focus();
	return false;
	}

	if (isNaN(document.MovieForm.duration.value))
	{
		alert('duration field must be a number.');
	document.MovieForm.duration.focus();
	return false;
	}


	return true;
}