<?php
	require 'dbh.php';
	#answer sheet 7
	if(1){
    	$sql="SELECT * from exam_details where status_exam='1'";
    	$result=mysqli_query($con,$sql);
    	
    	while($tableNames=mysqli_fetch_assoc($result)){
    	    if($tableNames['class'] == 7){
    	        $table7=$tableNames['exam_name'];
    	    }
    	    else if($tableNames['class'] == 8){
    	        $table8=$tableNames['exam_name'];
    	    }
    	    else if($tableNames['class'] == 9){
    	        $table9=$tableNames['exam_name'];
    	    }
    	    else if($tableNames['class'] == 10){
    	        $table10=$tableNames['exam_name'];
    	    }
    	}
    	
    	$sql="SELECT * FROM $table7 WHERE 1;";
    	
    	$answer7="";
    	$answer8="";
    	$answer9="";
    	$result=mysqli_query($con,$sql);
    	while($result7=mysqli_fetch_assoc($result)){
    		$answer7.="<tr>";
    		$answer7.="<td>".$result7['no']."</td>";
    		
    		$answer7.="<td>".$result7['question']."</td>";
    		//$opt=$result7['correct_opt'];
    		//$opt = strtolower($opt);
    		$opt=$result7['correct_opt'];
    		$opt = strtolower($opt);
    		$answer7.="<td>".$opt." ".$result7[$opt]."</td>";
    		//$answer7.="<td>".$opt.")".$result[$opt]."</td>";
    		$answer7.="</tr>";
    	}
    
    
    	#answer sheet 8
    	$sql="SELECT * FROM $table8 WHERE 1;";
    	$result=mysqli_query($con,$sql);
    	
    	while($result8=mysqli_fetch_assoc($result)){
    		$answer8.="<tr>";
    		$answer8.="<td>".$result8['no']."</td>";
    		
    		$answer8.="<td>".$result8['question']."</td>";
    		
    		$opt=$result8['correct_opt'];
    		$opt = strtolower($opt);
    		$answer8.="<td>".$opt." ".$result8[$opt]."</td>";
    		
    		$answer8.="</tr>";
    	}
    	#answer sheet 9
    	$sql="SELECT * FROM $table9 WHERE 1;";
    	$result=mysqli_query($con,$sql);
    
    	while($result9=mysqli_fetch_assoc($result)){
    		$answer9.="<tr>";
    		$answer9.="<td>".$result9['no']."</td>";
    		
    		$answer9.="<td>".$result9['question']."</td>";
    		
    		$opt=$result9['correct_opt'];
    		$opt = strtolower($opt);
    		$answer9.="<td>".$opt." ".$result9[$opt]."</td>";
    		
    		$answer9.="</tr>";
    	}
    	$sql="SELECT * FROM $table10 WHERE 1;";
    	$result=mysqli_query($con,$sql);
    	while($result10=mysqli_fetch_assoc($result)){
    		$answer10.="<tr>";
    		$answer10.="<td>".$result10['no']."</td>";
    		
    		$answer10.="<td>".$result10['question']."</td>";
    		
    		$opt=$result10['correct_opt'];
    		$opt = strtolower($opt);
    		$answer10.="<td>".$opt." ".$result10[$opt]."</td>";
    		
    		$answer10.="</tr>";
    	}
	}
	else{
	    echo "Answers Will be available Soon";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="result_style.css">
	<meta name='viewport' content='width=device-width,initial-scale=1.0'>
</head>
<body>
    <h1 style="background-color:#000;color:#fff;padding:30px;margin-top:0px;">Choose Your Class</h1>
	<h1 class=anspgh1 onclick="show7()">CLASS 7 <img src=down.png class=anspgh1img></h1>
	<table class=anspg>
		<tr>
			<th>
				Sl.
			</th>
			<th>
				Question
			</th>
			<th>
				Answer
			</th>
		</tr>
		<?php
			echo $answer7;
		 ?>
	</table>
	<h1 class=anspgh1 onclick="show8()">CLASS 8 <img src=down.png class=anspgh1img></h1>
	<table class=anspg>
		<tr>
			<th>
				Sl.
			</th>
			<th>
				Question
			</th>
			<th>
				Answer
			</th>
		</tr>
		<?php
			echo $answer8;
		 ?>
	</table>
	<h1 class=anspgh1 onclick="show9()">CLASS 9 <img src=down.png class=anspgh1img></h1>
	<table class=anspg>
		<tr>
			<th>
				Sl.
			</th>
			<th>
				Question
			</th>
			<th>
				Answer
			</th>
		</tr>
		<?php
			echo $answer9;
		 ?>
	</table>
	<h1 class=anspgh1 onclick="show10()">CLASS 10 <img src=down.png class=anspgh1img></h1>
	<table class=anspg>
		<tr>
			<th>
				Sl.
			</th>
			<th>
				Question
			</th>
			<th>
				Answer
			</th>
		</tr>
		<?php
			echo $answer10;
		 ?>
	</table>
	End of the List<hr style="width:3px solid red;">
	<script type="text/javascript">
	    var expander=document.getElementsByClassName('anspg');
		var row=document.getElementsByTagName('tr');
		var col=document.getElementsByTagName('td');
		var image=document.getElementsByClassName('anspgh1img');
		var click7=0,click8=0,click9=0,click10=0;
		function show7(){
		    if(click7==0){
		        expander[0].style.display="block";
		        image[0].style.transform="rotate(180deg)";
		        click7=1;
		        window.scrollBy(0, 300);
		        console.log("1");
		    }else{
		        expander[0].style.display=null;
		        image[0].style.transform=null;
		        click7=0;
		    }
		}
		function show8(){
		    if(click8==0){
		        expander[1].style.display="block";
		        image[1].style.transform="rotate(180deg)";
		        click8=1;
		    }else{
		        expander[1].style.display=null;
		        image[1].style.transform=null;
		        click8=0;
		    }
		}
		function show9(){
		    if(click9==0){
		        expander[2].style.display="block";
		        image[2].style.transform="rotate(180deg)";
		        click9=1;
		    }else{
		        expander[2].style.display=null;
		        image[2].style.transform=null;
		        click9=0;
		    }
		}
		function show10(){
		    if(click10==0){
		        expander[3].style.display="block";
		        image[3].style.transform="rotate(180deg)";
		        click10=1;
		        window.scrollBy(0,300);
		    }else{
		        expander[3].style.display=null;
		        image[3].style.transform=null;
		        click10=0;
		    }
		}
	
		for(i=1;i<row.length;i++){
			if(i%2 == 0)
				row[i].style.backgroundColor = "#dbc1bf";
			else
				row[i].style.backgroundColor = "#f5e9e9";
		}
	</script>
</body>
</html>