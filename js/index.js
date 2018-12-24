
var post_number = 0;
var last_post_id = 0;
var halt_scroll_action = false;
var posts_container = document.querySelector('.posts_container');

document.querySelector('.conatiner').style.display = 'none';
document.querySelector('.pre_loader').classList.add('spinner');

function halt_scroll(data){
	halt_scroll_action = data;
}

window.onload = function(){
	document.querySelector('.conatiner').style.display = 'block';
	document.querySelector('.pre_loader').classList.remove('spinner');
	load_user_self_data();
	loadposts(halt_scroll);
}

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


function timeSince(date) {

  var seconds = Math.floor((new Date() - date) / 1000);

  var interval = Math.floor(seconds / 31536000);

  if (interval >= 1) {
    return interval + " YEARS AGO";
  }
  interval = Math.floor(seconds / 2592000);
  if (interval >= 1) {
    return interval + " MONTHS AGO";
  }
  interval = Math.floor(seconds / 86400);
  if (interval >= 1) {
    return interval + " DAYS AGO";
  }
  interval = Math.floor(seconds / 3600);
  if (interval >= 1) {
    return interval + " HOURS AGO";
  }
  interval = Math.floor(seconds / 60);
  if (interval >= 1) {
    return interval + " MINUTES AGO";
  }
  return Math.floor(seconds) + " SECONDS AGO";
}

function has_class( element, klass ) {
    return (" " + element.className + " " ).indexOf( " "+klass+" " ) > -1;
}

function clonepost(post_id){
	var reference_element = document.querySelector('#post0');
	var clone_element = reference_element.cloneNode(true);
	clone_element.id = "post"+post_id;
	last_post_id = post_id;
	post_number++;
	clone_element.style.display = "block";
	clone_element.querySelector('.images_post').style.display = 'none';
	clone_element.querySelector('.image_post').style.display = 'none';
	clone_element.querySelector('.video_post').style.display = 'none';

	return clone_element;
}

function load_post_user_data(post,post_user_id){
	var param = "post_user_id="+post_user_id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','index_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status == 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);
				post.querySelector('.profile_image_wrapper img').src = 'image/'+data.profileimage;
				post.querySelector('.profile_image_wrapper a').href = 'profile_check.php?user_id='+post_user_id;
				post.querySelector('.user_info_container a').textContent = data.username;
				post.querySelector('.user_info_container a').href = 'profile_check.php?user_id='+post_user_id;
				post.querySelector('.posts_description_container .user_username a').textContent = data.username;
				post.querySelector('.posts_description_container .user_username a').href = 'profile_check.php?user_id='+post_user_id;
			} else {
				return;
			}
		}
	};
	xhr.send(param);
}

function update_saved_not_saved(post,post_id){
	var param = 'saved_not_saved=true'+"&saved_not_saved_id="+post_id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','index_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status === 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText)
				if(data.saved=== true){
					post.querySelector('.not_saved').style.display = "none";
					post.querySelector('.saved').style.display = "inline-block";
				} else if(data.notsaved === true){
					post.querySelector('.not_saved').style.display = "inline-block";
					post.querySelector('.saved').style.display = "none";
				} else {
					console.log(data);
				}
			}
		}
	};
	xhr.send(param);
}

function update_liked_not_liked(post,post_id){
	var param = 'liked_not_liked=true'+"&liked_not_liked_id="+post_id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','index_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status === 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText)
				if(data.liked === true){
					post.querySelector('.not_liked').style.display = "none";
					post.querySelector('.liked').style.display = "inline-block";
					post.querySelector('.likes_comment_container .likes_count').textContent = data.count + " Likes";
				} else if(data.notliked === true){
					post.querySelector('.not_liked').style.display = "inline-block";
					post.querySelector('.liked').style.display = "none";
					post.querySelector('.likes_comment_container .likes_count').textContent = data.count + " Likes";
				}
			}
		}
	};
	xhr.send(param);
}

