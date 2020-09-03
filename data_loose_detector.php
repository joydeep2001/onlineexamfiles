<?php
	if(isset($_GET['sub'])){
		$sql="SELECT DISTINCT roll From student_detail WHERE section='A' order by roll asc;";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="GET" action="data_loose_detector.php">
		<select id=std name=class>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select>
		<button type="submit" name="sub">Detect</button>
	</form>
</body>
</html>