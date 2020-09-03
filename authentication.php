<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name='viewport' content='width=device-width,initial-scale=1.0'>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="front_end_stylesheet.css">
	<link href="https://fonts.googleapis.com/css2?family=Galada&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<div id=logo></div>
		<div id=heading>
			
			<h1>
				Chemistry Zone
			</h1>
		</div>	
	</header>
	<form method="POST" action="authenticationtoDb.php" onsubmit= "return validate()" id=form1>
		<input type="text" name="name" id="name" class="input1" placeholder="Your Name">
		<input type="text" name="roll" id="roll" class="input2" placeholder="Roll no.">
		<select name='class' id="class">
			<option value='0'>Select Class</option>
			<option value='7'>7</option>
			<option value='8'>8</option>
			<option value='9'>9</option>
			<option value='10'>10</option>
		</select>
		<select name='sec' id="sec">
			<option value='0'>Select Section</option>
			<option value='A'>A</option>
			<option value='B'>B</option>
			<option value='C'>C</option>
			<option value='D'>D</option>
		</select>
		<button type=submit name=submit class=btn2>Proceed</button>
	</form>
	<script type="text/javascript">
		var roll=document.getElementById('roll');
		var sutudentName=document.getElementById('name');
		var std=document.getElementById('class');
		var sec=document.getElementById('sec');
		function validate(){
			if(roll.value.trim() == ""){
				alert('Enter Your Roll Number');
				return false;
			}
			else if(sutudentName.value.trim() == ""){
				alert('Enter Your Name');
				return false;
			}
			else if(std.value == 0){
				alert('Enter Your Class');
				return false;
			}
			else if(sec.value == 0){
				alert('Enter Your Section');
				return false;
			}
			else{
				return true;
			}
		}
	</script>
	
</body>
</html>