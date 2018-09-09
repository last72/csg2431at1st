//User php/registration.php validation
function ValidateUserForm()
    {
			if (document.newUserForm.username.value == '')
			{
				alert('User name field cannot be blank.');
			document.newUserForm.username.focus();
			return false;
			}
		
    if (document.newUserForm.birth_year.value == '')
	  {
	    alert('Birth year field cannot be blank.');
		document.newUserForm.birth_year.focus();
		return false;
	  }

    if (isNaN(document.newUserForm.birth_year.value))
	  {
	    alert('Birth year field must be a number.');
		document.newUserForm.birth_year.focus();
		return false;
	  }
	  
    if (document.newUserForm.username.value == '')
	  {
	    alert('Username cannot be blank.');
		document.newUserForm.username.focus();
		return false;
	  }
	  
    if (document.newUserForm.emailAddress.value == '')
	  {
	    alert('Email Address field cannot be blank.');
		document.newUserForm.emailAddress.focus();
		return false;
	  }
	  
    if (document.newUserForm.password.value == '')
	  {
	    alert('Password field cannot be blank.');
		document.newUserForm.password.focus();
		return false;
	  }

    if (document.newUserForm.password.value.length < 5)
    {
      alert('Password mush be at least 5 characters long.');
      document.newUserForm.password.focus();
      return false;
    }

    if (document.newUserForm.confirmPassword.value == '')
	  {
	    alert('Confirm Password field cannot be blank.');
		document.newUserForm.confirmPassword.focus();
		return false;
	  }

    if (document.newUserForm.password.value != document.newUserForm.confirmPassword.value)
    {
      alert('Password fields do not match.');
      document.newUserForm.confirmPassword.focus();
      return false;
    }
	  
	  return true;
	}

// Validate php/newmovierigi.php form
function ValidateMovieForm()
{
	if (document.newMovieForm.birth_year.value == '')
	{
		alert('Birth year field cannot be blank.');
	document.newMovieForm.birth_year.focus();
	return false;
	}

	if (isNaN(document.newMovieForm.birth_year.value))
	{
		alert('Birth year field must be a number.');
	document.newMovieForm.birth_year.focus();
	return false;
	}
	
	if (document.newMovieForm.username.value == '')
	{
		alert('Username cannot be blank.');
	document.newMovieForm.username.focus();
	return false;
	}
	
	if (document.newMovieForm.emailAddress.value == '')
	{
		alert('Email Address field cannot be blank.');
	document.newMovieForm.emailAddress.focus();
	return false;
	}
	
	if (document.newMovieForm.password.value == '')
	{
		alert('Password field cannot be blank.');
	document.newMovieForm.password.focus();
	return false;
	}

	if (document.newMovieForm.password.value.length < 5)
	{
		alert('Password mush be at least 5 characters long.');
		document.newMovieForm.password.focus();
		return false;
	}

	if (document.newMovieForm.confirmPassword.value == '')
	{
		alert('Confirm Password field cannot be blank.');
	document.newMovieForm.confirmPassword.focus();
	return false;
	}

	if (document.newMovieForm.password.value != document.newUserForm.confirmPassword.value)
	{
		alert('Password fields do not match.');
		document.newMovieForm.confirmPassword.focus();
		return false;
	}
	
	return true;
}