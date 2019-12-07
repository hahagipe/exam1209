<?php
	$Account=$_POST["Account"];
	$Password=$_POST["Password"];
	$IsOK=$_POST["IsOK"];

	require_once("dbtools.inc.php");
	$conn=create_connect();

	$Password_md5=md5($Password);

	
	if ($Account && $Password_md5 !="") {
		$sql="INSERT INTO exam1209(Account,Password)VALUES('$Account','$Password_md5')";
		if (execute_sql($conn,"id9585402_php",$sql)) {
			
			echo "true";
		}else{
			echo "false".mysqli_error($conn);
		}
	}else{
		echo "資料空白不可新增";
	}
	mysqli_close($conn);
?>