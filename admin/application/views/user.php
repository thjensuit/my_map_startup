<!-- Content -->
<div style="font-size:15px; color: #999999; padding-bottom: 15px; float:left;"><?php echo lang('user.usersetting');?></div>

<div class="mainview view">
	<div id="form" style="padding-bottom:45px;">
		<form method="post" id="submit-form" action="user/update" enctype="multipart/form-data">
		<br /><br />
		<div class="innert-list">
    		<h1><?php echo lang('user.username');?></h1>
    		<div class="corner">
    			<input type="text" name="user_name" value="<?php echo $query->user_name; ?>" id="user_name">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1><?php echo lang('user.password');?></h1>
    		<div class="corner">
    			<input type="text" name="user_password" id="user_password">
    		</div>
    	</div>
		<div class="innert-list">
    	<br />
    		<div class="corner">
    		  	<button type="reset"><?php echo lang('user.reset');?></button>
              	<button type="submit"><?php echo lang('user.submit');?></button>
    		</div>
   	 	</div>
		</form>
	</div>
</div>
<!-- End -->
		
<script type="text/javascript"> 

	/** Form submit action **/ 
	
	/* Set "submit-form" action */	 
	$('#submit-form').ajaxForm({
	   //resetForm: true,
	   cache: false,
	   success: alertForm
    });
	
	/* Alert form action */
	function alertForm(query){
		alert(query);
	}
	
</script>