<!-- Content -->
<div style="font-size:15px; color: #999999; padding-bottom: 15px; float:left;"><?php echo lang('member.Member');?></div>
<div style="float:right;">
	<div class="menu">
		<a href="#view"><button id="btn-view"><?php echo lang('member.View');?></button></a> 
		<a href="#form"><button id="btn-insert"><?php echo lang('member.Insert');?></button></a> 
		<a href="#form"><button id="btn-update" disabled="disabled"><?php echo lang('member.Update');?></button></a>
		<button id="btn-remove" disabled="disabled"><?php echo lang('member.Remove');?></button>
		<button id="btn-filter" value="on"><?php echo lang('member.Filter');?></button>
		<!-- <button id="btn-add-image" disabled="disabled" onClick="openPages('images/index')"><?php echo lang('member.Images');?></button> -->
	</div>
</div>

<div class="mainview view">
	<div id="form" style="display:none; padding-bottom:45px;">
		<form method="post" id="submit-form" action="member/insert" enctype="multipart/form-data">
		<input type="hidden" name="member_id" id="member_id">
		<br /><br />
		<div class="innert-list">
    		<h1><?php echo lang('member.Phone');?></h1>
    		<div class="corner">
    			<input type="text" name="member_phone" id="member_phone">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1><?php echo lang('member.Fname');?></h1>
    		<div class="corner">
				<input type="text" name="member_fname" id="member_fname">
        		</select>
    		</div>
    	</div>
		<div class="innert-list">
    		<h1><?php echo lang('member.Lname');?></h1>
    		<div class="corner">
    			<input type="text" name="member_lname" id="member_lname">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1><?php echo lang('member.Birthday');?></h1>
    		<div class="corner">
    			<input type="date" name="member_birthday" id="member_birthday">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1><?php echo lang('member.Avatar');?></h1>
    		<div class="corner">
    			<input type="file" name="member_avatar" id="member_avatar">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1><?php echo lang('member.Status');?></h1>
    		<div class="corner">
    			<input type="text" name="member_status" id="member_status" style="width: 320px;" > 
    		</div>
    	</div>
		<div class="innert-list">
    		<h1><?php echo lang('member.Longitude');?></h1>
    		<div class="corner">
    			<input type="text" name="member_longitude" id="member_longitude" style="width: 320px;">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1><?php echo lang('member.Latitude');?></h1>
    		<div class="corner">
    			<input type="text" name="member_latitude" id="member_latitude" style="width: 320px;">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1><?php echo lang('member.Verification');?></h1>
    		<div class="corner">
    			<input type="text" name="member_verification" id="member_verification" style="width: 320px;">
    		</div>
    	</div>
    	<div class="innert-list">
    		<h1><?php echo lang('member.Token');?></h1>
    		<div class="corner">
    			<input type="text" name="member_token" id="member_token" style="width: 320px;">
    		</div>
    	</div>
    	<div class="innert-list">
    		<h1><?php echo lang('member.Activation');?></h1>
    		<div class="corner">
    			<input type="text" name="member_activation" id="member_activation" style="width: 320px;">
    		</div>
    	</div>
    	<div class="innert-list">
    		<h1><?php echo lang('member.sos');?></h1>
    		<div class="corner">
    			<input type="text" name="member_sos" id="member_sos" style="width: 320px;">
    		</div>
    	</div>
		<div class="innert-list">
    	<br />
    	<div class="corner">
    		  <button type="reset"><?php echo lang('member.Reset');?></button>
              <button type="submit"><?php echo lang('member.Submit');?></button>
    	</div>
    </div>
	</form>
</div>

