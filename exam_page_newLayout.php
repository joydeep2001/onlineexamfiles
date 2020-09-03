<?php
	require 'dbh.php';
	session_start();
	

//new line
if(isset($_SESSION['name'])){
	$name=$_SESSION['name'];
	$roll=$_SESSION['roll'];
	$class=$_SESSION['class'];
	$sec=$_SESSION['sec'];


	$sql="Select * From exam_details where class='$class' and status_exam='1'";
	$result = mysqli_query($con,$sql);

	$arr=mysqli_fetch_assoc($result);
	$tableName=$arr['exam_name'];
	$_SESSION['tableName']=$tableName;
	$duration=$arr['duration']*60;
	$sql="Select * from $tableName";
	$result=mysqli_query($con,$sql);
	if($arr['e_type'] == 'MCQ')
		$content="<form method='POST' onsubmit='return alertUser()' action='exam_pageTo_DB.php' id=f><div id='form'>";
	else if($arr['e_type'] == 'SAQ'){
		$content="<form method='POST' onsubmit='return alertUser()' action='exam_pageTo_DB.php' enctype='multipart/form-data' id=f><div id='form'>";
	}
	$_SESSION['e_type']=$arr['e_type'];
	
	for($i=1;$row=mysqli_fetch_assoc($result);$i++){
		//Creating quesCont div

		$content.="<div class='formCont'>";
		$quesCont ="<div class=question><p><b>".$row['question']."</b></p></div>";
		#MCQ
		if($arr['e_type'] == 'MCQ'){
			//Creating Labels
			$labelA="<label for='o_".$i."_a'><p>".$row['a']."</p></label>";
			$labelB="<label for='o_".$i."_b'><p>".$row['b']."</p></label>";
			$labelC="<label for='o_".$i."_c'><p>".$row['c']."</p></label>";
			$labelD="<label for='o_".$i."_d'><p>".$row['d']."</p></label>";
			//Creating inputs
			$inputA="<input type='radio' name='q".$i."' id='o_".$i."_a' value='A' class='radioBtn'>";
			$inputB="<input type='radio' name='q".$i."' id='o_".$i."_b' value='B' class='radioBtn'>";
			$inputC="<input type='radio' name='q".$i."' id='o_".$i."_c' value='C' class='radioBtn'>";
			$inputD="<input type='radio' name='q".$i."' id='o_".$i."_d' value='D' class='radioBtn'>";
			//Creating answerCont div
			$answerCont="<div class=optCont><div class=optNo>A</div>".$inputA.$labelA."</div>";
			$answerCont.="<div class=optCont><div class=optNo>B</div>".$inputB.$labelB."</div>";
			$answerCont.="<div class=optCont><div class=optNo>C</div>".$inputC.$labelC."</div>";
			$answerCont.="<div class=optCont><div class=optNo>D</div>".$inputD.$labelD."</div>";
			$content.=$quesCont.$answerCont;
			
		}
		#SAQ
		else if($arr['e_type'] == 'SAQ'){
			$answerCont="<input type=FILE multiple name=q".$i."[] id=q".$i."class=fileInput>";
			$content.=$quesCont.$answerCont;
		}
		$content.= "</div>";	#End of formCont <div>
		

		
	}
		$content.="</div>";
		$content.="<button type=submit name=subBtn id=subBtn>Submit</button>";
		$content.="</form>";

		$_SESSION['noQ']=$i-1;
}
else{
	echo "<center><font size=50px>YOUR ANSWER HAS BEEN SUBMITTED</font></center>";
}			
	

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="exam_page_style.css">
	
</head>
<body <?php if(isset($_SESSION['name'])) echo"onload='checker()'"?> >
	<div id=loader>

	</div>
	<div id=timer></div>
	<div id=btnCont>
		<button onclick="prev()" id=prevBtn class=btn>prev</button>
		<div id=msg>No info</div>
		<button onclick="next()" id=nextBtn class=btn>Next</button>

	</div>

	
		<?php
		if(isset($_SESSION['name']))
			echo $content;
			
		?>
	

		
<script>
//window
var totalTime = 0;
var first = 0;
<?php
if(isset($_SESSION['name']))
 	echo "var totalTime=".$duration.";";
?>
if(totalTime != 0){
	var formContent = document.getElementsByClassName('formCont');
	var submitButton = document.getElementById('subBtn');
	var nextBtn = document.getElementById('nextBtn');
	var prevBtn = document.getElementById('prevBtn');
	var msg = document.getElementById('msg');
	var questions=document.getElementsByClassName('question');
	var optCont=document.getElementsByClassName('optCont');
	var form = document.getElementById("form");
	var qno=0;
	var pos=0;
	var loader=document.getElementById("loader");
	
	var timerVar=document.getElementById("timer");
	var first=1;


	/*Checker function*/
	function checker(){	
		if(first){
			first--;
			for(var i=1;i<formContent.length;i++){
				formContent[i].style.display="none";
			}
		}
		var no=qno+1;
		msg.innerHTML =no+" of "+formContent.length+" questions";
		if(no == 1){
			prevBtn.disabled=true;
			prevBtn.style.background="grey";
		}
		else{
			prevBtn.disabled=false;
			prevBtn.style.background="#0f46e2";
		}
		if(no == formContent.length){
			nextBtn.disabled=true;
			nextBtn.style.background="grey";
		}
		else{
			nextBtn.disabled=false;
			nextBtn.style.background="#0f46e2";
		}
		if(no == formContent.length){
			submitButton.style.display="flex";
		}else{
			submitButton.style.display="none";
		}
	}
	/*Timer*/

	 setInterval(timer,1000);
	 function timer(){
	 	if(totalTime >=-1){
		 	var min=Math.floor(totalTime/60);
		 	var second=Math.floor(totalTime%60);
		 	if(second < 10){
		 		timerVar.innerHTML="<h1>"+min+":0"+second+"</h1>";
		 	}
		 	else
		 		timerVar.innerHTML="<h1>"+min+":"+second+"</h1>";
		 	totalTime--;
		 }
		 else{
		 	form.style.display="none";
		 	loader.style.display="block";
		 	submitButton.click();
		 }

	}


	/*Next function*/

	function next(){
		qno++;
		checker();
		for(var i=0;i<formContent.length;i++){
			if(i == qno)
				formContent[i].style.display="flex";
			else
				formContent[i].style.display="none";
		}

		
		
		
	}

	/*Previous function*/
	function prev(){
		qno--;
		checker();
		for(var i=0;i<formContent.length;i++){
			if(i == qno)
				formContent[i].style.display="flex";
			else
				formContent[i].style.display="none";
		}

		
		
		
	}
	/*Alert User*/
	function alertUser(){
		if(totalTime <= 0){
			return true;
		}
		var cnf = confirm("Are you sure you want to submit?");
		return cnf;
	}


}


</script>
	
</body>

</html>