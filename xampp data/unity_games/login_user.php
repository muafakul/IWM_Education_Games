<?php
	include 'postgres_connect.php';
	
	function login_user($username, $password) {
		// Connect to the database
		$connection = db_connect();
		
		if ($username == "") return false;
		if ($password == "") return false;
		
		$query = "SELECT user_password FROM mathgames.user WHERE user_name='$username';";
			
			//echo $query."<br>";

		$user_password = $connection->query($query);
		$user_password = $user_password->fetch(PDO::FETCH_NUM)[0];
		
		//echo $user_password."<br>";
		
		$user_id = $connection->query("SELECT user_id FROM mathgames.user WHERE user_name='$username';");
		$user_id = $user_id->fetch(PDO::FETCH_NUM)[0];
		
		echo "USERID:".$user_id."<br>";
		
		return $password == $user_password;
	}
	
			
	if ($_GET) {
		$username = $_GET['username'];
		$password = $_GET['password'];
	} else {
		$username = $argv[1];
		$password = $argv[2];
	}
	
	$result = login_user($username, $password);

	if (!$result) {
		echo "LOGIN:0";
		return "";
	} 
	echo "LOGIN:1";
	return "success";
?>