<?php
	require "dbh.php";
	session_start();
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$roll = $_POST['roll'];
		$class = $_POST['class'];
		$sec = $_POST['sec'];

		$sql="SELECT * FROM exam_details where class='$class' AND status_exam='1';";

		$result=mysqli_query($con,$sql);
		$row=mysqli_fetch_assoc($result);
		if($row['e_type'] == 'MCQ')
			$tableName = "marks_".$row['exam_name'];
		else if($row['e_type'] == 'SAQ')
			$tableName = "answersheet_".$row['exam_name'];
		
		$sql="Select * from $tableName where roll='$roll' and sec='$sec';";
		$result=mysqli_query($con,$sql);

		$Num_row=mysqli_num_rows($result);
		echo $Num_row;
		if($Num_row == 0){

			$sql = "insert into student_detail (name,roll,section,class) values ('$name','$roll','$sec','$class');";

			mysqli_query($con,$sql);
			$_SESSION['name']=$name;
			$_SESSION['roll']=$roll;
			$_SESSION['class']=$class;
			$_SESSION['sec']=$sec;
			//header("location:exam_page_newLayout.php");
		}
		else{
			echo "<div style='display:flex;font-size:55px;height:100%;justify-content:center;align-items:center;border:3px solid blue;background:#0f2e5c;color:white'>You have already performed the exam</div>";
		}
	}


?>