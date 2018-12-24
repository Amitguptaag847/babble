var search_result_container = document.querySelector('.search_result_container');

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

function clone_search_result_profile(user_id){
	var referance_element =  document.querySelector('#search_result_profile_0');
	var clone_element = referance_element.cloneNode(true);
	clone_element.id = 'search_result_profile-'+user_id;
	return clone_element;
}

function search_users(user_username){
	var param = "searhing=true"+"&search_user_name="+user_username;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','include/nav_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status === 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);
				var data_length = data.length;
				search_result_container.querySelector('#search_result_profile_wrapper_1').innerHTML = '';
				if(data_length > 0){
					for(var i=0;i<data_length;i++){
						var result = clone_search_result_profile(data[i].id);
						result.querySelector('img').src = "image/"+data[i].profile_image;
						result.querySelector('.user_username a').textContent = data[i].username;
						result.querySelector('.user_username a').href = 'profile_check.php?user_id='+data[i].id;;
						result.querySelector('.user_full_name').textContent = data[i].full_name;
						result.querySelector('a').href = 'profile_check.php?user_id='+data[i].id;
						search_result_container.querySelector('#search_result_profile_wrapper_1').appendChild(result);
					}
					search_result_container.style.display = 'block';
				} else {
					var result = clone_search_result_profile(0);
					result.classList.add('justify-content-center');
					result.innerHTML = "<h5>No user Found</h5>";
					search_result_container.querySelector('#search_result_profile_wrapper_1').appendChild(result);
					search_result_container.style.display = 'block';
				}
			}
		}
	};
	xhr.send(param);
}

(function(){
	var param = 'get_user_self_id=true';
	var xhr = new XMLHttpRequest();
	xhr.open('POST','include/nav_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status===200){
			if(!isNaN(this.responseText)){
				document.querySelector('#user_self_profile_link').href = 'profile_check.php?user_id='+this.responseText;
			} else {
				alert('Sorry Some problem Occurred!!!');
			}
		}
	};
	xhr.send(param);
}());

document.querySelector('#explore_link').addEventListener('click',function(e){
	e.preventDefault();
	alert('Coming Soon!!!!!');
});

document.querySelector('#notification_link').addEventListener('click',function(e){
	e.preventDefault();
	alert('Coming Soon!!!!!');
});

var search_user_name = document.querySelector('#search_user');

search_user_name.addEventListener('keydown',function(event){ //Prevent from pressing enter
	if(event.keyCode === 13){
		event.preventDefault();
	}
});

search_user_name.addEventListener('keyup',function(event){
	if(search_user_name.value != ''){
		search_users(search_user_name.value);
	} else {
		search_result_container.style.display = 'none';
	}
}); 	