<div id="view" style="padding-bottom:45px;">
<!-- Datatables -->
	<table class="table" id="tabels">
		<thead>
			<tr>
				<th width="10%"><?php echo lang('member.Phone');?></th>
				<th width="10%"><?php echo lang('member.Fnametb');?></th>
				<th width="10%"><?php echo lang('member.Lnametb');?></th>
				<th width="20%"><?php echo lang('member.Birthday');?></th>
				<th width="20%"><?php echo lang('member.Status');?></th>
				<th width="30%"><?php echo lang('member.Update');?></th>
			</tr>
		</thead>
		<tfoot id="form_filter" style="display:none">
			<tr align="center">
				<th><?php echo lang('member.Phone');?></th>
				<th><?php echo lang('member.Fname');?></th>
				<th><?php echo lang('member.Lname');?></th>
				<th><?php echo lang('member.Birthday');?></th>
				<th><?php echo lang('member.Status');?></th>
				<th><?php echo lang('member.Update');?></th>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td colspan="5" class="dataTables_empty"><?php echo lang('member.Loadingdatafromserver');?></td>
			</tr>
		</tbody>
	</table>

	<!-- Remove Modal -->
	<div class="overlay" style="display: none; padding-bottom:45px;">
    	<div class="page">
              <h1><b><?php echo lang('member.Confirm');?></b></h1>
              	<div class="content-area">
               		<?php echo lang('member.Areyousureyouwanttoremovethisdata');?> 
              	</div>
              	<div class="action-area">
			 		<form method="post" id="remove-form" action="member/remove">
                		<div class="action-area-right">
                  			<div class="button-strip">
				   				<input type="hidden" name="remove_member_id" id="remove_member_id">
                    			<button type="reset"><?php echo lang('member.Cancel');?></button>
                    			<button type="submit"><?php echo lang('member.Submit');?></button>
                  			</div>
                		</div>
					</form>
              	</div>
            </div>
		</div>
</div>
<!-- End -->

<script type="text/javascript"> 

