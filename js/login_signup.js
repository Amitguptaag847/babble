signup_errors//.textContent Form Animation 

var signup_container = document.querySelector('.custom_signup_container');
var login_container = document.querySelector('.custom_login_container');

var change_to_login_button = document.querySelector('.change_to_login');
var change_to_signup_button = document.querySelector('.change_to_signup');

var signup_input_fields = document.querySelectorAll('.custom_signup_container .custom_input');
var login_input_fields = document.querySelectorAll('.custom_login_container .custom_input');

var signup_errors = document.querySelector('.signup_errors');
var login_errors = document.querySelector('.login_errors');

var signup_btn = document.querySelector('.signup_btn');
var login_btn = document.querySelector('.login_btn');

document.querySelector('.main .login_signup_page').style.display = 'none';
document.querySelector('.preloader').classList.add('spinner-1');

window.onload = function(){
	document.querySelector('.main .login_signup_page').style.display = 'block';
	document.querySelector('.preloader').classList.remove('spinner-1');

	var i = 0;
	for (i = 0; i < signup_input_fields.length ; i++){
		signup_input_fields[i].setAttribute('tabindex',i+1);
	}
	document.querySelector('.custom_signup_container .signup_btn').setAttribute('tabindex',i+1);
	document.querySelector('.custom_signup_container button').setAttribute('tabindex',i+2);

	document.querySelector('.custom_login_container button').setAttribute('tabindex','-1');
	for (i = 0; i < login_input_fields.length ; i++){
		login_input_fields[i].setAttribute('tabindex','-1');
		console.log(login_input_fields[i]);
	}
	document.querySelector('.custom_login_container .login_btn').setAttribute('tabindex','-1');
}

change_to_login_button.addEventListener('click',function(e){
	e.preventDefault();
	signup_container.style.transform = 'translateY(-324px)';
	login_container.style.transform = 'translateY(-324px)';
	document.querySelector('.custom_form_container').style.height = '210px';
	document.querySelector('.signup_terms').style.display = 'none';
	signup_errors.style.display = 'none';
	signup_errors.textContent = '';
	emailOrPhonenumberCorrect = false; //Declared later
	usernameCorrect = false;	//Declared later
	passwordCorrect = false;	//Declared later
	
	document.querySelector('.forgot_password').style.display = 'block';

	document.querySelector('.custom_signup_container button').setAttribute('tabindex',-1);
	document.querySelector('.custom_signup_container .signup_btn').setAttribute('tabindex',-1);
	for (var i = 0; i < signup_input_fields.length ; i++){
		signup_input_fields[i].value = '';
		signup_input_fields[i].setAttribute('tabindex',-1);
		document.querySelectorAll('.custom_signup_container .wrong_input')[i].style.display = 'none';
		document.querySelectorAll('.custom_signup_container .right_input')[i].style.display = 'none';
	}
	var i = 0;
	document.querySelector('.custom_login_container button').setAttribute('tabindex',1);
	for (i=0 ; i < login_input_fields.length ; i++){
		login_input_fields[i].setAttribute('tabindex',i+2);
	}
	document.querySelector('.custom_login_container .login_btn').setAttribute('tabindex',i+2);
});

change_to_signup_button.addEventListener('click',function(e){
	e.preventDefault();
	signup_container.style.transform = 'translateY(0)';
	login_container.style.transform = 'translateY(0)';
	document.querySelector('.custom_form_container').style.height = '310px';
	document.querySelector('.signup_terms').style.display = 'block';
	login_errors.style.display = 'none';
	login_errors.textContent = '';
	
	document.querySelector('.forgot_password').style.display = 'none';

	document.querySelector('.custom_login_container button').setAttribute('tabindex',-1);
	for (var i = 0; i < login_input_fields.length ; i++){
		login_input_fields[i].value = '';
		login_input_fields[i].setAttribute('tabindex','-1');
	}
	document.querySelector('.custom_login_container .login_btn').setAttribute('tabindex',-1);

	var i=0;
	for (i = 0; i < signup_input_fields.length ; i++){
		signup_input_fields[i].setAttribute('tabindex',i+1);
	}
	document.querySelector('.custom_signup_container .signup_btn').setAttribute('tabindex',i+1);
	document.querySelector('.custom_signup_container button').setAttribute('tabindex',i+2);

});


//Ajax backend

//Signup Form Validation

var emailOrPhonenumberCorrect = false;
var usernameCorrect = false;
var passwordCorrect = false;

/*Email and Phone Number Validation*/

function emailOrPhonenumberCheckResponse(response){
	emailOrPhonenumberCorrect = response;
}

function emailOrPhonenumberCheckCall(){
	emailOrPhonenumberCheck(emailOrPhonenumberCheckResponse);
}

signup_input_fields[0].addEventListener('keyup',emailOrPhonenumberCheckCall);

function emailOrPhonenumberCheck(callback){
	var value = signup_input_fields[0].value;
	if(value !== ''){
		var param = 'signupEmailPhonenumberValidate='+value;
		var xhr = new XMLHttpRequest();
		xhr.open('POST','login_signup_validate.php',true);
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		xhr.onload = function(){
			if(this.status == 200){
				if(this.responseText == 1){
					document.querySelectorAll('.custom_signup_container .wrong_input')[0].style.display = 'none';
					document.querySelectorAll('.custom_signup_container .right_input')[0].style.display = 'block';
					callback(true);
				} else {
					document.querySelectorAll('.custom_signup_container .right_input')[0].style.display = 'none';
					document.querySelectorAll('.custom_signup_container .wrong_input')[0].style.display = 'block';
					callback(false);
				}
			}
		}
		xhr.send(param);
	} else {
		document.querySelectorAll('.custom_signup_container .right_input')[0].style.display = 'none';
		document.querySelectorAll('.custom_signup_container .wrong_input')[0].style.display = 'block';
		callback(false);
	}
}


