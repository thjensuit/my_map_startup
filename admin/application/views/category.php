<!-- Content -->
<div style="font-size:15px; color: #999999; padding-bottom: 15px; float:left;"><?php echo lang('category.Category');?></div>
<div style="float:right;">
	<div class="menu">
		<a href="#view"><button id="btn-view"><?php echo lang('category.View');?></button></a> 
		<a href="#form"><button id="btn-insert"><?php echo lang('category.Insert');?></button></a> 
		<a href="#form"><button id="btn-update" disabled="disabled"><?php echo lang('category.Update');?></button></a>
		<button id="btn-remove" disabled="disabled"><?php echo lang('category.Remove');?></button>
		<button id="btn-filter" value="on"><?php echo lang('category.Filter');?></button>
	</div>
</div>

<div class="mainview view">
	<div id="form" style="display:none; padding-bottom:45px;">
		<form method="post" id="submit-form" action="category/insert" enctype="multipart/form-data">
		<input type="hidden" name="category_id" id="category_id">
		<br /><br />
		<div class="innert-list">
    		<h1><?php echo lang('category.Name');?></h1>
    		<div class="corner">
    			<input type="text" name="category_name" id="category_name">
    		</div>
    	</div>
    	<div class="innert-list">
    		<h1><?php echo lang('category.Name_vn');?></h1>
    		<div class="corner">
    			<input type="text" name="category_name_vn" id="category_name_vn">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1><?php echo lang('category.IconList');?></h1>
    		<div class="corner">
    			<input type="text" name="category_icon" id="category_icon" placeholder="<?php echo lang('category.Clickicontoinfo');?>">
 <a href="<?php echo base_url(); ?>fonts/icomoon/" target="_blank"> <span aria-hidden="true" data-icon="&#xe03d;" style="font-size:16px;"></span></a>
    		</div>
    	</div>
			<div class="innert-list">
    		<h1><?php echo lang('category.Marker');?></h1>
    		<div class="corner">
    			<input type="file" name="category_marker" id="category_marker" >
				<input type="hidden" name="category_marker_old" id="category_marker_old">
    		</div>
    	</div>
		<div class="innert-list">
    		<h1><?php echo lang('category.Description');?></h1>
    		<div class="corner">
    			<input type="text" name="category_desc" id="category_desc">
    		</div>
    	</div>
    	<div class="innert-list">
    		<h1><?php echo lang('category.Description_vn');?></h1>
    		<div class="corner">
    			<input type="text" name="category_desc_vn" id="category_desc_vn">
    		</div>
    	</div>
		<div class="innert-list">
    	<br />
    	<div class="corner">
    		  <button type="reset"><?php echo lang('category.Reset');?></button>
              <button type="submit"><?php echo lang('category.Submit');?></button>
    	</div>
    </div>
	</form>
</div>

<div id="view" style="padding-bottom:45px;">
<!-- Datatables -->
	<table class="table" id="tabels">
		<thead>
			<tr>
				<th><?php echo lang('category.Name');?></th>
				<th><?php echo lang('category.Name_vn');?></th>
				<th><?php echo lang('category.Description');?></th>
				<th><?php echo lang('category.Description_vn');?></th>
			</tr>
		</thead>
		<tfoot id="form_filter" style="display:none">
			<tr align="center">
				<th><?php echo lang('category.Name');?></th>
				<th><?php echo lang('category.Name_vn');?></th>
				<th><?php echo lang('category.Description');?></th>
				<th><?php echo lang('category.Description_vn');?></th>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td colspan="5" class="dataTables_empty"><?php echo lang('category.Loadingdatafromserver');?></td>
			</tr>
		</tbody>
	</table>

<!-- Remove Modal -->


	<div class="overlay" style="display: none; padding-bottom:45px;">
    	<div class="page">
              <h1><b><?php echo lang('category.Confirm');?></b></h1>
              	<div class="content-area">
               		<?php echo lang('category.Areyousureyouwanttoremovethisdata');?> 
              	</div>
              	<div class="action-area">
			 		<form method="post" id="remove-form" action="category/remove">
                		<div class="action-area-right">
                  			<div class="button-strip">
				   				<input type="hidden" name="remove_category_id" id="remove_category_id">
                    			<button type="reset"><?php echo lang('category.Reset');?></button>
                    			<button type="submit"><?php echo lang('category.Submit');?></button>
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
		// Enable button insert
		$('#btn-insert').removeAttr("disabled");
		$('#btn-filter').removeAttr("disabled");
	});
		  
	/* Insert button */
	$('#btn-insert').bind('click', function(){
		// Reset submit form
		$(':hidden','#submit-form').val('');
		// Disabled button
		$('#btn-update').attr("disabled","disabled");
		$('#btn-remove').attr("disabled","disabled");
		$('#btn-filter').attr("disabled","disabled");
	});

	/* Update button */
	$('#btn-update').bind('click', function(){
		// Disabled button
		$('#btn-insert').attr("disabled","disabled");
		$('#btn-remove').attr("disabled","disabled");
		$('#btn-filter').attr("disabled","disabled");
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
 		openPages('category');
		alert(query);
	}
	
		/** Set datatables **/

	var oTable = $('#tabels').dataTable({
		"bProcessing": false,
		"bServerSide": true,
		"sAjaxSource": "category/get",
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
				        { type: "text" }]
		});


	/** Show detail data datatables **/
	
	function fnFormatDetails ( nTr )
		{
			
		 var aData = oTable.fnGetData( nTr );
		 if(aData != null){
			var sOut = '<table width="22%" height="38" border="0" cellpadding="0" cellspacing="0">';
  				sOut += '<tr><td width="51%" height="19"><div align="center">Icon List </div></td><td width="49%"><div align="center">Marker</div></td></tr>';
    			sOut += '<tr><td height="19"><div align="center" style="font-size:24px;" aria-hidden="true" data-icon="'+aData[4]+'"></div></td>';
				sOut +=	'<td><div align="center"><img src="<?php echo base_url(); ?>upload/marker/'+aData[5]+'" alt=""></div></td></tr></table>';
				
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
	
	/** Set edit value after click datatables **/	
	$('#tabels tbody').on('click','tr', function () {
	
	 var aData = oTable.fnGetData(this);
	  
	 if(aData != null){
	 	// Set value form after select table for update data
		$('#remove_category_id').val(aData[6]);
	 	$('#category_id').val(aData[6]);
	 	$('#category_name').val(aData[0]);
	 	$('#category_name_vn').val(aData[1]);
		$('#category_desc').val(aData[2]);
		$('#category_desc_vn').val(aData[3]);
	 	$('#category_icon').val(aData[4]);
	 	$('#category_marker_old').val(aData[5]);
	 
 			if ( $(this).hasClass('row_selected') ) {
            	$(this).removeClass('row_selected');
				// clear data form
				$(':hidden','#remove-form').val('');
				$(':hidden','#submit-form').val('');
				$('#btn-update').attr("disabled","disabled");
				$('#btn-remove').attr("disabled","disabled");
        	} else {
            	oTable.$('tr.row_selected').removeClass('row_selected');
            	$(this).addClass('row_selected');
				$('#btn-update').removeAttr("disabled");
				$('#btn-remove').removeAttr("disabled");
        	}
	  	}
		});
	});

</script>