function isJson(str){
	try{
		str = JSON.parse(str);
	} catch (e) {
		return false;
	}
	if(typeof str === "object" && str !== null){

		return true;
	}
	return false;
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validatePhonenumber(number) {
	var re = /^\d{10}$/;
	return re.test(number);
}

function upload_profile_photo(){
	var photoFile =  new FormData();
	document.querySelector('#cancel_modal').click();
	var file = document.querySelector('.upload_profile_photo input').files[0];
	if(file.value !== ''){
		document.querySelector('.conatiner').style.display = 'none';
		document.querySelector('.pre_loader').classList.add('spinner');
		photoFile.append('profilephoto',file,file.name);
		photoFile.append('upload_profile_photo',true);
		var xhr = new XMLHttpRequest();
		xhr.open('POST','edit_profile_request.php',true);
		xhr.onload = function(){
			if(this.status === 200){
				if(this.responseText === 'success'){
					load_user_info();
					document.querySelector('.conatiner').style.display = 'block';
					document.querySelector('.pre_loader').classList.remove('spinner');
				} else {
					document.querySelector('.conatiner').style.display = 'block';
					document.querySelector('.pre_loader').classList.remove('spinner');
					alert('Sorry Some problem occurred');
				}
			}
		}
		xhr.send(photoFile);
	}
}

function remove_photo(){
	var param = 'remove_photo=true';
	document.querySelector('#cancel_modal').click();
	document.querySelector('.conatiner').style.display = 'none';
	document.querySelector('.pre_loader').classList.add('spinner');
	var xhr = new XMLHttpRequest();
	xhr.open('POST','edit_profile_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status === 200){
			if(this.responseText === 'success'){
				load_user_info();
				document.querySelector('.conatiner').style.display = 'block';
				document.querySelector('.pre_loader').classList.remove('spinner');
			} else {
				document.querySelector('.conatiner').style.display = 'block';
				document.querySelector('.pre_loader').classList.remove('spinner');
				alert('Sorry Some problem occurred');
			}
		}
	}
	xhr.send(param);
}

function load_user_info(){
	var param = 'load_user_info=true';
	var xhr = new XMLHttpRequest();
	xhr.open('POST','edit_profile_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function (){
		if(this.status === 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);
				document.querySelector('.profile_image_wrapper img').src = 'image/'+data.profileimage;
				document.querySelector('.displayed_username').textContent = data.username;
				document.querySelector('#name').value = data.fullname;
				document.querySelector('#username').value = data.username;
				document.querySelector('#website').value = data.website;
				document.querySelector('#user_bio').textContent = data.bio;
				document.querySelector('#email').value = data.email;
				document.querySelector('#phonenumber').value = data.phonenumber;
				if(data.gender === ''){
					document.querySelector('#gender').value = 'not_specified';
				} else {
					document.querySelector('#gender').value = data.gender;
				}
			} else {
				window.location.href = 'index.php';
			}
		}
	}
	xhr.send(param);
}

function update_profile_info(){
	var form = document.querySelector('#info_form');
	if(form.querySelector('#username').value === ''){
		alert('Username cant be empty');
		return;
	}
	if(form.querySelector('#phonenumber').value === ''){
		if(form.querySelector('#email').value === ''){
			alert('Please Enter Phonenumber or Email');
			return;
		} else {
			if(!validateEmail(form.querySelector('#email').value)){
				alert('Please Enetr valid email');
				return;
			}
		}
	} else {
		if(!validatePhonenumber(form.querySelector('#phonenumber').value)){
			alert('Please Enter proper phonenumber');
			return;
		}
		if(form.querySelector('#email').value !== ''){
			if(!validateEmail(form.querySelector('#email').value)){
				alert('Please Enetr valid email');
				return;
			}
		}
	}
	document.querySelector('.conatiner').style.display = 'none';
	document.querySelector('.pre_loader').classList.add('spinner');
	var data = new FormData(form);
	data.append('submit_user_info',true);
	var xhr = new XMLHttpRequest();
	xhr.open('POST','edit_profile_request.php');
	xhr.onload = function(){
		if(this.status===200){
			if(this.responseText === 'success'){
				load_user_info();
				document.querySelector('.conatiner').style.display = 'block';
				document.querySelector('.pre_loader').classList.remove('spinner');
			} else {
				alert('Sorry Some problem occurred');
				document.querySelector('.conatiner').style.display = 'block';
				document.querySelector('.pre_loader').classList.remove('spinner');
			}
		}
	}
	xhr.send(data);
}

document.querySelector('#submit_user_info').addEventListener('click',function(e){
	e.preventDefault();
	update_profile_info();
});

document.querySelector('.upload_profile_photo input').addEventListener('change',upload_profile_photo);

document.querySelector('#remove_photo').addEventListener('click',function(e){
	e.preventDefault();
	remove_photo();
});

window.onload = function(){
	load_user_info();
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