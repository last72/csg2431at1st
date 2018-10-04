<?php
// connect to database
require '../func/dbconnection.php';

// Start or resume a session
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Check the access level
if (!isset($_SESSION['level']))
{
  $_SESSION['level'] = '';
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Advanced Search</title>
  <style type="text/css">
    /* th,td {border: 1px solid black; width: 150px;} */
  </style>
    <script src="../js/validation.js"></script>
</head>

<body>

<?php require 'navigationbar.php'; ?>

<div class="container">


<h2><strong>Advanced Search</strong></h2>


<!-- Form -->
<form name="advancedsearchForm" method="post" action="advancedsearchresult.php" onsubmit="return ValidateadvancedsearchForm()">
<table style="width: 80%">
<tr>
    <td>Search Term: </td>
    <td><input type="text" name="searchterm" required/></td>
  </tr>
  <tr>
    <td>Also Search: </td>
    <td><input type="checkbox" name="directorwriters" value="directorwriters">Director/Writers    
    <input type="checkbox" name="plotsummary" value="plotsummary">Plot Summary</td>
  </tr>
  <tr>
    <td>Release Year: </td>
    <td>
        <select name="releaseyear">
            <option value="notimportant" selected="selected">Not Important</option>
            <option value="lessthan">Less Than</option>
            <option value="exactly">Exactly</option>
            <option value="morethan">More Than</option>
        </select>
        <input type="number" name="releaseyearvalue" />
    </td>
  </tr>
  <tr>
    <td>Duration: </td>
    <td>
        <select name="duration">
            <option value="notimportant" selected="selected">Not Important</option>
            <option value="lessthan">Less Than</option>
            <option value="exactly">Exactly</option>
            <option value="morethan">More Than</option>
        </select>
        <input type="number" name="durationvalue" />

    </td>
  </tr>
  <tr>
    <td colspan="2" style="text-align: right">
     <input type="submit">
    </td>
  </tr>
  
</table>
</form>

      </div>

  </body>
</html>