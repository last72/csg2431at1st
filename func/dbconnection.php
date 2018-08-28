<?php
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', 't00r');
define('DBNAME', 'movietalkat1');
class Database
{
	public $strConn;
	public function __construct(){
        $this->strConn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
		if(!$this->strConn){
			//Continue with connection and data operations.
		//}else{
			//echo "There is some issue with connection. Please contact ADMINISTRATOR for support.";
		}
	}
}
$obj = new Database;
//another connection just for login
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS);
//$connection = mysqli_connect('localhost', 'root', 't00r');
If(!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, DBNAME);
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
?>