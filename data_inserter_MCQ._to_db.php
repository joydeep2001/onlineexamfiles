<?php  
	require "dbh.php";
	session_start();
	$tableName = $_SESSION['tableName_S'];
	$noQ = $_SESSION['noQ_S'];
	if(isset($_POST['submit'])){
		$sql="insert into $tableName (no,question,a,b,c,d,correct_opt) values "; 
		for($i=1;$i<=$noQ;$i++){
			$question=$_POST['q'.$i];
			$a=$_POST['A_'.$i];
			$b=$_POST['B_'.$i];
			$c=$_POST['C_'.$i];
			$d=$_POST['D_'.$i];

			$correct_answer=$_POST['cAns_'.$i];
			if($i < $noQ)
				$sql.="('$i','$question','$a','$b','$c','$d','$correct_answer'),";
			else
				$sql.="('$i','$question','$a','$b','$c','$d','$correct_answer');";
		}
		mysqli_query($con,$sql);
		echo "Succesfully Created Exam";
	}

?>