function check_likes_save_post(post,post_id){
	var param = "check_likes_save_post_id="+post_id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','index_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status == 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);

				post.querySelector('.not_saved').id = 'not_saved-'+post_id;
				post.querySelector('.saved').id = 'saved-'+post_id;
				post.querySelector('.not_liked').id = 'not_liked-'+post_id;
				post.querySelector('.liked').id = 'liked-'+post_id;

				post.querySelector('.liked').addEventListener('click',function(){
					update_liked_not_liked(post,post_id);
				});
				post.querySelector('.not_liked').addEventListener('click',function(){
					update_liked_not_liked(post,post_id);
				});
				post.querySelector('.saved').addEventListener('click',function(){
					update_saved_not_saved(post,post_id);
				});
				post.querySelector('.not_saved').addEventListener('click',function(){
					update_saved_not_saved(post,post_id);
				});

				if(data.liked === true){
					post.querySelector('.liked').style.display = 'inline-block';
				} else {
					post.querySelector('.not_liked').style.display = 'inline-block';
				}
				if(data.saved === true){
					post.querySelector('.saved').style.display = 'inline-block';
				} else {
					post.querySelector('.not_saved').style.display = 'inline-block';
					post.querySelector('.not_saved').id = 'not_saved-'+post_id;
				}
			} else {
				return;
			}
		}
	};
	xhr.send(param);
}

function load_more_comments(post,post_id){
	var comment_container = post.querySelector('.comments_view_container div');
	var comments= comment_container.children;
	var last_comment = comments.item(0);
	var last_comment_array = last_comment.id.split('-');
	var last_comment_id = last_comment_array[1];
	var param = "load_more_comments=true&more_comments_post_id="+post_id+'&last_comment_id='+last_comment_id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','index_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status == 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);
				if(data.length !== 0){
					if(data.length < 11){
						post.querySelector('.load_more_comments').classList.add('d-none');
					}

					var comment_count = data.length > 10? 10:data.length;
					var temp_last_comment = last_comment;

					for(var i=0;i<comment_count;i++){
						var user_comment = post.querySelector('#comment_view_template').cloneNode(true);
						user_comment.id='comment-'+data[i].id;
						user_comment.classList.remove('d-none');
						user_comment.querySelector('.user_username a').href = 'profile_check.php?user_id='+data[i].commenter_id;
						user_comment.querySelector('.user_username a').textContent = data[i].username;
						user_comment.querySelector('.user_comment').textContent = data[i].comment;
						comment_container.insertBefore(user_comment,temp_last_comment);
						var temp_comments= comment_container.children;
						temp_last_comment = temp_comments.item(0);
					}
				}
			} else {
				return;
			}
		}
	};
	xhr.send(param);
}

function load_post_comments(post,post_id){
	var param = "comments_post_id="+post_id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','index_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status == 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);
				if(data.length === 0){
					post.querySelector('.comments_view_container div').innerHTML = "<p>No comments yet</p>";
				} else {
					if(data.length === 5){
						post.querySelector('.load_more_comments').classList.remove('d-none');
						post.querySelector('.load_more_comments').classList.add('click_event_activated');
						post.querySelector('.load_more_comments a').id = 'load_more_comments'+post_id;
						post.querySelector('.load_more_comments a').addEventListener('click',function(e){
							e.preventDefault();
							load_more_comments(post,post_id);
						});

					}

					var comment_count = data.length > 4? 4:data.length;
					var comment_container = post.querySelector('.comments_view_container div');
					var temp_last_comment = '';

					for(var i=0;i<comment_count;i++){
						var user_comment = post.querySelector('#comment_view_template').cloneNode(true);
						user_comment.id='comment-'+data[i].id;
						user_comment.classList.remove('d-none');
						user_comment.querySelector('.user_username a').href = 'profile_check.php?user_id='+data[i].commenter_id;
						user_comment.querySelector('.user_username a').textContent = data[i].username;
						user_comment.querySelector('.user_comment').textContent = data[i].comment;
						if(temp_last_comment === ''){
							comment_container.appendChild(user_comment);
						} else {
							comment_container.insertBefore(user_comment,temp_last_comment);
						}
						var temp_comments= comment_container.children;
						temp_last_comment = temp_comments.item(0);
					}
				}
			} else {
				return;
			}
		}
	};
	xhr.send(param);
}

