$(document).ready(function(){
	$('#sbtn').click(function(e){
		e.preventDefault();
		function is_string(str) {
		  return /^[a-zA-Z]+$/.test(str);
		}
		var email 		= $('#email').val();
		var name 		= $('#name').val();
		var pwd 		= $('#pwd').val();
		var city 		= $('#city').val();
		var country 	= $('#country').val();
		var classname 	= 'Queries';
		var method 		= 'register';
		var baseurl 	= $('#register_form').data('ajaxurl');
		if(name == '' && email == '' && pwd == '' && city == '' && country == ''){
			$('#top').html("<div  class='loginresultmsg animated slideInDown'><div class='cem'><i class='glyphicon glyphicon-warning-sign'></i>  All fields are mandatory</div> </div>");
			$('#email,#name,#pwd,#city,#country').css("border","2px #c03 solid");
			$('#register_form').addClass('animated shake');
			return false;
		}
		if(name == ''){
			$('#top').html("<div  class='loginresultmsg animated slideInDown'><div class='cem'><i class='glyphicon glyphicon-warning-sign'></i> Name fields is mandatory</div> </div>");
			$('#name').css("border","2px #c03 solid");
			$('#register_form').addClass('animated shake');
			return false;
		}
		if(name.length <= 2 || name.length > 15){
			$('#top').html("<div class='loginresultmsg animated slideInDown'><div class='cem'><i class='glyphicon glyphicon-warning-sign'></i> Name is too short. (3-15)</div> </div>");
			$('#name').css("border","2px #c03 solid");
			return false;
		}
		if(!is_string(name)){
			$('#top').html("<div class='loginresultmsg animated slideInDown'><div class='cem'><i class='glyphicon glyphicon-warning-sign'></i> Name should be of alphabatical characters</div> </div>");
			$('#name').css("border","2px #c03 solid");
			$('#register_form').addClass('animated shake');
			return false;
		}
		if(pwd == ''){
			$('#top').html("<div  class='loginresultmsg animated slideInDown'><div class='cem'><i class='glyphicon glyphicon-warning-sign'>Password Field is mandatory.</i> </div> </div>");
			$('#pwd').css("border","2px #c03 solid");
			$('#register_form').addClass('animated shake');
			return false;
		}
		if(pwd.length <= 5 ){
			$('#top').html("<div class='loginresultmsg animated slideInDown'><div class='cem'><i class='glyphicon glyphicon-warning-sign'></i> Password shoud be min 6 character long</div> </div>");
			$('#name').css("border","2px #c03 solid");
			$('#register_form').addClass('animated shake');
			return false;
		}
		if(city == ''){
			$('#top').html("<div  class='loginresultmsg animated slideInDown'><div class='cem'><i class='glyphicon glyphicon-warning-sign'></i>City Field is mandatory. </div> </div>");
			$('#city').css("border","2px #c03 solid");
			$('#register_form').addClass('animated shake');
			return false;
		}
		if(country == ''){
			$('#top').html("<div  class='loginresultmsg animated slideInDown'><div class='cem'><i class='glyphicon glyphicon-warning-sign'></i>Country Field is mandatory.</div> </div>");
			$('#country').css("border","2px #c03 solid");
			$('#register_form').addClass('animated shake');
			return false;
		}
		var url = baseurl+'?name='+name+'&email='+email+'&password='+pwd+'&city='+city+'&country='+country+'&classname='+classname+'&method='+method;

		$.ajax({
		 	url: url, 
		 	success: function(result){
       			$('#top').html("<div class='successmsg animated slideInDown'>Registeration Successfully done</div>");
       			setTimeout(function(){
       				window.location = 'login.php?redirect=new_user';
       			},3000);
    		}
    	});
	});

	$('#loginbtn').click(function(e){
		e.preventDefault();
		var email 		= $('#email').val();
		var pwd 		= $('#password').val();
		var classname 	= 'Queries';
		var method 		= 'login';
		var baseurl 	= $('#login_forma').data('ajaxurl');
		var url 			= baseurl+'?email='+email+'&password='+pwd+'&classname='+classname+'&method='+method;

		$.ajax({
		 	url: url, 
		 	success: function(result){
		 		if(result == 'No user Found'){
		 			$('#top').html("<div class='loginresultmsg animated slideInDown'><div class='cem'>"+result+" </div> </div>");
		 		}else if(result == 'Password doesn\'t match to your account.'){
		 			$('#top').html("<div class='loginresultmsg animated slideInDown'><div class='cem'>"+result+"  </div></div>");
		 		}else if(result == 'Please input a valid Email address.'){
		 			$('#top').html("<<div class='loginresultmsg animated slideInDown'><div class='cem'>"+result+"  </div></div><");
		 		}else{
		 			$('#top').html("<div class='loginresultmsg animated slideInDown'><div class='cem'>"+result+" </div> </div>");
		 		}		 		
		 		if(result == 'Welcome'){
		 			$('#top').html("<div class='successmsg animated slideInDown'>"+result+" </div>");
	       			setTimeout(function(){
	       				location.reload();
	       			},1000);
		 		}
       			
    		}
    	});
	});

	/*---------------------------- Like click --------------------*/
	$('#love_post').click(function(e){
			e.preventDefault();

			var post_id 		 = $('#love_post').data('id');
			var l_user_id 		 = $('#love_post').data('luserid');
			var l_user_name 	 = $('#love_post').data('lusername');
			var l_user_email 	 = $('#love_post').data('luseremail');
			var whoLike 		 = $('#love_post').data('wholike');
			var classname 		 = 'Queries';
			var method 			 = 'increaselike';
			var methoConfirmLike = 'confirmLike';
			var baseurl 		= 	$('#love_post').data('ajaxurl');
			var url = baseurl+'?whoLike='+whoLike+'&post_id='+post_id+'&classname='+classname+'&method='+method+'&l_user_id='+l_user_id+'&l_user_name='+l_user_name+'&l_user_email='+l_user_email;
			$.ajax({
				cache: false,
			 	url: url, 
			 	success: function(result){
			 		if(result == 'loginPlease'){
			 			$('#pop_login').show();
			 				return false;
			 			}
			 		$('#love_post').css("color","#c03");
			 		$('.total_likes').html(result);
	    		}
	    	});

	});

	/*---------------Preview File Before Uploading-------*/
	function readURL(input) {
    	if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#show').attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$("#file").change(function(){
	    readURL(this);
	});
	
	/*--------------------- Upload Post-------------------*/
	$("#postForm").on('submit',(function(e){
		e.preventDefault();
		var formObj = $(this);
		var formData = new FormData(this);
		var formURL = formObj.attr("action")
		var userId 		= $('#user_id').val();
		var title  		=$('#title').val();
		var tags 	= $('#tags').val();
		var content 	= $('#content').val();
		var classname   = "Queries";
		var method      = "postRegister"
		var file_data = $('#file').prop('files')[0];    
		var ajaxUrl 	 = $('#postForm').data('ajaxurl');
		var url = ajaxUrl+'?tags='+tags+'&userid='+userId+'&title='+title+'&content='+content+'&classname='+classname+'&method='+method;
		$.ajax({
	        url: url,
	    	type: 'POST',
	        data:  formData,
	    	mimeType:"multipart/form-data",
	    	contentType: false,
	        cache: false,
	        processData:false,
			success:function(result){
				$('#act').html(result);
				setTimeout(function(){ window.location='../../user.php' }, 3000);
			},
			error:function(error){alert('error');}
			});
	}));
	
});