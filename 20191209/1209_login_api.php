<?php

	session_start();

	$Account=$_GET["Account"];
	$Password=$_GET["Password"];
	

	require_once("dbtools.inc.php");
	$conn=create_connect();

	
	$Password_md5=md5($Password);

	//echo $Password_md5;

	$sql="SELECT * FROM exam1209 WHERE Account='$Account' AND Password='$Password_md5'";
	$result = execute_sql($conn,"id9585402_php",$sql);

	if (mysqli_num_rows($result) == 1) {

		$row=mysqli_fetch_assoc($result);

		$_SESSION["Account"]=$row["Account"];
		$_SESSION["ID"]=$row["ID"];

		    echo "";
		    //echo $_SESSION["Account"];
		    //echo $_SESSION["ID"];
	}else{
		echo "Login Failed";
	}
	
	mysqli_close($conn);
?>