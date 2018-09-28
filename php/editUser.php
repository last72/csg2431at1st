<?php
// connect to database
require '../func/dbconnection.php';

// Start or resume a session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

  // Only admin or user can edit.
  if ( !($_SESSION['level'] == 'admin' || $_SESSION['uname'] == $_GET['edit_id']))
{
  header('Location: ../index.php');
  exit;
}

  // process submitted form
  if (isset($_POST['password']))
 
 {


  
    //create short variable names from the data received from the form
    $password = $_POST['password']; 
    $confirmPassword = $_POST['confirmPassword'];
    $realname = $_POST['realname'];
    $birth_year = $_POST['birth_year'];
    $country = $_POST['country'];
    $emailAddress = $_POST['emailAddress'];
  
  // we create this variable and set it to an empty string... if it remains empty by the end
  // of our validation code, then there was no error found
  $error_message = '';

  // first we'll check if any of our required fields are empty all at once
  if ( empty($birth_year) || empty($country) ||
  empty($password) || empty($confirmPassword))
  {
    $error_message = 'One of the required values was  blank.';
  }

  // now we'll check if the password is long enough
  elseif (strlen($password) < 5)
  {
    $error_message = 'Your password is not long enough.';
  }

  // now we'll check if the password fields do not match
  elseif ($password != $confirmPassword)
  {
    $error_message = 'Your password is not long enough.';
  }
  
  // to check valid email address
  elseif (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL))
  {
	  $error_message = 'The email address is not valid';
  }
  elseif (!is_numeric($birth_year))
  {
    $error_message = 'Your home birth year is not numeric';
  }
  
  // now we'll check if the name is too long
  elseif (strlen($realname) > 50)
  {
    $error_message = 'Your name is too long.';
  }

  // now we'll check if the birth year is valid
  elseif (strlen($birth_year) != '4')
  {
    $error_message = 'Your birth year is not valid.';
  }

  // now we'll check if the emailAddress is too long
  elseif (strlen($emailAddress) > 100)
  {
    $error_message = 'Your emailAddress is too long.';
  }

  // now we'll check if the country name is too long
  elseif (strlen($emailAddress) > 50)
  {
    $error_message = 'Your country name is too long.';
  }

  // now we'll check if the password is too long
  elseif (strlen($password) > 50)
  {
    $error_message = 'Your password is too long.';
  }


  // if the error_message variable is not empty (i.e. an error has been found)
  if ($error_message != '')
  {
    // we'll just provide the user with the error message and a back link if there is an error
    // the exit command tells the server/PHP to stop processing the script at that point
    // echo 'Error: '.$error_message.' <a href="javascript: history.back();">Go Back</a>.';
    echo "<script type='text/javascript'>alert('Error: ".$error_message."');</script>";
    echo "<script type='text/javascript'>javascript: history.back();</script>";


    echo '</body></html>';
    exit;
  }
  else
  {
    //  if there was no error, show success message
    // (and them the script continues to the HTML section that displays the results)
    // echo '<p><strong>Form submitted sucessfully!</strong></p>';

    echo "<script type='text/javascript'>alert('Form submitted sucessfully!');</script>";

	
	
	$query = "UPDATE users
  
  SET real_name = '".$realname."', 
  email = '".$emailAddress."', 
  birth_year = '".$birth_year."', 
  country =  '".$country."' 

  WHERE username = '".$_GET['edit_id']."'";
	
  $result = mysqli_query($connection, $query);	
	
	
	if ($result)
	{
    echo "<script type='text/javascript'>alert('User details updated!');</script>";
	}
	else
	{
    // echo '<p>Error updating details :</p>';
    // echo mysqli_error($connection);

    echo "<script type='text/javascript'>alert('Error updating details :".mysqli_error($connection)."');</script>";

	}
	
  }
	  
	  
  }
  
	  //  edit user if edit_id GET data exists
  if (isset($_GET['edit_id']))
  {
      //  fetch the user's details and store them in $row
      
      $edit_query = 'SELECT * FROM users WHERE username = \''.$_GET['edit_id'].'\'';
      $result = mysqli_query($connection, $edit_query);
      
      
      $row = $result->fetch_assoc();
  }
  else
  {
	  //  if there is no user id available, redirect back to the list users page
	  header('Location: listUsers.php');
	  exit;
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit User Form</title>
</head>

<body>
<?php require 'navigationbar.php'; ?>

<div class="container">
<h2><strong>User Details</strong></h2>
<form name="UserForm" method="post" action="editUser.php?edit_id=<?php echo $_GET['edit_id']?>" onsubmit="return ValidateUserForm();">
  
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
  <tr>
      <td colspan="2"><strong>Login Details</strong></td>
    </tr>
  <tr style="background-color: #FFFFFF;"> 
      <td>Username</td>
      <td> 
        <input name="username" type="text" style="width: 200px;" maxlength="100" value="<?php echo
		$row ['username']; ?>" disabled/>*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Password</td>
      <td> 
        <input name="password" type="password" style="width: 200px;" maxlength="20"  required/>*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Confirm Password</td>
      <td> 
        <input name="confirmPassword" type="password" style="width: 200px;" maxlength="20"  required/>*</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><strong>Personal Details</strong></td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Real Name</td>
      <td> 
        <input name="realname" type="text" style="width: 200px;" maxlength="50" value="<?php echo
		$row ['real_name']; ?>" />*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td>Birth year</td>
      <td> 
        <select name="birth_year" style="width: 200px;">
          <?php

            for ($i=date("Y"); $i>=date("Y")-130; $i--)
            {
              echo '<option value="'."$i".'"';
              
              if ($i == $row ['birth_year'])
              {
                echo ' selected="selected"';
              }

              echo '>'."$i".'</option>';
            }
          ?>
        </select>
      </td>
    </tr>
    <tr style="background-color: #FFFFFF;">
    <td>Country</td>
    <td>
      <select name="country" style="width: 200px;">
       <option value="<?php echo $row ['country']; ?>" selected><?php echo	$row ['country']; ?></option>
        <option value="United States">United States</option> 
        <option value="United Kingdom">United Kingdom</option> 
        <option value="Afghanistan">Afghanistan</option> 
        <option value="Albania">Albania</option> 
        <option value="Algeria">Algeria</option> 
        <option value="American Samoa">American Samoa</option> 
        <option value="Andorra">Andorra</option> 
        <option value="Angola">Angola</option> 
        <option value="Anguilla">Anguilla</option> 
        <option value="Antarctica">Antarctica</option> 
        <option value="Antigua and Barbuda">Antigua and Barbuda</option> 
        <option value="Argentina">Argentina</option> 
        <option value="Armenia">Armenia</option> 
        <option value="Aruba">Aruba</option> 
        <option value="Australia">Australia</option> 
        <option value="Austria">Austria</option> 
        <option value="Azerbaijan">Azerbaijan</option> 
        <option value="Bahamas">Bahamas</option> 
        <option value="Bahrain">Bahrain</option> 
        <option value="Bangladesh">Bangladesh</option> 
        <option value="Barbados">Barbados</option> 
        <option value="Belarus">Belarus</option> 
        <option value="Belgium">Belgium</option> 
        <option value="Belize">Belize</option> 
        <option value="Benin">Benin</option> 
        <option value="Bermuda">Bermuda</option> 
        <option value="Bhutan">Bhutan</option> 
        <option value="Bolivia">Bolivia</option> 
        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
        <option value="Botswana">Botswana</option> 
        <option value="Bouvet Island">Bouvet Island</option> 
        <option value="Brazil">Brazil</option> 
        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
        <option value="Brunei Darussalam">Brunei Darussalam</option> 
        <option value="Bulgaria">Bulgaria</option> 
        <option value="Burkina Faso">Burkina Faso</option> 
        <option value="Burundi">Burundi</option> 
        <option value="Cambodia">Cambodia</option> 
        <option value="Cameroon">Cameroon</option> 
        <option value="Canada">Canada</option> 
        <option value="Cape Verde">Cape Verde</option> 
        <option value="Cayman Islands">Cayman Islands</option> 
        <option value="Central African Republic">Central African Republic</option> 
        <option value="Chad">Chad</option> 
        <option value="Chile">Chile</option> 
        <option value="China">China</option> 
        <option value="Christmas Island">Christmas Island</option> 
        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
        <option value="Colombia">Colombia</option> 
        <option value="Comoros">Comoros</option> 
        <option value="Congo">Congo</option> 
        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
        <option value="Cook Islands">Cook Islands</option> 
        <option value="Costa Rica">Costa Rica</option> 
        <option value="Cote D'ivoire">Cote D'ivoire</option> 
        <option value="Croatia">Croatia</option> 
        <option value="Cuba">Cuba</option> 
        <option value="Cyprus">Cyprus</option> 
        <option value="Czech Republic">Czech Republic</option> 
        <option value="Denmark">Denmark</option> 
        <option value="Djibouti">Djibouti</option> 
        <option value="Dominica">Dominica</option> 
        <option value="Dominican Republic">Dominican Republic</option> 
        <option value="Ecuador">Ecuador</option> 
        <option value="Egypt">Egypt</option> 
        <option value="El Salvador">El Salvador</option> 
        <option value="Equatorial Guinea">Equatorial Guinea</option> 
        <option value="Eritrea">Eritrea</option> 
        <option value="Estonia">Estonia</option> 
        <option value="Ethiopia">Ethiopia</option> 
        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
        <option value="Faroe Islands">Faroe Islands</option> 
        <option value="Fiji">Fiji</option> 
        <option value="Finland">Finland</option> 
        <option value="France">France</option> 
        <option value="French Guiana">French Guiana</option> 
        <option value="French Polynesia">French Polynesia</option> 
        <option value="French Southern Territories">French Southern Territories</option> 
        <option value="Gabon">Gabon</option> 
        <option value="Gambia">Gambia</option> 
        <option value="Georgia">Georgia</option> 
        <option value="Germany">Germany</option> 
        <option value="Ghana">Ghana</option> 
        <option value="Gibraltar">Gibraltar</option> 
        <option value="Greece">Greece</option> 
        <option value="Greenland">Greenland</option> 
        <option value="Grenada">Grenada</option> 
        <option value="Guadeloupe">Guadeloupe</option> 
        <option value="Guam">Guam</option> 
        <option value="Guatemala">Guatemala</option> 
        <option value="Guinea">Guinea</option> 
        <option value="Guinea-bissau">Guinea-bissau</option> 
        <option value="Guyana">Guyana</option> 
        <option value="Haiti">Haiti</option> 
        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
        <option value="Honduras">Honduras</option> 
        <option value="Hong Kong">Hong Kong</option> 
        <option value="Hungary">Hungary</option> 
        <option value="Iceland">Iceland</option> 
        <option value="India">India</option> 
        <option value="Indonesia">Indonesia</option> 
        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
        <option value="Iraq">Iraq</option> 
        <option value="Ireland">Ireland</option> 
        <option value="Israel">Israel</option> 
        <option value="Italy">Italy</option> 
        <option value="Jamaica">Jamaica</option> 
        <option value="Japan">Japan</option> 
        <option value="Jordan">Jordan</option> 
        <option value="Kazakhstan">Kazakhstan</option> 
        <option value="Kenya">Kenya</option> 
        <option value="Kiribati">Kiribati</option> 
        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
        <option value="Korea, Republic of">Korea, Republic of</option> 
        <option value="Kuwait">Kuwait</option> 
        <option value="Kyrgyzstan">Kyrgyzstan</option> 
        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
        <option value="Latvia">Latvia</option> 
        <option value="Lebanon">Lebanon</option> 
        <option value="Lesotho">Lesotho</option> 
        <option value="Liberia">Liberia</option> 
        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
        <option value="Liechtenstein">Liechtenstein</option> 
        <option value="Lithuania">Lithuania</option> 
        <option value="Luxembourg">Luxembourg</option> 
        <option value="Macao">Macao</option> 
        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
        <option value="Madagascar">Madagascar</option> 
        <option value="Malawi">Malawi</option> 
        <option value="Malaysia">Malaysia</option> 
        <option value="Maldives">Maldives</option> 
        <option value="Mali">Mali</option> 
        <option value="Malta">Malta</option> 
        <option value="Marshall Islands">Marshall Islands</option> 
        <option value="Martinique">Martinique</option> 
        <option value="Mauritania">Mauritania</option> 
        <option value="Mauritius">Mauritius</option> 
        <option value="Mayotte">Mayotte</option> 
        <option value="Mexico">Mexico</option> 
        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
        <option value="Moldova, Republic of">Moldova, Republic of</option> 
        <option value="Monaco">Monaco</option> 
        <option value="Mongolia">Mongolia</option> 
        <option value="Montserrat">Montserrat</option> 
        <option value="Morocco">Morocco</option> 
        <option value="Mozambique">Mozambique</option> 
        <option value="Myanmar">Myanmar</option> 
        <option value="Namibia">Namibia</option> 
        <option value="Nauru">Nauru</option> 
        <option value="Nepal">Nepal</option> 
        <option value="Netherlands">Netherlands</option> 
        <option value="Netherlands Antilles">Netherlands Antilles</option> 
        <option value="New Caledonia">New Caledonia</option> 
        <option value="New Zealand">New Zealand</option> 
        <option value="Nicaragua">Nicaragua</option> 
        <option value="Niger">Niger</option> 
        <option value="Nigeria">Nigeria</option> 
        <option value="Niue">Niue</option> 
        <option value="Norfolk Island">Norfolk Island</option> 
        <option value="Northern Mariana Islands">Northern Mariana Islands</option> 
        <option value="Norway">Norway</option> 
        <option value="Oman">Oman</option> 
        <option value="Pakistan">Pakistan</option> 
        <option value="Palau">Palau</option> 
        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
        <option value="Panama">Panama</option> 
        <option value="Papua New Guinea">Papua New Guinea</option> 
        <option value="Paraguay">Paraguay</option> 
        <option value="Peru">Peru</option> 
        <option value="Philippines">Philippines</option> 
        <option value="Pitcairn">Pitcairn</option> 
        <option value="Poland">Poland</option> 
        <option value="Portugal">Portugal</option> 
        <option value="Puerto Rico">Puerto Rico</option> 
        <option value="Qatar">Qatar</option> 
        <option value="Reunion">Reunion</option> 
        <option value="Romania">Romania</option> 
        <option value="Russian Federation">Russian Federation</option> 
        <option value="Rwanda">Rwanda</option> 
        <option value="Saint Helena">Saint Helena</option> 
        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
        <option value="Saint Lucia">Saint Lucia</option> 
        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
        <option value="Samoa">Samoa</option> 
        <option value="San Marino">San Marino</option> 
        <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
        <option value="Saudi Arabia">Saudi Arabia</option> 
        <option value="Senegal">Senegal</option> 
        <option value="Serbia and Montenegro">Serbia and Montenegro</option> 
        <option value="Seychelles">Seychelles</option> 
        <option value="Sierra Leone">Sierra Leone</option> 
        <option value="Singapore">Singapore</option> 
        <option value="Slovakia">Slovakia</option> 
        <option value="Slovenia">Slovenia</option> 
        <option value="Solomon Islands">Solomon Islands</option> 
        <option value="Somalia">Somalia</option> 
        <option value="South Africa">South Africa</option> 
        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
        <option value="Spain">Spain</option> 
        <option value="Sri Lanka">Sri Lanka</option> 
        <option value="Sudan">Sudan</option> 
        <option value="Suriname">Suriname</option> 
        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
        <option value="Swaziland">Swaziland</option> 
        <option value="Sweden">Sweden</option> 
        <option value="Switzerland">Switzerland</option> 
        <option value="Syrian Arab Republic">Syrian Arab Republic</option> 
        <option value="Taiwan, Province of China">Taiwan, Province of China</option> 
        <option value="Tajikistan">Tajikistan</option> 
        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
        <option value="Thailand">Thailand</option> 
        <option value="Timor-leste">Timor-leste</option> 
        <option value="Togo">Togo</option> 
        <option value="Tokelau">Tokelau</option> 
        <option value="Tonga">Tonga</option> 
        <option value="Trinidad and Tobago">Trinidad and Tobago</option> 
        <option value="Tunisia">Tunisia</option> 
        <option value="Turkey">Turkey</option> 
        <option value="Turkmenistan">Turkmenistan</option> 
        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
        <option value="Tuvalu">Tuvalu</option> 
        <option value="Uganda">Uganda</option> 
        <option value="Ukraine">Ukraine</option> 
        <option value="United Arab Emirates">United Arab Emirates</option> 
        <option value="United Kingdom">United Kingdom</option> 
        <option value="United States">United States</option> 
        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
        <option value="Uruguay">Uruguay</option> 
        <option value="Uzbekistan">Uzbekistan</option> 
        <option value="Vanuatu">Vanuatu</option> 
        <option value="Venezuela">Venezuela</option> 
        <option value="Viet Nam">Viet Nam</option> 
        <option value="Virgin Islands, British">Virgin Islands, British</option> 
        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
        <option value="Wallis and Futuna">Wallis and Futuna</option> 
        <option value="Western Sahara">Western Sahara</option> 
        <option value="Yemen">Yemen</option> 
        <option value="Zambia">Zambia</option> 
        <option value="Zimbabwe">Zimbabwe</option>
      </select>
</td>
    </tr>


    <tr style="background-color: #FFFFFF;"> 
      <td>Email Address</td>
      <td> 
        <input name="emailAddress" type="text" style="width: 200px;" maxlength="200" value="<?php echo
		$row ['email']; ?>" required/>*</td>
    </tr>
    <tr style="background-color: #FFFFFF;"> 
      <td> 
        <input type="reset" name="reset" value="Reset" />
		<input type="submit" name="submit" value="Submit" /></td>
      <td> 
        <div align="right">* indicates required field</div></td>
    </tr>
  </table>
  <a href="javascript: history.back();">Go Back </a>
  <a href="../">Go Home </a>
</form>
<?php   echo '<a href="../logout.php">Sign Out</a>'; ?>

</div>
</body>
</html>