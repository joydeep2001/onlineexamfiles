<?php
	require "dbh.php";
	session_start();
	$class=$_SESSION['class'];
	$numofQ=$_SESSION['noQ'];
	$roll=$_SESSION['roll'];
	$sec=$_SESSION['sec'];
	$examType=$_SESSION['e_type'];
	
	if($examType == 'MCQ'){
		$tableName="marks_".$_SESSION['tableName'];
	}
	else if($examType == 'SAQ'){
		$tableName	= "answerSheet_".$_SESSION['tableName'];
	}
	




	$sql="insert into $tableName (roll,sec,";
	$values="values('$roll','$sec',";
	#MCQ
	if($examType == 'MCQ'){
		for($i=1;$i<=$numofQ;$i++){
	
			if($i<$numofQ){
				$sql.="q".$i.",";
				$col="q".$i;
				if(isset($_POST[$col]))
					$values.="'$_POST[$col]',";
				else
					$values.="'0',";
			}
			else{
				$sql.="q".$i.")";
				$col="q".$i;
				if(isset($_POST[$col]))
					$values.="'$_POST[$col]');";
				else
					$values.="'0');";
				
			}
	
		}
	}
	#SAQ

	else if($examType == 'SAQ'){
		//echo $numofQ;

	 	if(isset($_POST['subBtn'])){
	 		
	 		for($i=1;$i<=$numofQ;$i++){
	 			$answers="";
	 			$fName="q".$i;
	 			$j=0;
	 			$fileName=$_FILES[$fName]['name'];
	 			$sql.=$fName;
					if($i != $numofQ)
						$sql.=",";
					else
						$sql.=")";	#end of column bracket
	 			if(!empty(array_filter($fileName))){
	 				
	 				$fileCount=count($fileName);
	 				while($j < $fileCount){
	 					//echo $fileCount;
	 					
	 					$fileName = $_FILES[$fName]['name'][$j];
	 					//echo $fileName;
	 					$fileTempName = $_FILES[$fName]['tmp_name'][$j];
	 					$fileSize = $_FILES[$fName]['size'][$j];
	 					$fileError = $_FILES[$fName]['error'][$j];
	 					$fileType = $_FILES[$fName]['type'][$j];
	 					$fileExt = explode(".",$fileName);
	 					//print_r($fileExt);
	 					$fileActualExt = strtolower(end($fileExt));

	 					$allowed = array('jpg','jpeg','png','svg');
	 					
	 					if(in_array($fileActualExt, $allowed)){
	 						if($fileError === 0){
	 							if($fileSize <= 20000000){
	 								$fileNewName = uniqid('',true).".".$fileActualExt;
	 								$fileDestination = "uploads/".$fileNewName;
	 								move_uploaded_file($fileTempName, $fileDestination);
	 								$answers.=$fileNewName;
	 								if($j < $fileCount-1){
	 									$answers.=","; 
	 								}
	 							}
	 							else{
	 								echo "File should be less than 20MB";
	 							}
	 						}
	 						
	 						else{
	 							echo "You have and error uploading this file: errroCode:61";
	 						}
	 					}
	 					else{
	 						echo "You are not allowed files of this type";
	 					}
	 					$j++;
	 				}
		 		}
		 		$values.="'$answers'";
		 		if($i != $numofQ)
		 			$values.=",";
		 		else
		 			$values.=");";	#end of values bracket
		 		
	 		}
	 	}
	}
	#end of saQ
	$sql.=$values;
	mysqli_query($con,$sql);
	echo $sql;
	echo "<div style='display:flex;font-size:55px;height:100%;justify-content:center;align-items:center;border:3px solid blue;background:#0f2e5c;color:white;'>Your exam completed:Result date 8/7/2020:For more details stay connected with our YOUTUBE channel</div>";
	session_unset();
	session_destroy();
	

?>