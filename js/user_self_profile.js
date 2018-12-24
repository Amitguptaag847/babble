var profile_details_container = document.querySelector('.profile_details_container');
var loaded_user_self_post = true;
var loaded_user_saved_post = false;
var uploadType = 'none';
var photoFiles = new FormData();
var videoFiles = new FormData();

function isJson(data){
	try{
		data = JSON.parse(data);
		return true;
	} catch(e){
		return false;
	}
}

function clonePostTemplate(post_id){
	var referenceElement = document.querySelector('#template0');
	var cloneElement =  referenceElement.cloneNode(true);
	cloneElement.id = 'self_post_template-'+post_id;
	return cloneElement;
}

function cloneAddedPhotoPreview(added_photo_id){
	var referenceElement = document.querySelector('#added_photo-0');
	var cloneElement = referenceElement.cloneNode(true);
	cloneElement.id = 'added_photo-'+added_photo_id;
	return cloneElement;
}

function cloneAddedVideoPreview(added_video_id){
	var referenceElement = document.querySelector('#added_video-0');
	var cloneElement = referenceElement.cloneNode(true);
	cloneElement.id = 'added_video-'+added_video_id;
	return cloneElement;
}

function load_user_data(){
	var param = "load_user_data=true";
	var xhr = new XMLHttpRequest();
	xhr.open('POST','user_self_profile_request.php',true)
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status==200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);
				profile_details_container.querySelector('.profile_picture_wrapper img').src = 'image/'+data.profileimage;
				profile_details_container.querySelector('.user_self_username').textContent = data.username;
				profile_details_container.querySelector('.posts_count').textContent = data.no_of_posts+' ';
				profile_details_container.querySelector('.followings_count').textContent = data.no_of_following+' ';
				profile_details_container.querySelector('.followers_count').textContent = data.no_of_follower+' ';
				profile_details_container.querySelector('.users_name_container p').textContent = data.fullname;
				profile_details_container.querySelector('.users_bio_container p').textContent = data.bio;
				profile_details_container.querySelector('.users_wesite_container p').textContent = data.website;
				profile_details_container.querySelector('.users_wesite_container a').href = data.website;
			} else {
				console.log(this.responseText);
				//window.location.href = 'index.php';
			}
		}
	}
	xhr.send(param);
}

function load_user_self_post_template(){
	var param = 'load_user_self_post_template=true';
	var xhr = new XMLHttpRequest();
	xhr.open('POST','user_self_profile_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status == 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);
				if(data.length === 0){
					document.querySelector('#self_posts_template_container').innerHTML = '<h2>No post has been added</h2>';
					document.querySelector('#self_posts_template_container h2').style.color = '#ff3a89';
					document.querySelector('#self_posts_template_container h2').style.margin = '50px auto';
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
						document.querySelector('#self_posts_template_container').appendChild(post_template);
					}
				}
			}
		}
	}
	xhr.send(param);
}

function load_user_saved_post_template(){
	var param = 'load_user_saved_post_template=true';
	var xhr = new XMLHttpRequest();
	xhr.open('POST','user_self_profile_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status == 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);
				console.log(data);
				if(data.length === 0){
					document.querySelector('#saved_posts_template_container').innerHTML = '<h2>No post has been saved</h2>';
					document.querySelector('#saved_posts_template_container h2').style.color = '#ff3a89';
					document.querySelector('#saved_posts_template_container h2').style.margin = '50px auto';
				} else {
					for(var i=0; i<data.length ;i++){
						var post_template = clonePostTemplate(data[i].id);
						post_template.querySelector('#likes_count').innerText = data[i].no_of_likes;
						post_template.querySelector('#comments_count').innerText = data[i].no_of_likes;
						if(data[i].post_type === 'video'){
							post_template.querySelector('.posts_type_multi_pic').classList.add('d-none');
						} else {
							post_template.querySelector('.posts_type_video').classList.add('d-none');
						}
						post_template.querySelector('img').src = 'image/'+data[i].thumbnail;
						document.querySelector('#saved_posts_template_container').appendChild(post_template);
					}
				}
			}
		}
	}
	xhr.send(param);
}


