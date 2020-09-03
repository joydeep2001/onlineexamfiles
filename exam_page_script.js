var formContent = document.getElementsByClassName('formCont');
var submitButton = document.getElementById('subBtn');
var nextBtn = document.getElementById('nextBtn');
var prevBtn = document.getElementById('prevBtn');
var msg = document.getElementById('msg');
var qno=1;
var pos=0;
var maximumHeight = (formContent.length-1)*103;



/*Checker function*/
function checker(){			
	msg.innerHTML =qno+" of "+formContent.length+" questions";
	if(pos == 0){
		prevBtn.disabled=true;
		prevBtn.style.background="grey";
	}
	else{
		prevBtn.disabled=false;
		prevBtn.style.background="#0f46e2";
	}
	if(pos <= maximumHeight*(-1)){
		nextBtn.disabled=true;
		nextBtn.style.background="grey";
	}
	else{
		nextBtn.disabled=false;
		nextBtn.style.background="#0f46e2";
	}
	if(qno == formContent.length){
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
	 	submitButton.click();
	 }

}


/*Next function*/

function next(){
	
	pos-=103;
	for(var i=0;i<formContent.length;i++){
		formContent[i].style.transform="translateY("+pos+"%)";
	}
	qno++;
	checker();
	
}

/*Previous function*/
function prev(){
	
	pos+=103;
	for(var i=0;i<formContent.length;i++){
		formContent[i].style.transform="translateY("+pos+"%)";
	}
	qno--;
	checker();
}
/*Alert User*/
function alertUser(){
	if(totalTime <= 0){
		return true;
	}
	var cnf = confirm("Are you sure you want to submit?");
	return cnf;
}


