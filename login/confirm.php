<?php
$servername = "servername";
$user_name = "username";
$dbpassword = "password";
$dbname = "databasename";
$con = mysqli_connect($servername, $user_name, $dbpassword, $dbname);

if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

session_start();

if(isset($_POST["login"])) 
    {    
        $name = $_POST["username"]; 
        $pword = $_POST["password"]; 
		$sql = "SELECT id FROM users WHERE name = '$name' and password = '$pword'"; // checks if the name and password matches with a user in your database
		$result = mysqli_query($con,$sql) or die( mysqli_error($con)); 
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$active = $row['active'];
      
      $count = mysqli_num_rows($result);
		
      if($count == 1) { // check f there is a row with the same name and password 
		 $id = $row['id'];
		 $_SESSION['id'] = $id;
         $_SESSION['username'] = $name;
		 $_SESSION['userLogin'] = "Loggedin";
		$response = array('msg' => 'true');
 
      else {
		$response = array('msg' => 'false');
		echo json_encode($response);
	exit();
}


?>