function preview_photos(e){
	files = e.target.files;
	var filesLength = files.length;
	if(filesLength > 4){
		alert('Maximum Four Photos You can upload at time!!');
		filesLength = 4;
	}
	if(filesLength >= 1){
		uploadType = 'photos';
	}
	photoFiles = new FormData();
	document.querySelector('.upload_post_btn').style.opacity = 1;
	document.querySelector('.upload_post_btn').style.pointerEvents = 'auto';
	document.querySelector('.add_video_btn').style.opacity = 0.5;
	document.querySelector('.add_video_btn').style.pointerEvents = 'none';
	document.querySelector('.added_photo_preview').innerHTML = '';
	var fileIndex = 1;
	if(filesLength === 0){
		document.querySelector('.add_video_btn').style.pointerEvents = 'auto';
		document.querySelector('.add_video_btn').style.opacity = 1;
		document.querySelector('.upload_post_btn').style.opacity = 0.5;
		document.querySelector('.upload_post_btn').style.pointerEvents = 'none';
		uploadType = 'none';
		return;
	}
	for(var i=0;i<filesLength;i++){
		var file = files[i];

		if(file.size > 12480000){
			alert('File size must be less than 12 MD');
			photoFiles = new FormData();
			document.querySelector('.add_video_btn').style.pointerEvents = 'auto';
			document.querySelector('.add_video_btn').style.opacity = 1;
			document.querySelector('.upload_post_btn').style.opacity = 0.5;
			document.querySelector('.upload_post_btn').style.pointerEvents = 'none';
			uploadType = 'none';
			return;
		}

		var tempIndex = i+1;
		photoFiles.append('file-'+tempIndex,file,file.name);
		var reader = new FileReader();
		reader.onload = function(e1){
			var added_photo = cloneAddedPhotoPreview(fileIndex++);
			added_photo.querySelector('img').src = e1.target.result;
			added_photo.querySelector('button').addEventListener('click',function(){
				var child = this.parentNode;
				var index = child.id.split('-');
				photoFiles.delete('file-'+index[1]);
				this.parentNode.parentNode.removeChild(added_photo);
				e1.target.value = '';
				childCount = document.querySelector('.added_photo_preview').childElementCount;
				if(childCount === 0){
					document.querySelector('.add_video_btn').style.pointerEvents = 'auto';
					document.querySelector('.add_video_btn').style.opacity = 1;
					document.querySelector('.upload_post_btn').style.opacity = 0.5;
					document.querySelector('.upload_post_btn').style.pointerEvents = 'none';
					uploadType = 'none';
				}
			});
			document.querySelector('.added_photo_preview').appendChild(added_photo);
		};
		reader.readAsDataURL(file);
	}
}

document.querySelector('.add_video_btn input').addEventListener('change',function(){
	var file = this.files[0];
	videoFiles = new FormData();
	document.querySelector('.upload_post_btn').style.opacity = 1;
	document.querySelector('.upload_post_btn').style.pointerEvents = 'auto';
	document.querySelector('.add_photo_btn').style.opacity = 0.5;
	document.querySelector('.add_photo_btn').style.pointerEvents = 'none';
	document.querySelector('.added_video_preview').innerHTML = '';
	uploadType = 'video';

	if(this.value == ''){
		document.querySelector('.added_video_preview').innerHTML = '';
		document.querySelector('.add_photo_btn').style.pointerEvents = 'auto';
		document.querySelector('.add_photo_btn').style.opacity = 1;
		document.querySelector('.upload_post_btn').style.opacity = 0.5;
		document.querySelector('.upload_post_btn').style.pointerEvents = 'none';
		uploadType = 'none';
		return;
	}

	if(file.size > 12480000){
		alert('File size must be less than 12 MB');
		document.querySelector('.added_video_preview').innerHTML = '';
		document.querySelector('.add_photo_btn').style.pointerEvents = 'auto';
		document.querySelector('.add_photo_btn').style.opacity = 1;
		document.querySelector('.upload_post_btn').style.opacity = 0.5;
		document.querySelector('.upload_post_btn').style.pointerEvents = 'none';
		uploadType = 'none';
		return;
	}

	videoFiles.append('video',file,file.name);
	var added_video = cloneAddedVideoPreview(1);
	added_video.querySelector('video').src = window.URL.createObjectURL(file);
	added_video.querySelector('video').load();
	added_video.querySelector('button').addEventListener('click',function(){
		var child = this.parentNode;
		videoFiles.delete('video');
		this.parentNode.parentNode.removeChild(added_video);
		document.querySelector('.add_video_btn input').value = '';
		document.querySelector('.add_photo_btn').style.pointerEvents = 'auto';
		document.querySelector('.add_photo_btn').style.opacity = 1;
		document.querySelector('.upload_post_btn').style.opacity = 0.5;
		document.querySelector('.upload_post_btn').style.pointerEvents = 'none';
		uploadType = 'none';
	});
	document.querySelector('.added_video_preview').appendChild(added_video);
});

