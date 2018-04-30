$(function(){

	$("#signup").hide();
	$("#loginlink").click(function(){
		$("#signup").hide();
		$("#login").show();
	});
	$("#signuplink").click(function(){
		$("#login").hide();
		$("#signup").show();
	});
});

var flag1 = false, flag2 = false, flag3 = false, flag4 = false;

function judgeName(obj){

	var name = obj.value.trim();
	if(name == obj.defaultValue){
		return;
	}
	if(name.length == 0){
		obj.value = obj.defaultValue;
		flag1 = false;
	}
	else{
		flag1 = true;
	}
}
function clearName(obj){

	if(!flag1){
		obj.value = '';
	}
}
function judgeEmail(obj){

	var email = obj.value.trim();
	var valid=/^[a-zA-Z0-9_-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/;
	if(email == obj.defaultValue){
		return;
	}
	if(email.length == 0){
		obj.value = obj.defaultValue;
		flag2 = false;
	}
	else if(!valid.test(email) && email.length != 0){
		obj.value = "Wrong email format!"
		obj.style.color = 'red';
		flag2 = false;
	}		
	else{
		flag2 = true;
	}
}
function clearEmail(obj){

	if(!flag2){
		obj.value = '';
		obj.style.color = 'rgb(1, 152, 216)';
	}
}
function judgePW(obj){

	var password = obj.value.trim();
	if(password == obj.defaultValue){
		return;
	}
	if(password.length == 0){
		obj.value = obj.defaultValue;
		flag3 = false;
		obj.type = "text";
	}
	else{
		flag3 = true;
		obj.type = "password";
	}
}
function clearPW(obj){

	if(!flag3){
		obj.value = '';
		obj.type = "password";
	}
}

function judgePWA(obj){

	var passwordagain = obj.value.trim();
	var pwd = $('#password').val();
	if(passwordagain == obj.defaultValue){
		return;
	}
	if(passwordagain.length == 0){
		obj.value = obj.defaultValue;
		flag4 = false;
		obj.type = "text";
		obj.style.color = 'rgb(1, 152, 216)';
	}
	else if(passwordagain != pwd){
		if(passwordagain == "Set password first!"){
			flag4 = false;
		}
		else{
			obj.value = "Two passwords are DIFFERENT!";
			obj.style.color = 'red';
			obj.type = "text";
			flag4 = false;
		}
	}
	else{
		flag4 = true;
		obj.type = "password";
	}
}
function clearPWA(obj){

	if(!flag3){
		obj.value = "Set password first!";
		obj.style.color = 'red';
		flag4 = false;
		obj.type = "text";
		return;
	}
	if(!flag4){
		obj.value = '';
		obj.style.color = 'rgb(1, 152, 216)';
		obj.type = "password";
	}
}
function clearloginName(obj){

	var name = obj.value.trim();
	if(name == obj.defaultValue){
		obj.value = '';
	}
}
function clearloginPW(obj){

	var password = obj.value.trim();
	if(password == obj.defaultValue){
		obj.value = '';
		obj.type = "password";
	}
}
function showdefaultValue(obj){

	var myValue = obj.value.trim();
	if(myValue.length == 0){
		obj.value = obj.defaultValue;
		obj.type = "text";
	}
}



