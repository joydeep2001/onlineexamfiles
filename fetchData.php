<?php
require "dbh.php";
	if(isset($_POST['submit'])){
		$roll = $_POST['roll'];
		$class = $_POST['class'];
		$sec = $_POST['sec'];



		$sql="SELECT * FROM tempdetails where 1;";
		$result = mysqli_query($con,$sql);

		$row=mysqli_fetch_assoc($result);
		$image=explode(",", $row['files']);
		//print_r($image);		#debug purpose
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Result Viewer</title>
	<meta name='viewport' content='width=device-width,initial-scale=1.0'>
	<style type="text/css">
		img{
			height:490px;
			width:290px;
		}
		#imageViewer{
			height:490px;
			width:360px;
			display:flex;
			justify-content:center;
			background-color:#000; 
			overflow:hidden;

		}
		#preloader{
			height:490px;
			width:360px;
			display:flex;
			position:absolute;
			background-color:white;
			padding-left:3px;
			align-items:center;
			flex-direction:column;
			
		}
		.preloader-gif{
			height:200px;
			width:200px;

		}
	</style>
	<script type="text/javascript">
		window.addEventListener("load",function(){
			document.getElementById('preloader').style.display="none";
		});
	</script>
</head>
<body onload="changeImage()">
	<div id=studentDetail>
		<h1>Name <?php echo $row['name']?></h1>
		<h2>Class <?php echo $row['class']?></h2>
		<h2>Section <?php echo $row['sec']?></h3>
		<h2>Roll <?php echo $row['roll']?></h3>
	</div>
	<div id=examDetail>
		<div id=rank></div>
		<div id=marks>
			<?php 
				echo"<h1>Your Marks is: ".$row['marks']."</h1>";
			?>
		</div>
		<div id="nav">
			<button onclick="decrease()">Previous</button>
			<button onclick="increase()">Next</button>
		</div>
		<div id=imageViewer>
			<div id=preloader><h1>Loading your exam sheets....</h1>
				<img src="loading.gif" class="preloader-gif">
			</div>
			<?php
				for($i=0;$i<count($image);$i++){
					echo "<img src=uploads/".$image[$i]." class=examsheet>";
				}
			?>
		</div>
	</div>

</body>
<script type="text/javascript">
	var i=0;
	var pos=0;
	var images = document.getElementsByClassName('examsheet');

	function changeImage(){
		for(i=0;i<images.length;i++){
			if(i!=pos)
				images[i].style.display="none";
			else
				images[i].style.display=null;
		}
	} 
	function increase(){
		if(pos < images.length-1)
		pos++;
		changeImage();
	}
	function decrease(){
		if(pos > 0)
		pos--;
		changeImage();
	}
</script>
</html>