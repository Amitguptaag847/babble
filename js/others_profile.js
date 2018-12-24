var profile_details_container = document.querySelector('.profile_details_container');
function isJson(data){
	try{
		data = JSON.parse(data);
		return true;
	} catch(e){
		return false;
	}
}

function getUserId(){
	var url_string = window.location.href;
	var url = new URL(url_string);
	var id = url.searchParams.get('user_id');
	return id;
}

function clonePostTemplate(post_id){
	var referenceElement = document.querySelector('#template0');
	var cloneElement =  referenceElement.cloneNode(true);
	cloneElement.id = 'user_post_template-'+post_id;
	return cloneElement;
}

function load_user_data(){
	var param = "load_user_data=true&user_id="+getUserId();
	var xhr = new XMLHttpRequest();
	xhr.open('POST','others_profile_request.php',true)
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status==200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);
				profile_details_container.querySelector('.profile_picture_wrapper img').src = 'image/'+data.profileimage;
				profile_details_container.querySelector('.user_self_username').textContent = data.username;
				if(data.following === true){
					profile_details_container.querySelector('.follow_following_btn').textContent = 'Following';
				} else {
					profile_details_container.querySelector('.follow_following_btn').textContent = 'Follow';
				}
				profile_details_container.querySelector('.posts_count').textContent = data.no_of_posts+' ';
				profile_details_container.querySelector('.followings_count').textContent = data.no_of_following+' ';
				profile_details_container.querySelector('.followers_count').textContent = data.no_of_follower+' ';
				profile_details_container.querySelector('.users_name_container p').textContent = data.fullname;
				profile_details_container.querySelector('.users_bio_container p').textContent = data.bio;
				profile_details_container.querySelector('.users_wesite_container p').textContent = data.website;
				profile_details_container.querySelector('.users_wesite_container a').href = data.website;
				document.querySelector('.conatiner').style.display = 'block';
				document.querySelector('.pre_loader').classList.remove('spinner');
			} else {
				window.location.href = 'index.php';
			}
		}
	};
	xhr.send(param);
}

function load_user_post_template(){
	var param = 'load_user_post_template=true&user_id='+getUserId();
	var xhr = new XMLHttpRequest();
	xhr.open('POST','others_profile_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status == 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);
				if(data.length === 0){
					document.querySelector('#user_posts_template_container').innerHTML = '<h2>No post has been added</h2>';
					document.querySelector('#user_posts_template_container h2').style.color = '#ff3a89';
					document.querySelector('#user_posts_template_container h2').style.margin = '50px auto';
				} else {
					for(var i=0; i<data.length ;i++){
						var post_template = clonePostTemplate(data[i].id);
						post_template.querySelector('#likes_count').innerText = data[i].no_of_likes;
						post_template.querySelector('#comments_count').innerText = data[i].no_of_comments;
						if(data[i].post_type === 'video'){
							post_template.querySelector('.posts_type_multi_pic').classList.add('d-none');
						} else {
							post_template.querySelector('.posts_type_video').classList.add('d-none');
						}
						post_template.querySelector('img').src = 'image/'+data[i].thumbnail;
						document.querySelector('#user_posts_template_container').appendChild(post_template);
					}
				}
			}
		}
	};
	xhr.send(param);
}

function change_follow_following(follow_following_btn){
	var param = 'change_follow_following=true&user_id='+getUserId();
	var xhr = new XMLHttpRequest();
	xhr.open('POST','others_profile_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status === 200){
			if(this.responseText === 'error'){
				alert('Sorry Some Problem Occurred!!!');
			} else {
				profile_details_container.querySelector('.follow_following_btn').textContent = this.responseText;
			}
		}
	};
	xhr.send(param);
}

profile_details_container.querySelector('.follow_following_btn').addEventListener('click',function(){
	change_follow_following(this);
});

window.onload = function(){
	load_user_post_template();
	load_user_data();
}