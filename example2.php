<?php
session_start();
	$name=$_GET['name'];
	echo $name." hello";
	
	if(isset($_GET['class'])){
		echo " your class is ".$_GET['class'];
	}
	$_SESSION['id']=$name;

	

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="get" action="ex3.php">
		<button type="submit">Submit</button>
	</form>
</body>
</html>