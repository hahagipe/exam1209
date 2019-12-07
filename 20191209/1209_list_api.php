<?php
	require_once("dbtools.inc.php");
	$conn=create_connect();
	$sql="SELECT * FROM exam1209";

	$result=execute_sql($conn,"id9585402_php",$sql);
	$row=mysqli_fetch_assoc($result);
	$userArray=array();

	if (mysqli_num_rows($result)>0) {
		do {
			$userArray[]=$row;
		} while ($row=mysqli_fetch_assoc($result));
		echo json_encode($userArray);
	}else{
		echo "None";
	}
	mysqli_close($conn);
?>