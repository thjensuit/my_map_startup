<header style="position: relative; margin-bottom: 30px; width: 100%;">
	<h1><?php echo lang('home.SELECTCATEGORYMARKER');?> :</h1>
	<div class="corner">
		<select id="marker-category" name="marker_category">
			<option value="undefined"><?php echo lang('home.Selectoption');?></option>
        </select>
	</div>
</header>
<div id="map-canvas" style="height: 390px; width: 100%"></div>

<script>
/** Get Maps **/
init();

$("#marker-category").change(function() { 
	var value = $("#marker-category option:selected").val();
	init(value);
});

/** Get request data category  **/
$.get("home/get_category", function(data) {
         
        var data = JSON.parse(data.responseText);
    
        for (var i = 0; i < data.length; i++) {
			$("#marker-category").append("<option value="+
                data[i].category_id+">"+data[i].category_name+" ("+data[i].count+")</option>");
        }

    });
	
//function getRequest(url, callback) {
//    var request;
//    if (window.XMLHttpRequest) {
//        request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
//    } else {
//        request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
//    }
//    request.onreadystatechange = function() {
//        if (request.readyState == 4 && request.status == 200) {
//            callback(request);
//			$('.loading').hide();
//        }
//    }
//    request.open("GET", url, true);
//    request.send();
//}

</script>