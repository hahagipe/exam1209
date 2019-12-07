<?php

	$ID=$_POST["ID"];

	require_once("dbtools.inc.php");

	$conn=create_connect();

	// mysqli_query($conn,"SET NAMES utf8"); 

	$sql="SELECT * FROM exam1209 WHERE ID=".$ID;
	$result=execute_sql($conn,"id9585402_php",$sql);
	$row=mysqli_fetch_assoc($result);

	$myArray=array();
	if (mysqli_num_rows($result)>0) {
		do{
			$myArray[]=$row;
		}while ($row=mysqli_fetch_assoc($result));
		echo json_encode($myArray);
	}else{
		echo "error";
	}

	mysqli_close($conn);

?>