/*Name Validation*/


function usernameCheckResponse(response){
	usernameCorrect = response;
}

function usernameCheckCall(){
	usernameCheck(usernameCheckResponse);
}

signup_input_fields[2].addEventListener('keyup',usernameCheckCall);

function usernameCheck(callback){
	var value = signup_input_fields[2].value;
	if(value!=''){
		var param = 'usernameValidate='+value;
		var xhr = new XMLHttpRequest();
		xhr.open('POST','login_signup_validate.php',true);
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		xhr.onload = function(){
			if(this.status == 200){
				if(this.responseText == 1){
					document.querySelectorAll('.custom_signup_container .wrong_input')[2].style.display = 'none';
					document.querySelectorAll('.custom_signup_container .right_input')[2].style.display = 'block';
					callback(true);
				} else {
					document.querySelectorAll('.custom_signup_container .right_input')[2].style.display = 'none';
					document.querySelectorAll('.custom_signup_container .wrong_input')[2].style.display = 'block';
					callback(false);
				}
			}
		}
		xhr.send(param);
	} else {
		document.querySelectorAll('.custom_signup_container .right_input')[2].style.display = 'none';
		document.querySelectorAll('.custom_signup_container .wrong_input')[2].style.display = 'block';
		callback(false);
	}
}

/*Password Validation*/

function passwrodCheckResponse(response){
	passwordCorrect = response;
}

function passwordCheckCall(){
	passwordCheck(passwrodCheckResponse);
}

signup_input_fields[3].addEventListener('keyup',passwordCheckCall);

function passwordCheck(callback){
	var value = signup_input_fields[3].value;
	if(value!=''){
		var param = 'passwordValidate='+encodeURIComponent(value);
		var xhr = new XMLHttpRequest();
		xhr.open('POST','login_signup_validate.php',true);
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		xhr.onload = function(){
			if(this.status == 200){
				if(this.responseText == 1){
					document.querySelectorAll('.custom_signup_container .wrong_input')[3].style.display = 'none';
					document.querySelectorAll('.custom_signup_container .right_input')[3].style.display = 'block';
					callback(true);
				} else {
					document.querySelectorAll('.custom_signup_container .right_input')[3].style.display = 'none';
					document.querySelectorAll('.custom_signup_container .wrong_input')[3].style.display = 'block';
					callback(false);
				}
			}
		}
		xhr.send(param);
	} else {
		document.querySelectorAll('.custom_signup_container .right_input')[3].style.display = 'none';
		document.querySelectorAll('.custom_signup_container .wrong_input')[3].style.display = 'block';
		callback(false);
	}
}

/*Signup Check*/

signup_btn.addEventListener('click',function(e){
	e.preventDefault();
	if(passwordCorrect != false && usernameCorrect != false && emailOrPhonenumberCorrect != false){
		var emailOrPhonenumber = signup_input_fields[0].value;
		var fullname = signup_input_fields[1].value;
		var username = signup_input_fields[2].value;
		var password = signup_input_fields[3].value;
		signup_errors.style.display = 'none';
		var param = "signup=true"+"&emailOrPhonenumber="+encodeURIComponent(emailOrPhonenumber)+"&fullname="+encodeURIComponent(fullname)+"&username="+encodeURIComponent(username)+"&password="+encodeURIComponent(password);
		console.log(param);
		var xhr = new XMLHttpRequest();
		xhr.open('POST','login_signup_validate.php',true);
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		xhr.onload = function(){
			if(this.status == 200){
				console.log(this.responseText);
				if(this.responseText == 1){
					window.location.href = '../index.php';
				}
			}
		}
		xhr.send(param);
	} else {
		signup_errors.textContent = "Required Fields must be filled in correct form";
		signup_errors.style.display = 'block';
	}
});


/*Login Checking*/

function login_check(){
	var usernameOrEmailOrPhonenumber = login_input_fields[0].value;
	var password = login_input_fields[1].value;
	if(usernameOrEmailOrPhonenumber!='' && password!=''){
		var param = "login=true"+"&usernameOrEmailOrPhonenumber="+encodeURIComponent(usernameOrEmailOrPhonenumber)+"&loginpassword="+encodeURIComponent(password);
		var xhr = new XMLHttpRequest();
		xhr.open('POST','login_signup_validate.php',true);
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		xhr.onload = function(){
			if(this.status ==200){
				if(this.responseText == 1){
					window.location.href = '../index.php';
				} else {
					login_errors.textContent = this.responseText;
					login_errors.style.display = 'block';
				}
			}
		}
		xhr.send(param);
	} else {
		login_errors.textContent = "Please fill the fields";
		login_errors.style.display = 'block';
	}
}

login_container.querySelector('form').addEventListener('keydown',function(e){
	if(e.keyCode === 13){
		e.preventDefault();
		login_check();
	}
},false);

login_container.querySelector('form').addEventListener('keyup',function(e){
	if(e.keyCode === 13){
		e.preventDefault();
	}
},false);

login_btn.addEventListener('click',function(e){
	e.preventDefault();
	login_check();
});