$(document).ready(function() {
	/** Get Maps **/
	/*$('#btn-map').click(function() {
		setTimeout("initialize()", 500);
	});
	*/
	/** Action button menu **/

	/* Menu transition */
	$('.menu a').click(function(ev) {

        ev.preventDefault();
        var selected = 'selected';

        $('.mainview > *').removeClass(selected);
        $('.menu button').removeClass(selected);
		 setTimeout(function() {
          $('.mainview > *:not(.selected)').css('display', 'none');
        }, 100);
		$(ev.currentTarget).parent().addClass(selected);
        var currentView = $($(ev.currentTarget).attr('href'));
        currentView.css('display', 'block');
        setTimeout(function() {
          currentView.addClass(selected);
        }, 0);
      });
		
	/* View button */
	$('#btn-view').bind('click', function(){
		// Enable button
		$('#btn-insert').removeAttr("disabled");
		$('#btn-filter').removeAttr("disabled");
	});

	/* Insert button */
	$('#btn-insert').bind('click', function(){
		// Reset submit form
		$('#member_id').val('');
		$("#submit-form")[0].reset();		
		// Disabled button
		$('#btn-update').attr("disabled","disabled");
		$('#btn-remove').attr("disabled","disabled");
		$('#btn-filter').attr("disabled","disabled");
		$('#btn-add-image').attr("disabled","disabled");
	});

	/* Update button */
	$('#btn-update').bind('click', function(){
		// Disabled button
		$('#btn-insert').attr("disabled","disabled");
		$('#btn-remove').attr("disabled","disabled");
		$('#btn-filter').attr("disabled","disabled");
		$('#btn-add-image').attr("disabled","disabled");
	});
	
	/* Filter button */	
  	$('#btn-filter').bind('click', function(){
		
		if($('#btn-filter').attr("value") == "on"){
			$('#form_filter').show();
			$('#btn-filter').attr("value","off");
    	}else{
			$('#form_filter').hide();
			$('#btn-filter').attr("value","on");
		}
			
		});

	/* Remove button */
	$('#btn-remove').bind('click', function(){
		$('.overlay').show();
		$('.overlay').find('button').click(function() {
         	$('.overlay').hide();
        });
			
		$('.overlay').click(function() {
        	$('.overlay').find('.page').addClass('pulse');
        	$('.overlay').find('.page').on('webkitAnimationEnd', function() {
            	$(this).removeClass('pulse');
          	});
        });

	});


//	function getRequest(url, callback) {
//    	var request;
//    	if (window.XMLHttpRequest) {
//       		request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
//    	} else {
//        	request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
//    	}
//    	request.onreadystatechange = function() {
//        	if (request.readyState == 4 && request.status == 200) {
//            	callback(request);
//				$('.loading').hide();
//        	}
//    	}
//    	request.open("GET", url, true);
//    	request.send();
//	}

	/** Form submit action **/ 
	
	/* Set "submit-form" action */	 
	$('#submit-form').ajaxForm({
	   resetForm: true,
	   cache: false,
	   success: alertForm
    });
	
	/* Set "remove-form" action */
	$('#remove-form').ajaxForm({
	   resetForm: true,
	   cache: false,
	   success: alertForm
    });
	
	/* Alert form action */
	function alertForm(query){
		// Reload page
 		openPages('member');
		alert(query);
	}
	
		/** Set datatables **/
                
	var oTable = $('#tabels').dataTable({
		"bProcessing": false,
		"bServerSide": true,
		"sAjaxSource": "member/get",
		'sPaginationType': 'full_numbers',					
       	"fnServerData": function( sUrl, aoData, fnCallback ) {
            $.ajax( {
                "url": sUrl,
                "data": aoData,
                "success": fnCallback,
                "dataType": "jsonp",
                "cache": false
            } );
        }
         }).columnFilter({
		 	// Set filter type
	      	aoColumns: [{ type: "text" },
						{ type: "text" },
						{ type: "text" },
						{ type: "text" },
				        { type: "text" },
				        { type: "text" }]
		});


	/** Show detail data datatables **/
	
	function fnFormatDetails ( nTr )
		{
                        
		var lang="<?php Print(lang('member.lang'));?>";
		 var aData = oTable.fnGetData( nTr );
		 if(aData != null){
				if(lang!='vn'){
					var sOut = '<table width="100%" height="100" border="0" cellpadding="0" cellspacing="0">';
	  				sOut += '<tr>';
	    			sOut += '<td width="20%" rowspan="4"><div align="center"><img src="<?php echo base_url(); ?>upload/logo/'+aData[6]+'" width="100" height="100"></div></td>';
					sOut += '<td width="10%"><strong>Longitude</strong></td>';
					sOut += '<td width="2%"><strong>:</strong></td>';
					sOut += '<td width="38%">'+aData[7]+'</td>';
					sOut += '<td width="10%"><strong>Activation</strong></td>';
					sOut += '<td width="2%"><strong>:</strong></td>';
					sOut += '<td width="18%">'+aData[11]+'</td>';
					sOut += '</tr>';
					sOut += '<tr>';
					sOut += '<td><strong>Latitude</strong></td>';
					sOut += '<td><strong>:</strong></td>';
					sOut += '<td>'+aData[8]+'</td>';
					sOut += '<td><strong>SOS</strong></td>';
					sOut += ' <td><strong>:</strong></td>';
					sOut += '<td>'+aData[12]+'</td>'
					sOut += '</tr>';
					//
					sOut += '<tr>';
					sOut += '<td><strong>Verification</strong></td>';
					sOut += ' <td><strong>:</strong></td>';
					sOut += '<td>'+aData[9]+'</td>';
					// sOut += '<td><strong>Level</strong></td>';
					// sOut += ' <td><strong>:</strong></td>';
					// sOut += '<td>'+aData[13]+'</td>';
					sOut += '</tr>';
					sOut += '<tr>';
					sOut += '<td><strong>Token</strong></td>';
					sOut += ' <td><strong>:</strong></td>';
					sOut += '<td>'+aData[10]+'</td>';
					// sOut += '<td><strong>Savior</strong></td>';
					// sOut += ' <td><strong>:</strong></td>';
					// sOut += '<td>'+aData[14]+'</td>';
					sOut += '</tr>';
					sOut += '</table>';
				}else{
					var sOut = '<table width="100%" height="100" border="0" cellpadding="0" cellspacing="0">';
	  				sOut += '<tr>';
	    			sOut += '<td width="20%" rowspan="4"><div align="center"><img src="<?php echo base_url(); ?>upload/logo/'+aData[6]+'" width="100" height="100"></div></td>';
					sOut += '<td width="10%"><strong>Kinh độ</strong></td>';
					sOut += '<td width="2%"><strong>:</strong></td>';
					sOut += '<td width="38%">'+aData[7]+'</td>';
					sOut += '<td width="10%"><strong>Activation</strong></td>';
					sOut += '<td width="2%"><strong>:</strong></td>';
					sOut += '<td width="18%">'+aData[11]+'</td>';
					sOut += '</tr>';
					sOut += '<tr>';
					sOut += '<td><strong>Vĩ độ</strong></td>';
					sOut += '<td><strong>:</strong></td>';
					sOut += '<td>'+aData[8]+'</td>';
					sOut += '<td><strong>SOS</strong></td>';
					sOut += ' <td><strong>:</strong></td>';
					sOut += '<td>'+aData[12]+'</td>'
					sOut += '</tr>';
					//
					sOut += '<tr>';
					sOut += '<td><strong>Verification</strong></td>';
					sOut += ' <td><strong>:</strong></td>';
					sOut += '<td>'+aData[9]+'</td>';
					// sOut += '<td><strong>Level</strong></td>';
					// sOut += ' <td><strong>:</strong></td>';
					// sOut += '<td>'+aData[13]+'</td>';
					sOut += '</tr>';
					sOut += '<tr>';
					sOut += '<td><strong>Token</strong></td>';
					sOut += ' <td><strong>:</strong></td>';
					sOut += '<td>'+aData[10]+'</td>';
					// sOut += '<td><strong>Savior</strong></td>';
					// sOut += ' <td><strong>:</strong></td>';
					// sOut += '<td>'+aData[14]+'</td>';
					sOut += '</tr>';
					sOut += '</table>';
				}	

				return sOut;
			}
		}
			
				$('#tabels tbody').on( 'dblclick','td', function () {
					var nTr = $(this).parents('tr')[0];
					if ( oTable.fnIsOpen(nTr) )
					{
						oTable.fnClose( nTr );
					}
					else
					{
						oTable.fnOpen( nTr, fnFormatDetails(nTr), 'details' );
					}
				} );
	
	/** Set form edit value after click datatables **/	
	$('#tabels tbody').on('click','tr', function () {
	 var aData = oTable.fnGetData(this);
	 if(aData != null){
	 	// Set value form after select table for update data
	 	//$('#add_images_marker_id').val(aData[9]);
		$('#member_id').val(aData[15]);
		$('#remove_member_id').val(aData[15]);
		//$('#add_images_marker_name').val(aData[0]);
		//$('#markers_category_id > option[value="'+aData[10]+'"]').prop("selected", "selected");
	 	$('#member_phone').val(aData[0]);
		$('#member_fname').val(aData[1]);
	 	$('#member_lname').val(aData[2]);
		$('#member_birthday').val(aData[3]);
	 	$('#member_status').val(aData[4]);
	 	$('#member_update').val(aData[5]);
		$('#member_avatar').val(aData[6]);
		$('#member_longitude').val(aData[7]);
		$('#member_lagitude').val(aData[8]);
		$('#member_verification').val(aData[9]);
		$('#member_token').val(aData[10]);
		$('#member_activation').val(aData[11]);
		$('#member_sos').val(aData[12]);
		$('#member_level').val(aData[13]);
		$('#member_savior').val(aData[14]);
		
 		if($(this).hasClass('row_selected')) {
            $(this).removeClass('row_selected');
			// clear data form
			$(':hidden','#remove-form').val('');
			$('#btn-update').attr("disabled","disabled");
			$('#btn-remove').attr("disabled","disabled");
			$('#btn-add-image').attr("disabled","disabled");
			
        } else {
            oTable.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
			$('#btn-update').removeAttr("disabled");
			$('#btn-remove').removeAttr("disabled");
			$('#btn-add-image').removeAttr("disabled");
        }
	  }
	});
});
</script>