function update_added_comment(value,post_id){
	var param = "add_comment=true"+"&comment="+value+"&add_comment_post_id="+post_id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','index_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status === 200){
			if(isJson(this.responseText)){
				data = JSON.parse(this.responseText);
				var post = document.querySelector('#post'+post_id);
				post.querySelector('.comments_view_container div').innerHTML = '';
				if(data.length === 5){
					var element = post.querySelector('.load_more_comments');
					if(has_class(element,'click_event_activated') === false){
						post.querySelector('.load_more_comments').classList.remove('d-none');
						post.querySelector('.load_more_comments').classList.add('click_event_activated');
						post.querySelector('.load_more_comments a').id = 'load_more_comments'+post_id;
						post.querySelector('.load_more_comments a').addEventListener('click',function(e){
							e.preventDefault();
							load_more_comments(post,post_id);
						});
					}
				}

				var comment_count = data.length > 4? 4:data.length;
				var comment_container = post.querySelector('.comments_view_container div');
				var temp_last_comment = '';
				
				for(var i=0;i<comment_count;i++){
					var user_comment = post.querySelector('#comment_view_template').cloneNode(true);
					user_comment.id='comment-'+data[i].id;
					user_comment.classList.remove('d-none');
					user_comment.querySelector('.user_username a').href = 'profile_check.php?user_id='+data[i].commenter_id;
					user_comment.querySelector('.user_username a').textContent = data[i].username;
					user_comment.querySelector('.user_comment').textContent = data[i].comment;
					if(temp_last_comment === ''){
						comment_container.appendChild(user_comment);
					} else {
						comment_container.insertBefore(user_comment,temp_last_comment);
					}
					var temp_comments= comment_container.children;
					temp_last_comment = temp_comments.item(0);
				}
				post.querySelector('.write_comment input').value = '';
			}
		}
	};
	xhr.send(param);
}

function unfollow_user($user_id){
	var param = 'unfollow_user=true&user_id='+$user_id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','index_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status === 200){
			if(this.responseText === 'success'){
				window.location.href = 'index.php';
			} else {				
				alert('Sorry Some Problem Occurred!!!');
			}
		}
	};
	xhr.send(param);
}

function delete_post($post_id){
	var param = 'delete_post=true&post_id='+$post_id;
	var xhr = new XMLHttpRequest();
	xhr.open('POST','index_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status === 200){
			if(this.responseText === 'success'){
				window.location.href = 'index.php';
			} else {
				alert(this.responseText);				
				alert('Sorry Some Problem Occurred!!!');
			}
		}
	};
	xhr.send(param);
}

function update_post(postdata){
	if(!isJson(postdata)){
		
	} else {
		var data = JSON.parse(postdata);

		if(post_number == 0 && data.length == 0){
			posts_container.classList.add('d-flex');
			posts_container.classList.add('align-items-center');
			posts_container.classList.add('justify-content-center');
			posts_container.innerHTML = "<div><h3>No posts Available Please follow people</h3></div>";
		}
		
		for(var i = 0;i<data.length;i++){
			var post = clonepost(data[i].id);

			load_post_user_data(post,data[i].user_id);

			check_likes_save_post(post,data[i].id);

			load_post_comments(post,data[i].id);


			if(data[i].post_type == "image"){
				post.querySelector('.image_post').style.display = 'block';
				post.querySelector('.image_post img').src = 'image/'+data[i].images_name;
			} else if(data[i].post_type == "images"){
				images_array = data[i].images_name.split("-");
				post.querySelector('.images_post').style.display = 'block';
				var post_image_id = data[i].id;
				post.querySelector('.images_post .carousel').id ='imageIndicators'+post_image_id;
				post.querySelector('.carousel-control-prev').href = '#imageIndicators'+post_image_id;
				post.querySelector('.carousel-control-next').href = '#imageIndicators'+post_image_id;

				for(var j=0;j<images_array.length;j++){
				 	var indicator = "<li data-target='#imageIndicators"+post_image_id+"' data-slide-to=\'"+j+"\'></li>";
				 	post.querySelector('.carousel-indicators').innerHTML += indicator;
				 	var carousel_item = "<div class='carousel-item'><img class='d-block w-100' src=\'image/"+images_array[j]+"\' alt='Post Images'></div>";
				 	post.querySelector('.carousel-inner').innerHTML += carousel_item;
				 	if(j === 0){
				 		post.querySelector('.carousel-indicators li').classList.add('active');
				 		post.querySelector('.carousel-item').classList.add('active');
				 	}
				}
			} else if(data[i].post_type == "video"){
				post.querySelector('.video_post').style.display = 'block';
				post.querySelector('.video_post video').src = 'video/'+data[i].video;
			}

			(function(){
				var temp_post = post;
				temp_post.querySelector('.comment_icon_btn').addEventListener('click',function() {
					temp_post.querySelector('.write_comment input').focus();
				});
			}());

			post.querySelector('.likes_comment_container .likes_count').textContent = data[i].no_of_likes + " Likes";

			(function(){
				var temp_data = data[i];
				var temp_post = post;
				if(temp_data.description !== ''){
					temp_post.querySelector('.posts_description').textContent = temp_data.description.substr(0,75);
					temp_post.querySelector('.more_description').textContent = temp_data.description.substr(75);
					if(temp_post.querySelector('.more_description').textContent === ''){
						temp_post.querySelector('.more_description_link').textContent = '';
					} else {
						temp_post.querySelector('.more_description_link a').addEventListener('click',function(e){
							e.preventDefault();
							temp_post.querySelector('.more_description').classList.remove('d-none');
							temp_post.querySelector('.more_description_link').textContent = '';
						});
					}
				} else {
					temp_post.querySelector('.more_description_link').textContent = '';
				}
			}());

			var time = Date.parse(data[i].time);
			post.querySelector('.posts_date_time').textContent = timeSince(time);
			post.querySelector('.posts_date_time').title = data[i].time;

			post.querySelector('.write_comment').id = 'your_comment_input-'+data[i].id; /*Add comment*/
			post.querySelector('.write_comment').addEventListener('keydown',function(event){
				if(event.keyCode === 13){
					event.preventDefault();
					var add_comment_value = this.querySelector('input').value;
					var add_comment_id = this.id.split("-");
					if(add_comment_value !== ''){
						update_added_comment(add_comment_value,add_comment_id[1]);
					}
				}
			}); /*End Add comment*/

			(function(){
				var temp_data = data[i];
				var temp_post = post;
				temp_post.querySelector('.post_modal_activator_btn').dataset.target = "#posts_options_modal"+temp_data.id;
				temp_post.querySelector('.modal').id = "posts_options_modal"+temp_data.id;
				if(temp_data.users_self_post === true){
					temp_post.querySelector('.delete_post').classList.remove('d-none');
					temp_post.querySelector('.delete_post').addEventListener('click',function(e){
						e.preventDefault();
						delete_post(temp_data.id);
					});
				} else {
					temp_post.querySelector('.reprort_inappropriate').classList.remove('d-none');
					temp_post.querySelector('.unfollow_user').classList.remove('d-none');
					temp_post.querySelector('.unfollow_user').addEventListener('click',function(e){
						e.preventDefault();
						unfollow_user(temp_data.user_id);
					});
				}
			}());

			posts_container.appendChild(post);
		}
	}
	halt_scroll(false);
}

