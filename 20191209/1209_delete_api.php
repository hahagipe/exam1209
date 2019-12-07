<?php
	$ID=$_POST["ID"];   

	require_once("dbtools.inc.php");

	$conn=create_connect();
	$sql="DELETE FROM exam1209 WHERE ID = ".$ID;

	if(execute_sql($conn,"id9585402_php",$sql)){
		echo "True";
	}else{
		echo "False".mysqli_error($conn);
	}
	mysqli_close($conn);
?>