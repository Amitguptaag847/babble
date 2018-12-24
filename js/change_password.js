function change_password(){
	var form = document.querySelector('#password_form');
	if(form.querySelector('#oldpassword').value === ''){
		alert('Please Enter Old Password');
		return;
	}
	if(form.querySelector('#newpassword').value === ''){
		alert('Please Enter New Password');
		return;
	}
	if(form.querySelector('#confirmpassword').value === ''){
		alert('Please Enter new Password again');
		return;
	}
	if(form.querySelector('#newpassword').value !== form.querySelector('#confirmpassword').value){
		alert('Please Enter Same password');
		return;
	}
	document.querySelector('.conatiner').style.display = 'none';
	document.querySelector('.pre_loader').classList.add('spinner');
	var data = new FormData(form);
	data.append('change_password',true);
	var xhr = new XMLHttpRequest();
	xhr.open('POST','change_password_request.php');
	xhr.onload = function(){
		if(this.status===200){
			if(this.responseText === 'success'){
				form.querySelector('#oldpassword').value = '';
				form.querySelector('#newpassword').value = '';
				form.querySelector('#confirmpassword').value ='';
				document.querySelector('.conatiner').style.display = 'block';
				document.querySelector('.pre_loader').classList.remove('spinner');
				alert('Password Changed Successfully!!');
			} else if(this.responseText === 'passwordNotMatch'){
				document.querySelector('.conatiner').style.display = 'block';
				document.querySelector('.pre_loader').classList.remove('spinner');
				alert('Please Enter Correct Old Password');
			} else {
				document.querySelector('.conatiner').style.display = 'block';
				document.querySelector('.pre_loader').classList.remove('spinner');
				alert('Some Error Occurred');
			}
		}
	}
	xhr.send(data);
}

document.querySelector('#password_form #change_password').addEventListener('click',function(e){
	e.preventDefault();
	change_password();
});

window.onload = function(){
	document.querySelector('.conatiner').style.display = 'block';
	document.querySelector('.pre_loader').classList.remove('spinner');
}

document.querySelector('#aurthorised_application').addEventListener('click',function(e){
	e.preventDefault();
	alert('Coming soon!!!');
});
document.querySelector('#email_and_sms').addEventListener('click',function(e){
	e.preventDefault();
	alert('Coming soon!!!');
});
document.querySelector('#manage_contact').addEventListener('click',function(e){
	e.preventDefault();
	alert('Coming soon!!!');
});
document.querySelector('#privacy_and_security').addEventListener('click',function(e){
	e.preventDefault();
	alert('Coming soon!!!');
});