function loadposts(callback){
	
	var posts_container_height = posts_container.offsetHeight;
	var scroll_position = window.pageYOffset;
	var window_height = window.innerHeight;

	if(window_height + scroll_position >= posts_container_height && halt_scroll_action == false){
		callback(true);
		document.querySelector('.post_loader div').classList.remove('spinner');
		document.querySelector('.post_loader').width = 0;
		document.querySelector('.post_loader').height = 0;
		document.querySelector('.post_loader').style.padding = 0;
		var param = "loadposts=true"+"&limit_start="+post_number+"&count=3";
		var xhr = new XMLHttpRequest();
		xhr.open('POST','index_request.php',true);
		xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		xhr.onload = function(){
			if(this.status == 200){
				update_post(this.responseText);
			}
		};
		xhr.send(param);
	} else {
		document.querySelector('.post_loader div').classList.add('spinner');
		document.querySelector('.post_loader').width = document.querySelector('#post0').width;
		document.querySelector('.post_loader').height = 100+"px";
		document.querySelector('.post_loader').style.padding = 30+"px";
		setTimeout(function(){
			document.querySelector('.post_loader div').classList.remove('spinner');
			document.querySelector('.post_loader').width = 0;
			document.querySelector('.post_loader').height = 0;
			document.querySelector('.post_loader').style.padding = 0;
		},2000);
	}
}


window.onscroll = function(){
	loadposts(halt_scroll);
}


function load_user_self_data(){
	var param = "load_user_self_data=true";
	var xhr =  new XMLHttpRequest();
	xhr.open('POST','index_request.php',true);
	xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
	xhr.onload = function(){
		if(this.status === 200){
			if(isJson(this.responseText)){
				var data = JSON.parse(this.responseText);
				user_profile_container = document.querySelector('.user_profile_container');
				user_profile_container.querySelector('img').src = 'image/'+data.profileimage;
				user_profile_container.querySelector('.user_username a').textContent = data.username;
				user_profile_container.querySelector('.user_full_name').textContent = data.fullname;
				user_profile_container.querySelector('a').href = 'profile_check.php?user_id='+data['user_id'];
				user_profile_container.querySelector('.user_username a').href = 'profile_check.php?user_id='+data['user_id'];
			}
		}
	}
	xhr.send(param);
}