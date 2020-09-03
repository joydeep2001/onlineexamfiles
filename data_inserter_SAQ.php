<?php
	session_start();
	$inputField="";
	$noQ=$_SESSION['noQ_S'];
	for($i=1;$i<=$noQ;$i++){

		$inputField.="<textarea class=ques id=ques".$i." name=ques".$i." rows=4 cols=50></textarea>";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta name='viewport' content='width=device-width,initial-scale=1.0'>
	<title></title>
</head>
<body>
	<form method="POST" action="data_inserter_SAQ_to_db.php">
		<?php
			echo $inputField;
		?>
		<button type="submit">Button</button>
	</form>
</body>
</html>