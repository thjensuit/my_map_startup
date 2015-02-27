<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <title>HKMap</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/chrome-bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/icomoon.css"/> 
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/tables.css">
  <script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
  <script src="<?php echo base_url(); ?>js/map.js"></script>
  <script src="<?php echo base_url(); ?>js/map.location.js"></script>
  <script src="<?php echo base_url(); ?>js/lib/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>js/lib/jquery.form.js"></script>
  <script src="<?php echo base_url(); ?>js/lib/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>js/lib/jquery.dataTables.columnFilter.js"></script>

</head>
<body>
<div class="main">
	<div class="col_3">
		<ul class="menu-left">
			<li><a class="home" onClick="openPages('home')" href="#"><i class="icon-home-2"></i><?php echo lang('template.home');?></a></li>
			<li><a class="category" onClick="openPages('category')" href="#"><i class="icon-list"></i><?php echo lang('template.category');?></a></li>
			<li><a class="location-list" onClick="openPages('location_list')" href="#"><i class="icon-checkin"></i><?php echo lang('template.location_list');?></a></li>
      <li><a class="category" onClick="openPages('member')" href="#"><i class="icon-users"></i><?php echo lang('member.member');?></a></li>
			<li><a class="setting" onClick="openPages('user')" href="#"><i class="icon-uniF00F"></i><?php echo lang('template.setting');?></a></li>
			<li><a class="logout" href="login/logout"><i class="icon-muhamad-bahrul-ulum-log-out"></i><?php echo lang('template.logout');?></a></li>
      <li>
        <table align='center'>
          <tr>
              <td><a href="<?php echo base_url();?>index.php/vn/main"><img src="<?php echo base_url();?>images/languages/vietnam.png"/></a></td>
              <td><a href="<?php echo base_url();?>index.php/en/main"><img src="<?php echo base_url();?>images/languages/english.png"/></a></td>
          </tr>
        </table>
      </li>
		</ul>
	</div>
	<div class="col_9 padding-left">
		<div class="content-block">
    		<div class="content-block-title"><span class="icon-checkin"></span>HKMAP</div>
			<div id="page"></div>
		</div>
	</div>
</div>
</body>
</html>

<!-- For request marker images -->
<input id="add_images_marker_id" type="hidden">
<input id="add_images_marker_name" type="hidden">

<script>
  
  // Default load page
  openPages("home");
  $('ul.menu-left li:first').addClass('selected');
   
   // Load page
  function openPages(url) {
  	$("#page").empty();	
  	$.ajax({
		url: url,	
		type: "GET",		
		cache: false,
		success: function (data) {	
			$("#page").html(data);		
			//$('#loading').fadeOut(100);
			}		
		});
	}	  
  
  // Set style active menu
  $('ul.menu-left li').click(function(){
    	$('.menu-left li').removeClass('selected');
    	$(this).addClass('selected');
  });

</script>