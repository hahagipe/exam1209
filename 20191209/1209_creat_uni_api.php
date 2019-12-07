<?php

	$uni_account = $_POST["Account"];

	require_once("dbtools.inc.php");
	$conn=create_connect();
	$sql = "SELECT * FROM exam1209 WHERE Account = '$uni_account'";
	$result = execute_sql($conn,"id9585402_php",$sql);


	if(mysqli_num_rows($result) == 1){
		echo true;
	}else{
		echo false;
	}

	mysqli_close($conn);
?>