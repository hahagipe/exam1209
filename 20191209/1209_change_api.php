<?php
	$ID=$_POST["ID"];

	 $Password=$_POST["Password"];

	 $Password_md5=md5($Password);

	require_once("dbtools.inc.php");
	$conn=create_connect();

	$sql="UPDATE exam1209 SET Password='$Password_md5' WHERE ID=".$ID;
	if (execute_sql($conn,"id9585402_php",$sql)) {
		echo "更新成功!!";
	}else{
		echo "更新失敗!!".mysqli_error($conn);
	}
	
	mysqli_close($conn);
?>