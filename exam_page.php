<?php
	require 'dbh.php';
	session_start();
	
	
	
	
	
			$name=$_SESSION['name'];
			$roll=$_SESSION['roll'];
			$class=$_SESSION['class'];
			$sec=$_SESSION['sec'];


			$sql="Select * From exam_details where class='$class' and status_exam='1'";
			$result = mysqli_query($con,$sql);

			$arr=mysqli_fetch_assoc($result); #$arr contains all details of exam_details
			$tableName=$arr['exam_name'];
			$duration=$arr['duration']*60;
			$sql="Select * from $tableName";
			$result=mysqli_query($con,$sql);
			#For MCQ type exam
			if($arr['e_type'] == 'MCQ'){
				$content="<form method='POST' onsubmit='return alertUser()' action='exam_pageTo_DB.php' id='dynamic'><div id='innerForm'>";
				$navigator="";
				
				for($i=1;$row=mysqli_fetch_assoc($result);$i++){
					//Creating quesCont div
					$quesCont ="<div id='question' class=move>".$row['question']."</div>";
					//Creating Labels
					$labelA="<label for='o_".$i."_a'>".$row['a']."</label>";
					$labelB="<label for='o_".$i."_b'>".$row['b']."</label>";
					$labelC="<label for='o_".$i."_c'>".$row['c']."</label>";
					$labelD="<label for='o_".$i."_d'>".$row['d']."</label>";
					//Creating inputs
					$inputA="<input type='radio' name='q".$i."' id='o_".$i."_a' value='A' class='radioBtn'>";
					$inputB="<input type='radio' name='q".$i."' id='o_".$i."_b' value='B' class='radioBtn'>";
					$inputC="<input type='radio' name='q".$i."' id='o_".$i."_c' value='C' class='radioBtn'>";
					$inputD="<input type='radio' name='q".$i."' id='o_".$i."_d' value='D' class='radioBtn'>";
					//Creating answerCont div
					$answerCont="<div id=ansCont class=move><div id=innerAnsCont><div id=coreAnsCont><div id=optNo>A</div><div id=opt>".$inputA.$labelA."</div></div><div id=coreAnsCont><div id=optNo>B</div><div id=opt>".$inputB.$labelB."</div></div></div>";

					$answerCont.="<div id=innerAnsCont><div id=coreAnsCont><div id=optNo>C</div><div id=opt>".$inputC.$labelC."</div></div><div id=coreAnsCont><div id=optNo>D</div><div id=opt>".$inputD.$labelD."</div></div></div></div>";

					$content.=$quesCont.$answerCont;
					$navigator.="<div class=circle>".$i."</div>";

					
				}
					$content.="</div>";
					$content.="<button type='submit' name='submit' class='sub' id=btnSub>Submit Exam</button>";
					$content.="</form>";

					$_SESSION['noQ']=$i;
			}
			#For SAQ type exam
			else if($arr['e_type'] == 'SAQ'){
				$content="<form method='POST' onsubmit='return alertUser()' action='exam_pageTo_DB.php' id='dynamic'>"
			}
			#For LQ type exam
			else if($arr['e_type'] == 'LQ'){

			}
			#For custom type exam
			else if($arr['e_type'] == 'custom'){

			}
	

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="front_end_stylesheet.css">
</head>
<body onload="checker()">
	<header>
		<div id=logo2></div>
		<div id=timer></div>
	</header>

	<div id=cont>
		<?php
			echo $content;
			
		?>
	<nav>
		<?php
			echo $navigator;
		?>
	</nav>
	<div id=btnCont>
			<button id=backbt class=btn type=button onclick='bk()'>Back</button>
			<button id=next class=btn type=button onclick='nx()'>Next</button>
		</div>
		
	</div>
	
</body>
<script type="text/javascript">
		var moveClass = document.getElementsByClassName('move');
		var nextButton = document.getElementById('next');
		var backButton = document.getElementById('backbt');
		var navCircles = document.getElementsByClassName('circle'); 
		var radio = document.getElementsByClassName('ans');
		var submitButton = document.getElementById("btnSub"); 
		var movement=0;
		var timerVar=document.getElementById("timer");
		var pos=1;
		var steps = 352;
		<?php 
			$i-=1;
			echo "noQ=".$i.";";
		 ?>
		 <?php
		 	echo "var totalTime=".$duration.";";
		 ?>
		 setInterval(timer,1000);
		 function timer(){
		 	if(totalTime >=-1){
			 	var min=Math.floor(totalTime/60);
			 	var second=Math.floor(totalTime%60);
			 	if(second < 10){
			 		timerVar.innerHTML="<span>Time Left: "+min+":0"+second+"</span>";
			 	}
			 	else
			 		timerVar.innerHTML="<span>Time Left: "+min+":"+second+"</span>";
			 	totalTime--;
			 }
			 else{
			 	submitButton.click();
			 }
		 }
		 function alertUser(){
		 	if(totalTime <= 0){
		 		return true;
		 	}
		 	var cnf = confirm("Are you sure you want to submit?");
		 	return cnf;
		 }
		 function checker(){
		document.getElementById("logo2").innerHTML="<span>"+pos+"</span>";
		submitButton.style.display="none";
		if(pos == 1){
			backButton.disabled = true;
		}else{
			
			backButton.disabled = false;
		}
		if(pos == noQ){
			nextButton.disabled = true;
		}else{
			
			nextButton.disabled = false;
		}
		for(var i=0;i<navCircles.length;i++){
			if(i == pos-1){
				navCircles[i].style.background="red";	
			}else{
				navCircles[i].style.background="white";	
			}
		}
		if(pos == 6){
			submitButton.style.display="flex";
			submitButton.style.display="Justify-content:center";
			submitButton.style.display="align-items:center";
		}
		
	}
		function bk(){
		pos--;
		
		movement+=steps;

		console.log(movement);
		checker();
		for(var i=0;i<moveClass.length;i++){
				moveClass[i].style.transform="translateX("+movement+"px)";
				moveClass[i].style.transition='.5s';

			}
		
	}
	function nx(){
		
		movement-=steps;
		pos++;
		checker();
		for(var i=0;i<moveClass.length;i++){
				moveClass[i].style.transform="translateX("+movement+"px)";
				moveClass[i].style.transition='.5s';
			}
			
	}
</script>
</html>