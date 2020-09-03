<?php
	session_start();
	
	$class = $_SESSION['class_S'];
	$noQ = $_SESSION['noQ_S'];

	$tableName=$_SESSION['tableName_S'];
	$i=1;
	$elements="";
	
	

	for($i=1;$i<=$noQ;$i++){
		$question_cont="<div id=question_cont><div id=question_num>".$i."</div><textarea name=q".$i."></textarea></div>";

		$answer_cont="<div id=answer_cont><div id=ans>Ans</div><div class=opt><div class=opt_no>A</div><input type=text name=A_".$i." class=inputs2></div><div class=opt><div class=opt_no>B</div><input type=text name=B_".$i." class=inputs2></div><div class=opt><div class=opt_no>C</div><input type=text name=C_".$i." class=inputs2></div><div class=opt><div class=opt_no>D</div><input type=text name=D_".$i." class=inputs2></div></div>";

	$selector_cont="<div id=selector_cont><div class=core_cont><input type=radio name=cAns_".$i." value=A></div><div class=core_cont><input type=radio name=cAns_".$i."  value=B></div><div class=core_cont><input type=radio name=cAns_".$i."  value=C></div><div class=core_cont><input type=radio name=cAns_".$i."  value=D></div></div>";

	$elements.=$question_cont.$answer_cont.$selector_cont;
	}



	
?>
<!DOCTYPE html>
<html>
<head>
	<meta name='viewport' content='width=device-width,initial-scale=1.0'>
	<title></title>
	<link rel="stylesheet" type="text/css" href="admin_end_stylesheet.css">

</head>
<body>
	<header>
		<div id=logo></div>
		<div id=heading><h1>SMART MANAGER</h1></div>
	</header>
	<div id=subheading><p>Create An Exam</p></div>
	<form method="POST" action='data_inserter_MCQ._to_db.php'>
		<?php
			echo $elements;
		?>
		<button type='submit' name="submit">Proceed</button>
	</form>
</body>
</html>