document.querySelector('.upload_post_btn').addEventListener('click',function(e){
	e.preventDefault();
	if(uploadType !== 'none'){
		document.querySelector('.conatiner').style.display = 'none';
		document.querySelector('.pre_loader').classList.add('spinner');
		if(uploadType === 'photos'){
			var description = document.querySelector('#description').value;
			photoFiles.append('description',description);
			photoFiles.append('upload_type',uploadType);
			photoFiles.append('upload_post',true);

			var xhr = new XMLHttpRequest();
			xhr.open('POST','user_self_profile_request.php',true);
			xhr.onload = function(){
				if(this.status === 200){
					if(this.responseText == 'success'){
						window.location.href = 'index.php';
					} else {
						document.querySelector('.conatiner').style.display = 'block';
						document.querySelector('.pre_loader').classList.remove('spinner');
						alert('Can\'t upload post');
					}
				}
			};
			xhr.send(photoFiles);
		} else if(uploadType === 'video'){
			var description = document.querySelector('#description').value;
			videoFiles.append('description',description);
			videoFiles.append('upload_type',uploadType);
			videoFiles.append('upload_post',true);

			var xhr = new XMLHttpRequest();
			xhr.open('POST','user_self_profile_request.php',true);
			xhr.onload = function(){
				if(this.status === 200){
					if(this.responseText == 'success'){
						window.location.href = 'index.php';
					} else {
						document.querySelector('.conatiner').style.display = 'block';
						document.querySelector('.pre_loader').classList.remove('spinner');
						alert('Can\'t upload post');
					}
				}
			};
			xhr.send(videoFiles);
		} else {
			document.querySelector('.conatiner').style.display = 'block';
			document.querySelector('.pre_loader').classList.remove('spinner');
			console.log('Unknow upload type');
			return;
		}
	}
});

profile_details_container.querySelector('.logout_btn').addEventListener('click',function(e){
	e.preventDefault();
	window.location.href = 'account/logout.php';
});

document.querySelector('.user_self_posts a').addEventListener('click',function(e){
	e.preventDefault();
	document.querySelector('.user_self_posts a').classList.add('active');
	document.querySelector('.user_posts_saved a').classList.remove('active');
	document.querySelector('.user_add_posts a').classList.remove('active');
	document.querySelector('.user_add_stories a').classList.remove('active');
	document.querySelector('#self_posts_template_container').classList.remove('d-none');
	document.querySelector('#saved_posts_template_container').classList.add('d-none');
	document.querySelector('.add_posts_container div').classList.add('d-none');
	if(!loaded_user_self_post){
		loaded_user_self_post = true;
		load_user_self_post_template();
	}
});

document.querySelector('.user_posts_saved a').addEventListener('click',function(e){
	e.preventDefault();
	document.querySelector('.user_self_posts a').classList.remove('active');
	document.querySelector('.user_posts_saved a').classList.add('active');
	document.querySelector('.user_add_posts a').classList.remove('active');
	document.querySelector('.user_add_stories a').classList.remove('active');
	document.querySelector('#saved_posts_template_container').classList.remove('d-none');
	document.querySelector('#self_posts_template_container').classList.add('d-none');
	document.querySelector('.add_posts_container div').classList.add('d-none');
	if(!loaded_user_saved_post){
		loaded_user_saved_post = true;
		load_user_saved_post_template();
	}
});

document.querySelector('.user_add_posts a').addEventListener('click',function(e){
	e.preventDefault();
	document.querySelector('.user_self_posts a').classList.remove('active');
	document.querySelector('.user_posts_saved a').classList.remove('active');
	document.querySelector('.user_add_posts a').classList.add('active');
	document.querySelector('.user_add_stories a').classList.remove('active');
	document.querySelector('.add_posts_container div').classList.remove('d-none');
	document.querySelector('#self_posts_template_container').classList.add('d-none');
	document.querySelector('#saved_posts_template_container').classList.add('d-none');
});

document.querySelector('.user_add_stories a').addEventListener('click',function(e){
	e.preventDefault();
	document.querySelector('.user_self_posts a').classList.remove('active');
	document.querySelector('.user_posts_saved a').classList.remove('active');
	document.querySelector('.user_add_posts a').classList.remove('active');
	document.querySelector('.user_add_stories a').classList.add('active');
	alert('Will be implemented soon');
});

document.querySelector('.add_photo_btn input').addEventListener('change',preview_photos);
document.querySelector('.conatiner').style.display = 'none';
document.querySelector('.pre_loader').classList.add('spinner');
document.querySelector('.edit_profile_btn').addEventListener('click',function(){
	window.location.href = 'edit_profile.php';
});


window.onload = function(){
	load_user_self_post_template();
	load_user_data();
	document.querySelector('.conatiner').style.display = 'block';
	document.querySelector('.pre_loader').classList.remove('spinner');
}