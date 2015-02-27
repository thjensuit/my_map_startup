<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>UIT Places - Login</title>
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" />
  		<link rel="stylesheet" href="<?php echo base_url(); ?>css/login.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/icomoon.css"/> 
		<!-- Jquery-->
		<script type="text/javascript" src="<?php echo base_url(); ?>js/lib/jquery.min.js"></script>
  		
		
    </head>
    <body>
        <div class="container">

			<section class="main">
				<form class="form-login" action="login/login_check">
					<div align='right'>
						<a id="lang_viet"href="<?php echo base_url();?>index.php/vn/login"><img src="<?php echo base_url();?>images/languages/vietnam.png"/></a>
      					<a id="lang_eng" href="<?php echo base_url();?>index.php/en/login"><img src="<?php echo base_url();?>images/languages/english.png"/></a>
      				</div>
					<h1><span class="log-in">HKMap</span></h1>
					<p class="float">
						<label for="login"><i class="icon-user"></i><?php echo lang('login.username');?></label>
						<input type="text" id="user_name" name="user_name" placeholder="<?php echo lang('login.username');?>">
					</p>
					<p class="float" >
						<label for="password"><i class="icon-eye-blocked"></i><?php echo lang('login.password');?></label>
						<input type="password" id="user_password" name="user_password" 
						placeholder="<?php echo lang('login.password');?>" class="showpassword">
					</p>
					<p class="clearfix"> 
						<input type="reset" class="log-btn" value="<?php echo lang('login.cancel');?>">  
						<input id="login" type="submit" name="submit" value="<?php echo lang('login.login');?>">
					</p>
					<div id="message" align="center"></div>
				</form>​​
			</section>
			
        </div>
		<script type="text/javascript">
			$(function(){
				var password = '';
			    var showPassword = '';
				var lang='';
				var successfully='';
				var invalid = '';
				var lang="<?php Print(lang('login.lang'));?>";
				$("#lang_eng").bind("click",function(){
					password="Password";
					showPassword="Show password";
					successfully='<p class="success">You have logged in successfully!</p><p>Redirecting....</p>';
					invalid='<p class="error">ERROR: Invalid username and/or password.</p>';
				});
				$("#lang_viet").bind("click",function(){
					password="Mật khẩu";
					showPassword="Hiện mật khẩu";
					successfully='<p class="success">Bạn đã đăng nhập thành công!</p><p>Chuyển tiếp ....</p>';
					invalid='<p class="error">Có lỗi: Tên đăng nhập hoặc mật khẩu không hợp lệ.</p>';
				});
				if(lang!='vn'){
					password="Password";
					showPassword="Show password";
					successfully='<p class="success">You have logged in successfully!</p><p>Redirecting....</p>';
					invalid='<p class="error">ERROR: Invalid username and/or password.</p>';
				}else{
					password="Mật khẩu";
					showPassword="Hiện mật khẩu";
					successfully='<p class="success">Bạn đã đăng nhập thành công!</p><p>Chuyển tiếp ....</p>';
					invalid='<p class="error">Có lỗi: Tên đăng nhập hoặc mật khẩu không hợp lệ.</p>';
				}
				$("#login").click(function(){

					var action = $(".form-login").attr('action');
					var form_data = {
						username: $("#user_name").val(),
						password: $("#user_password").val()
					};

					$.ajax({
					type: "POST",
					url: action,
					data: form_data,
					success: function(response)
						{
							if(response == "success")
								$(".form-login").slideUp('slow', function(){
									$("#message").html(successfully).fadeIn(500);
									//redirect to secure page
					 				document.location='main';
								});
							else
								$("#message").html(invalid).fadeIn(500);
						}
					});
					return false;
				});
	
			    $(".showpassword").each(function(index,input) {
			        var $input = $(input);
			        $("<p class='opt'/>").append(
			            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
			                var change = $(this).is(":checked") ? "text" : "password";
			                var rep = $("<input placeholder='"+password+"' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
			             })
			        ).append($("<label for='showPassword'/>").text(showPassword)).insertAfter($input.parent());
			    });

			    $('#showPassword').click(function(){
					if($("#showPassword").is(":checked")) {
						$('.icon-eye-blocked').addClass('icon-eye2');
						$('.icon-eye2').removeClass('icon-eye-blocked');    
					} else {
						$('.icon-eye2').addClass('icon-eye-blocked');
						$('.icon-eye-blocked').removeClass('icon-eye2');
					}
			    });
			});
		</script>
    </body>
</html>