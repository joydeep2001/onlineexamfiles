<?php
session_start();
require "dbh.php";
	$tableName = $_SESSION['tableName_S'];
	$noQ=$_SESSION['noQ_S'];
	
	$sql="insert into $tableName (no,question) values";
	for($i=1;$i<=$noQ;$i++){
		
		$ques="ques".$i;
		$question=$_POST[$ques];
		
		$sql.="('$i','$question') ";
		if($i!=$noQ){
			$sql.=",";
		}
	}
	$sql.=";";
	mysqli_query($con,$sql);
	$sql="select * from $tableName";
	$result=mysqli_query($con,$sql);
	if(mysqli_num_rows($result) != 0){
		echo mysqli_num_rows($result)." questions inserted successfully";
	}
	else{
		"There was an error uploading the question.Please retry again.";
	}	
?>