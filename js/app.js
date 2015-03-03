var settingArray = ["toggle-traffic-layer","toggle-weather-layer","toggle-panoramio-layer","toggle-transit-layer","toggle-bike-layer","toggle-nearby-distances"];

// ACTION SIDEBAR LEFT MENU
window.onpopstate = function(event)
{
  process();
};
	
//
function process(){
	var hash = window.location.hash;
	$('.scrollable ul li').removeClass("active");

    if (hash === "#page_home") {
		$("#li_page_home").addClass("active");
		$('.loading').hide();
	} else if (hash === "#page_location_map") {
		$("#li_page_location_map").addClass("active");
		setTimeout('init()',500);
	} else if (hash === "#page_nearby") {
		$("#li_page_nearby").addClass("active");
		myGeoloc();
		getNearby();
	} else if (hash === "#page_location_list") {
		$("#li_page_location_list").addClass("active");
		getLocationCategory();
	} else if (hash === "#page_show_location") {
		$('.scrollable ul li').removeClass("active");
	} else if (hash === "#page_detail") {
		$("#li_page_location_list").addClass("active");
	} else if (hash === "#page_save_location") {
		$("#li_page_save_location").addClass("active");
		listMyLocation();
	} else if (hash === "#page_detail_save_location") {
		$("#li_page_save_location").addClass("active");
	} else if (hash === "#page_add_location") {
		$("#li_page_save_location").addClass("active");
		$('#page_add_location').find('form')[0].reset();
	}
	 else if (hash === "#page_victim") {
		// $("#li_page_victim").addClass("active");
		getVictim();
	} else {
		// default link active
		$("#li_page_home").addClass("active");
		$('.loading').hide();
	}
}
//
$("#form-add").bind("click",function(){		
	addMyLocation();
});


for (var i = 0; i < settingArray.length; i++) {

	getSetting = localStorage.getItem(settingArray[i]);
	if(getSetting == "true"){
		$('#'+settingArray[i]).prop("checked", true);
	}

}

$('.toggle-control').bind('click', function(){

	var id = $(this).attr('id');
	
	if($(this).prop('checked')){

  		localStorage.setItem(id, "true");
	}else{
	
		localStorage.setItem(id, "false");
	}
	// Reload map after click setting
	showListFriend();
	init();
	getNearby();
});


 $('#search-list').keyup(function(event) {
	getFilterList();
});
 $('#search-list-nearby').keyup(function(event) {
	getFilterListNearby();
});
 $('#top-list-nearby').keyup(function(event) {
	getNearby();
});
	$('#search-distance').keyup(function(event) {
	getNearby();
}); 
 $('#advance-search').bind('click',function(){
 	$('#nearby-option').slideToggle();
 });
function jqUpdateSize(){
    // Get the dimensions of the viewport
      vpw 		= $(window).width(); 
      vph 		= $(window).height() - 100;
	  vph_full  = $(window).height() - 45;
	  vph_route = $(window).height() - 60;
	  
	 
     $('.wrapper').css({'height': vph_full + 'px'});
	 $('.wrapper-bar').css({'height': vph + 'px'});
	 $('.wrapper-route').css({'height': vph_route + 'px'});
	 $('#map_canvas').css({'height': vph_full + 'px'});
	 $('#my_map_canvas').css({'height': vph_full + 'px'});
	 $('#local_map').css({'height': vph_full + 'px'});
};

$(document).ready(jqUpdateSize);    // When the page first loads
$(window).resize(jqUpdateSize);     // When the browser changes size
$(document).ready(function(){
	checkRefresh();
	$('#refresh').click(function(){
		startRefresh();
	});
	$('#stop-refresh').click(function(){
		stopRefresh();
	});
	
    $("#mode-direction").bind('click',function(){
    	$(this).addClass('active');
    	$("#panel-mode").slideToggle('slow');
    	$("#panel-direction").slideUp('slow');
    });
    $("#custom-direction").bind('click',function(){
    	$(this).addClass('active');
    	$("#panel-direction").slideToggle();
    	initialize();
    	// $("#panel-direction").slideUp('slow');
    	$("#panel-mode").slideUp('slow');
    });
    $("#route-direction").bind('click',function(){
    	$(this).addClass('active');
    	if(($("#pac-input").val()!='')&&($("#pac-input2").val()!=''))
    	window.location.href = "#page_location_route";
    });
    $("#remove-direction").bind('click',function(){
    	$(this).addClass('active');
    	removeDirection();
    });
    $("#go-to-direction").bind('click',function(){
    	if(($("#pac-input").val()!='')&&($("#pac-input2").val()!='')){
    		removeMarkerStartEnd();
    		calcRoute();
    	}
    });
    $("#victim").bind("click",function(){
    	window.location.href = "#page_victim";
    });
    setTimeout("victimFlag()",2000);
    
    
});
function checkRefresh()
    {
      if( document.refreshForm.visited.value == "" )
      {
        // This is a fresh page load
        // document.refreshForm.visited.value = "1";
        // 

        jqUpdateSize();
        showListFriend();
        process()
        // You may want to add code here special for
        // fresh page loads
      }
      else
      {
        // alert("non refresh");
        // This is a page refresh

        // Insert code here representing what to do on
        // a refresh
      }
    } 
// Instance
snapper = new Snap({
	element: document.getElementById('content')
});
		
UpdateDrawers = function(){
	var state = snapper.state(),
	towards = state.info.towards,
	opening = state.info.opening;
};
		
snapper.on('drag', UpdateDrawers);
snapper.on('animating', UpdateDrawers);
snapper.on('animated', UpdateDrawers);
		
$('.toggle-left').bind('click', function(){
	snapper.open('left');
});
				
$('.toggle-right').bind('click', function(){
	 if($('.toggle-right').val() == "off"){
     	snapper.open('right');
		$('.toggle-right').val("on");
    }else{
       	snapper.close('right');
		$('.toggle-right').val("off");
	}
});

$('.scrollable ul li').bind('click', function(){
	snapper.close('left');
});	