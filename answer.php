<?php
	require 'dbh.php';
	#answer sheet 7
	$sql="SELECT * FROM class_7_1 WHERE 1";
	
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
	$sql="SELECT * FROM class_8_1 WHERE 1";
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
	$sql="SELECT * FROM class_9_1 WHERE 1";
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

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="result_style.css">
	<meta name='viewport' content='width=device-width,initial-scale=1.0'>
</head>
<body>
	<h1>CLASS 7</h1>
	<table>
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
	<h1>CLASS 8</h1>
	<table>
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
	<h1>CLASS 9</h1>
	<table>
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
	<script type="text/javascript">
		var row=document.getElementsByTagName('tr');
		var col=document.getElementsByTagName('td');
		
		for(i=1;i<row.length;i++){
			if(i%2 == 0)
				row[i].style.backgroundColor = "#dbc1bf";
			else
				row[i].style.backgroundColor = "#f5e9e9";
		}
	</script>
</body>
</html>