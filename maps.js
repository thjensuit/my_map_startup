// Set url service app
// var urlRequest = "http://maps.vncgame.com/admin/";
var urlRequest = "http://localhost/my_map/admin/";
var urlService  = urlRequest+"index.php/en/";
var urlAvatar = "http://api.vncgame.com:8080/query/avatar/";
// Set maps variabel
var map,myMap,
  myLat,
  myLong,
  myRadius,
  userLocation,
  address,
  panorama,
  streetPlace,
  input,
  input2;

  
var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();
var bounds = new google.maps.LatLngBounds();
var directionsService = new google.maps.DirectionsService();
var directionsDisplay = new google.maps.DirectionsRenderer();
var markers = [];
var markersFriend = [];
var myMarker;
var markerStartEnd=[];
var addressList=[];
var categoryMarkerList;
var markerTemp=[];
var flag=0;

//
  // Get detection user location  
  function myGeoloc(){
    // var options = {frequency:3000};
    // var watchID= navigator.geolocation.watchPosition(onSuccess,onError,options);
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(myGeolocSuccess, myGeolocError,{enableHighAccuracy:true});
    } else {
      error('Geolocation not supported');
    }

  }

  // Get user location 

  function myGeolocSuccess(position) {

    myLat   = position.coords.latitude;
    myLong  = position.coords.longitude;
    myRadius  = position.coords.accuracy;


    userLocation = new google.maps.LatLng(myLat,myLong);
    geocoder.geocode( { 'latLng': userLocation}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
        address =  results[0].formatted_address;
        }
    });
    // Set marker location user
      var marker = new google.maps.Marker({
              map: map,
        icon: "img/pin/pin1.png",
              position: userLocation,
        animation: google.maps.Animation.DROP,
              title: location.nama
          });
    // Set accuracy location user
    var circle = new google.maps.Circle({
        center: userLocation,
        radius: myRadius,
        map: map,
        fillColor: '#FF3300',
        fillOpacity: 0.2,
        strokeColor: '#FF3300',
        strokeOpacity: 0.4
    });
    myMarker=marker;
    attachMessage(marker,"<div class='infoWindow'><strong>My location</strong></div>")
    // map.fitBounds(circle.getBounds());
    markers.push(marker); 
  }
  
  // Get user location not found
  function myGeolocError() {
     log('Location Not Found!');
  }

  // Set maps properties
  function init(req,status,street) {
    myGeoloc();
    if(!req){
        var req = '';
    }
    
    var mapOptions = {
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }
       
    // Set id to display maps
      map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
      var panelCategory = document.getElementById('panel-category');
      // panelCategory.style.display = 'block';
      map.controls[google.maps.ControlPosition.TOP_RIGHT].push(panelCategory);
      getLocationCategory();
    
    // Request result directions maps
      if(status == 1){
      directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('directions-route'));
      }else{
        directionsDisplay.setMap(null);
      $('#directions_panel').empty();
      
    }
        
    rightMenu(map);

    // We get the map's default panorama and set up some defaults.
      // Note that we don't yet set it visible.
      panorama = map.getStreetView();
      panorama.setPosition(streetPlace);
      panorama.setPov(({
        heading: 265,
        pitch: 0
      }));
      
    if (street == "true") {
        panorama.setVisible(true);
      } else {
        panorama.setVisible(false);
      }
    
      // Set url requst maps data
    var url = urlService+'service/get_maps?filter='+req;
    
    // Get request data
      getRequest(url, function(data) {
           
          categoryMarkerList = JSON.parse(data.responseText);
      
          // for (var i = 0; i < data.length; i++) {
          //   if(data[i].category_name==$("#mode").val())
          //     displayLocation(data[i]);
          // }
          categoryChanged();
      if(!req){
        map.fitBounds(bounds);
          map.panToBounds(bounds);
      }
      });
      
      // map.setCenter(userLocation);
     if(!req&&!status){
       window.setTimeout(function() {
        map.panTo(myMarker.getPosition());
      }, 1000);
      setTimeout(function(){map.setZoom(10);},1000);
     }


  }

  function rightMenu(map){
    if($('#toggle-traffic-layer').prop('checked')){
      // Display traffic layer maps
        var trafficLayer = new google.maps.TrafficLayer();
      trafficLayer.setMap(map);
    }
    
    if($('#toggle-weather-layer').prop('checked')){
      // Display weather layer maps
      var weatherLayer = new google.maps.weather.WeatherLayer({temperatureUnits: google.maps.weather.TemperatureUnit.celsius});
        weatherLayer.setMap(map);
    }

      if($('#toggle-panoramio-layer').prop('checked')){
        // Display panoramio layer maps
        var panoramioLayer = new google.maps.panoramio.PanoramioLayer();
        panoramioLayer.setMap(map);
      }
    
    if($('#toggle-transit-layer').prop('checked')){
      // Display transit layer maps
        var transitLayer = new google.maps.TransitLayer();
        transitLayer.setMap(map);
      }
    
    if($('#toggle-bike-layer').prop('checked')){
      // Display bike layer maps
        var bikeLayer = new google.maps.BicyclingLayer();
        bikeLayer.setMap(map);
      }
  }

  function categoryChanged(){
    removeMarkerTemp();
      for(var i=0; i<categoryMarkerList.length;i++){
        if(categoryMarkerList[i].category_name==$("#mode-category").val()){
          displayLocation(categoryMarkerList[i]);
        }
      }
  }
  function removeMarkerTemp(){
    for (var i = 0; i < markerTemp.length; i++) {
        markerTemp[i].setMap(null);
      }
      // alert(markerTemp.length);
      markerTemp = [];
  }
  // Display maps markers 
  function displayLocation(location) {

      var content =   '<div class="infoWindow"><strong>'  + location.markers_name + '</strong>'
                      + '<br/>'     + location.category_name
                      + '<br/>'     + location.markers_address + '</div>';
       
      if (parseInt(location.markers_lat) == 0) {
          geocoder.geocode( { 'address': location.markers_address }, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                   
                  var marker = new google.maps.Marker({
                      map: map,
            icon: urlRequest+"upload/marker/"+location.category_marker,
                      position: results[0].geometry.location,
                      title: location.markers_name
                  });
          
                  bounds.extend(marker.position); 
                  google.maps.event.addListener(marker, 'click', function() {
                      infowindow.setContent(content);
                      infowindow.open(map,marker);
                  });
          // markers.push(marker);
          markerTemp.push(marker);
              }
          });
      } else {
           
          var position = new google.maps.LatLng(parseFloat(location.markers_lat), parseFloat(location.markers_lng));
          var marker = new google.maps.Marker({
              map: map,
              icon: urlRequest+"upload/marker/"+location.category_marker,
              position: position,
              title: location.markers_name
          });
          bounds.extend(marker.position); 
          google.maps.event.addListener(marker, 'click', function() {
              infowindow.setContent(content);
              infowindow.open(map,marker);
          });
      // markers.push(marker);
          markerTemp.push(marker); 
      }

  }
  // Get calculate route maps
  function calculateRoute(lng,lat) {
    
    var destination = new google.maps.LatLng(lat,lng);
    
      var request = {
          origin: userLocation,
          destination: destination,
          travelMode: google.maps.DirectionsTravelMode.DRIVING
      };
    
      directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
          }
      });
  }
   

  function getRequest(url, callback) {
    // $('.loading').show();
      var request;
      if (window.XMLHttpRequest) {
          request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
      } else {
          request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
      }
      request.onreadystatechange = function() {
          if (request.readyState == 4 && request.status == 200) {
              callback(request);
        // $('.loading').hide();
          }
      }
      request.open("GET", url, true);
      request.send();
  }

  function getCalculateRoute(lng,lat){
    window.location.href = "#page_location_map";
    setTimeout('init("false","1")',2500);
    calculateRoute(lng,lat)
  }

  function getLocationRoute(lng,lat){
    window.location.href = "#page_location_route";
    init("false","1");
    setTimeout('init("false","1")',2500);
    calculateRoute(lng,lat)
  }
    
  function getLocationCategory(){
    $('#list-category').empty();
    var url = urlService+'service/get_category';
    $("#mode-category").empty();
    getRequest(url, function(data) {
          var data = JSON.parse(data.responseText);         
          for (var i = 0; i < data.length; i++) {
              $('#list-category').append("<li onClick='getLocationList("+data[i]['category_id']
                +")'><a transition='side' href='#page_detail'><div class='fs1' aria-hidden='true' data-icon='"
              +data[i]['category_icon']+"'></div><strong>"+data[i]['category_name']
              +"</strong><span class='chevron'></span><span class='count'>"+data[i]['count']+"</span></a></li>");
              $("#mode-category").append("<option value='"+data[i]['category_name']+"'>"+data[i]['category_name']+"</option>");
          }

    });
  }

  // Get geolocation list
  function getLocationList(categoryId){
    $('#search-list').val('');
    $('#list-detail').empty();
    $('#category-id').val(categoryId);
    var url = urlService+'service/get_list?id='+categoryId;
    getRequest(url, function(data) {
          var data = JSON.parse(data.responseText);         
          for (var i = 0; i < data.length; i++) {
              $('#list-detail').append("<li onClick='detailShowLocation("+data[i]['markers_id']
                +")'><a transition='side' href='#page_show_location'><strong>"+data[i]['markers_name']
              +"</strong><p>"+data[i]['markers_address']+"</p><span class='chevron'></span></a></li>");
      }

    });
  }

  // Get filter list
  function getFilterList(){

    var categoryId = $('#category-id').val();
    var filter     = $('#search-list').val();
    
    var url = urlService+'service/get_list?id='+categoryId+"&q="+filter;
    getRequest(url, function(data) {
          var data = JSON.parse(data.responseText);        
      $('#list-detail').empty();
          for (var i = 0; i < data.length; i++) {
               $('#list-detail').append("<li onClick='detailShowLocation("+data[i]['markers_id']+")'><a transition='side' href='#page_show_location'><strong>"+data[i]['markers_name']+"</strong><p>"+data[i]['markers_address']+"</p><span class='chevron'></span></a></li>");
      }

    });
  }
  // Get filter list
  function getFilterListNearby(){
     if($('#toggle-nearby-distances').prop('checked')){
      var distances = "mil";
    }else{
      var distances = "km";
    }

    var filter     = $('#search-list-nearby').val();
    
    var url = urlService+'service/get_nearby_search?lat='+myLat+"&long="+myLong+"&option="+distances+"&q="+filter;
    getRequest(url, function(data) {
          var data = JSON.parse(data.responseText);        
      $('#list-nearby').empty();
      $('#list-nearby').append("<li class='list-dividers'>Near "+address+"</li>");
      
          for (var i = 0; i < data.length; i++) {
        var logo = urlRequest+"/upload/logo/"+data[i]['markers_logo'];
            $('#list-nearby').append("<li onClick='detailShowLocation("+data[i]['markers_id']+")'><a transition='side' href='#page_show_location'><strong>"+data[i]['markers_name']+"</strong><p>"+data[i]['markers_address']+"</p><span class='distance'>"+data[i]['distance']+" "+ distances +"</span><div class='img-box'><img src='"+logo+"' width='60' height='60'></div></a></li>");
        
      }

    });
  }

  // Get nearby location
  function getNearby(){
    if($('#toggle-nearby-distances').prop('checked')){
      var distances = "mil";
    }else{
      var distances = "km";
    }
    
    var url = urlService+'service/get_nearby?lat='+myLat+"&long="+myLong+"&option="+distances;
    getRequest(url, function(data) {
          var data = JSON.parse(data.responseText);        
      $('#list-nearby').empty();
      $('#list-nearby').append("<li class='list-dividers'>Near "+address+"</li>");
      
          for (var i = 0; i < data.length; i++) {
        var logo = urlRequest+"/upload/logo/"+data[i]['markers_logo'];
            $('#list-nearby').append("<li onClick='detailShowLocation("+data[i]['markers_id']+")'><a transition='side' href='#page_show_location'><strong>"+data[i]['markers_name']+"</strong><p>"+data[i]['markers_address']+"</p><span class='distance'>"+data[i]['distance']+" "+ distances +"</span><div class='img-box'><img src='"+logo+"' width='60' height='60'></div></a></li>");
        
      }

    });
  }

  var now = Math.round(new Date().getTime() / 1000); // Get timestamp

  var selected_index = -1; //Index of the selected list item

  var tbSaveLocation = localStorage.getItem("tbSaveLocation");//Retrieve the stored data

  tbSaveLocation = JSON.parse(tbSaveLocation); //Converts string to object

  if(tbSaveLocation == null) //If there is no data, initialize an empty array
    tbSaveLocation = [];

  function addMyLocation(){
    var client = JSON.stringify({
      Title : $("#form-title").val(),
      Desc : $("#form-desc").val(),
      Lon : myLong,
      Lat : myLat,
      Location : address,
      Dates : now
    });
    
    tbSaveLocation.push(client);
    localStorage.setItem("tbSaveLocation", JSON.stringify(tbSaveLocation)); 
    alert("The data was saved.");
    return true;
  }


  function listMyLocation(){
    $('#list-save-location').empty();
    $('.loading').hide();
    $('#show-location-address').html("Near : "+address);
    for(var i in tbSaveLocation){
      var cli = JSON.parse(tbSaveLocation[i]);
      
      var date = new Date(cli.Dates * 1000);
      
      $('#list-save-location').append("<li><span onClick='detailListMyLocation("+i+")'><strong>"+cli.Title+"</strong><p>"+date.toLocaleString()+"</p></span><a onClick='deleteMyLocation("+i+");' class='button-negative'>Delete</a></li>");

    }
  }

  function detailListMyLocation(selected_index){
    
    window.location.href = "#page_detail_save_location";
    
    var cli   = JSON.parse(tbSaveLocation[selected_index]);
    var date  = new Date(cli.Dates * 1000);
    var pw    = $(window).width(); 
    var ph    = $(window).height();
    
    $("#page_detail_save_location .slider ul").empty();
    $("#page_detail_save_location .slider ul").append('<li><img style="width:'+pw+'px;height:'+ph+'px"src="http://maps.googleapis.com/maps/api/staticmap?center='+cli.Lat+','+cli.Lon+'&markers=color:blue|label:S|'+cli.Lat+','+cli.Lon+'&zoom=15&size='+pw+'x'+ph+'&sensor=false&scale=2"></li>');
    // $("#page_detail_save_location .slider ul").append('<li><img src="http://maps.googleapis.com/maps/api/streetview?size='+pw+'x230&location='+myLat+','+myLong+'&fov=90&heading=235&pitch=10&sensor=false"></li>');
    
    $("#date-save-location").html(date);
    $("#title-save-location").html(cli.Title);
    $("#address-save-location").html(cli.Location);
    $("#desc-save-location").html(cli.Desc);
    $("#button-save-location").html('<a onClick="getMyLocationMap('+cli.Lon+','+cli.Lat+')" class="button-positive button-block" href="#page_location_map">Map View</a>');
  }


  function detailShowLocation(id){
    $('#show-images').empty();
    var url = urlService+'service/get_detail?id='+id;
    getRequest(url, function(data) {
        var data = JSON.parse(data.responseText);        
        for (var i = 0; i < data.length; i++) {
        
        var urlGetImages = urlService+'service/get_images?id='+data[i]['markers_id'];
        
        getRequest(urlGetImages, function(dataImages) {
                         
            var dataImages = JSON.parse(dataImages.responseText);        
              for (var i = 0; i < dataImages.length; i++) {
              $('#show-images').append('<li><img src="'+urlRequest+'upload/images/'+dataImages[i]['images_url']+'"></li>');
            }
        });
        var pw  = $(window).width(); 
         var ph  = $(window).height();
         var lat = data[i]['markers_lat']
          var lng = data[i]['markers_lng'];
        //Generate location images
        $("#page_show_location .slider ul").empty();
        $("#page_show_location .slider ul").append('<li><img style="width:'+pw+'px; height:'+ph+'px" src="http://maps.googleapis.com/maps/api/staticmap?center='+lat+','+lng+'&markers=color:red|label:S|'+lat+','+lng+'&zoom=15&size='+pw+'x'+ph+'&sensor=false&scale=2"></li>');//220
        
        $('#btn-show-map').attr('onClick','getShowLocation('+data[i]['markers_lng']+','+data[i]['markers_lat']+',"'+data[i]['category_marker']+'")');
        $('#btn-show-street').attr('onClick','getStreetView('+data[i]['markers_lng']+','+data[i]['markers_lat']+')');
        $('#btn-show-directions').attr('onClick','getCalculateRoute('+data[i]['markers_lng']+','+data[i]['markers_lat']+')');
        $('#btn-show-route').attr('onClick','getLocationRoute('+data[i]['markers_lng']+','+data[i]['markers_lat']+')');
        
        $("#title-show-category").html(data[i]['category_name']);
        $("#title-show-name").html(data[i]['markers_name']);
        $("#title-show-phone").html(data[i]['markers_phone']);
        $("#title-show-url").html(data[i]['markers_url']);
        $("#title-show-address").html(data[i]['markers_address']);
        $("#title-show-desc").html(data[i]['markers_desc']);
        $("#button-show-location").html('<a onClick="getMyLocationMap('+lng+','+lat+')" class="button-positive button-block" href="#page_location_map">Map View</a>');
      }

    });

    $('.loading').hide();
  }

  function deleteMyLocation(selected_index){
    if (confirm('Are you sure you want to remove entry?')) {
      tbSaveLocation.splice(selected_index, 1);
      localStorage.setItem("tbSaveLocation", JSON.stringify(tbSaveLocation));
      //alert("Client deleted.");
      listMyLocation();
    }
  }

  function addMarkers(lon,lat,icon){
    if(icon){
      icon = "img/pin/"+icon;
    }else{
      icon = "img/pin/pin2.png";
    }
    var getLocation = new google.maps.LatLng(lat,lon);
    map.setCenter(new google.maps.LatLng(lat, lon));
    map.setZoom(15);
    
    var marker = new google.maps.Marker({
      map: map,
      icon: icon,
      position: getLocation,
      animation: google.maps.Animation.DROP,
      title: "test"
    });
    markers.push(marker);

  }

  function addMarkersFriend(pos,icon,mess){
    var domImg1 = new Image(),
        domImg2 = new Image(),
        domImg3 = new Image();
    var images = [domImg1, domImg2, domImg3],
        j = 0;
    var marker1,marker2,marker3;
    for (i in images) {
        images[i].onload = function() {
            if (++j == 3) {
                // set marker where current user is
                var image1 = new google.maps.MarkerImage('img/pin/marker.png');
                marker1 = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: pos,
                    map: myMap,
                    icon: image1,
                    zIndex: 1
                });
                
                // display the user avatar
                // var image2 = new google.maps.MarkerImage('http://dl.dropbox.com/u/1597153/00000000000000000000000000000000.png', null, null, new google.maps.Point(16, 49));
                var image2 = {
                  // url: 'http://api.vncgame.com:8080/query/avatar/84945355179',
                  url: icon,
                  // This marker is 20 pixels wide by 32 pixels tall.
                  size: new google.maps.Size(32, 32),
                  // The origin for this image is 0,0.
                  origin: new google.maps.Point(0,0),
                  // The anchor for this image is the base of the flagpole at 0,32.
                  // anchor: new google.maps.Point(0, 32)
                  anchor: new google.maps.Point(16,49),
                  //Scale Size
                  scaledSize: new google.maps.Size(32, 32)
                };
                marker2 = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: pos,
                    map: myMap,
                    icon: image2,
                    zIndex: 2
                });

                // also display avatar frame on top of the avatar above
                var image3 = new google.maps.MarkerImage('img/pin/pin-white.png');
                marker3 = new google.maps.Marker({
                    animation: google.maps.Animation.DROP,
                    position: pos,
                    map: myMap,
                    icon: image3,
                    zIndex: 3
                });

                marker3.setMap(myMap);
                marker2.setMap(myMap);
                marker1.setMap(myMap);
                markersFriend.push(marker2); 
                geocodeListFriend(userLocation);
                myMarker=marker2;
                attachMessage(marker3,mess);
                // window.setTimeout(function() {
                //   myMap.panTo(myMarker.getPosition());
                // }, 1000);
            }
        }
    }
            
    // domImg1.src = "http://dl.dropbox.com/u/1597153/00000000000000000000000000000000.png";
    domImg1.src = urlAvatar+"84945355179";
    domImg2.src = "img/pin/pin-white.png";
    domImg3.src = "img/pin/marker.png";
  }
  function getMyLocationMap(lon,lat){
    setTimeout('init("false")',2500);
    setTimeout('addMarkers('+lon+','+lat+')',2500);
  }

  function getShowLocation(lon,lat,icon){
    window.location.href = "#page_location_map";
    setTimeout('init("false")',2500);
    setTimeout('addMarkers('+lon+','+lat+',"'+icon+'")',2500);
  }

  function getStreetView(lon,lat){
    window.location.href = "#page_location_map";
    setTimeout('init("false","","true")',2500);
    streetPlace = new google.maps.LatLng(lat, lon);

  }
//
  function myMap() {
    var mapOptions = {
      zoom: 10,
      // center: userLocation,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    myMap = new google.maps.Map(document.getElementById('my_map_canvas'),
        mapOptions);
    $('.loading').hide();
    // Try HTML5 geolocation
    if(navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        myLat   = position.coords.latitude;
        myLong  = position.coords.longitude;
        myRadius  = position.coords.accuracy;
        userLocation = new google.maps.LatLng(position.coords.latitude,
                                         position.coords.longitude);
        
        // Set marker location user
          // var marker = new google.maps.Marker({
          //             map: myMap,
          //       icon: "img/pin/pin1.png",
          //             position: userLocation,
          //       // animation:google.maps.Animation.BOUNCE
          // });
        // // Set accuracy location user
        //   var circle = new google.maps.Circle({
        //       center: userLocation,
        //       radius: myRadius,
        //       map: myMap,
        //       fillColor: '#FF3300',
        //       fillOpacity: 0.2,
        //       strokeColor: '#FF3300',
        //       strokeOpacity: 0.4
        //   });
      //
              myMap.setCenter(userLocation);
              var status= '<div class="infoWindow"><strong>Me</strong></div>'
              var icon = "img/pin/0000.png";
              addMarkersFriend(userLocation,icon,status);
             
        // myMap.fitBounds(circle.getBounds());
        // myMap.fitBounds(marker1.getBounds());
        // setTimeout(function(){map.setZoom(15);},1000);
        // markersFriend.push(marker1); 
        // geocodeListFriend(userLocation);
        // myMarker=marker1;
        // // attachMessage(marker1,'<div class="infoWindow"><strong>Me</strong></div>');
        // window.setTimeout(function() {
        //   myMap.panTo(myMarker.getPosition());
        // }, 1000);

      }, function() {
        handleNoGeolocation(true);
      });
    } else {
      // Browser doesn't support Geolocation
      handleNoGeolocation(false);
      
    }
  }
  //
  function displayListFriend(){
       var url = urlService+'service/get_list_friend';
        getRequest(url, function(data) {
            var data = JSON.parse(data.responseText);  
            var icon;       
            for (var i = 0; i < data.length; i++) {
                iconLevel=parseInt(data[i].member_level)+2;
                iconSos=parseInt(data[i].member_sos)+2;
                iconPhone=data[i].member_phone;
                if(data[i].member_avatar==null){
                  icon="img/pin/0000.png";
                }else{
                  // icon="img/pin/pin"+iconPhone+".png";
                  icon=urlAvatar+iconPhone;
                }
                var position = new google.maps.LatLng(parseFloat(data[i].member_latitude), parseFloat(data[i].member_longitude));
                // geocodeListFriend(position);
                // var marker = new google.maps.Marker({
                //   map: myMap,
                //   icon: "img/pin/pin"+icon2+".png",
                //   position: position,
                //   title: data[i].member_status
                // });
                // markersFriend.push(marker); 
                //bounds.extend(marker.position);
                var content =   '<div class="infoWindow" ><strong>'  + data[i].member_phone + '</strong>'
                        + '<br/>'     + data[i].member_fname
                        + '<br/>'     + data[i].member_lname 
                        + '<br/>'     + data[i].member_update
                        + '<br/>'     + data[i].member_latitude
                        + '<br/>'     + data[i].member_longitude
                        + '<br/>'     + data[i].member_status +    '</div>';
                // style="width:100px;height:120px;"
                // attachMessage(marker,content);
                addMarkersFriend(position,icon,content);
                // markersFriend.push(marker);  
            }
      });
    }
//
//List friend
  function showListFriend() {
    $(".loading").show();
    myMap();
    var mapControls = document.getElementById('map-controls');
    input = /** @type {HTMLInputElement} */(document.getElementById('pac-input'));
    input2 = /** @type {HTMLInputElement} */(document.getElementById('pac-input2'));
    mapControls.style.display = 'block';
    myMap.controls[google.maps.ControlPosition.TOP_RIGHT].push(mapControls);
    displayListFriend();
    getVictim();
    rightMenu(myMap);
    $(".loading").hide();
    directionsDisplay.setMap(myMap);
    directionsDisplay.setPanel(document.getElementById('directions-route'));
  }
  // showListFriend();
  // The five markers show a secret message when clicked
  // but that message is not within the marker's instance data
  function attachMessage(marker,content) {
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(content);
        infowindow.open(marker.get('map'),marker);
    });
  }
//ReFresh
  // Sets the map on all markers in the array.
  function setAllMap(map) {
    for (var i = 0; i < markersFriend.length; i++) {
      markersFriend[i].setMap(map);
    }
  }

  // Removes the markers from the map, but keeps them in the array.
  function clearMarkers() {
    setAllMap(null);
  }

  // Shows any markers currently in the array.
  function showMarkers() {
    setAllMap(myMap);
  }

  // Deletes all markers in the array by removing references to them.
  function deleteMarkers() {
    clearMarkers();
    markersFriend = [];
  }
  //
  function trackingListFriend(){
    // myMarker=markersFriend[0];
    // addMarkersFriend(userLocation,,)
    deleteMarkers();
    markersFriend.push(myMarker);
    displayListFriend();
    showMarkers();
  }
  //
  var t;
  var timer_is_on = 0;

  function refreshMap() {
      trackingListFriend();
      t = setTimeout(function(){refreshMap()}, 10000);
  }

  function startRefresh() {
      if (!timer_is_on) {
          timer_is_on = 1;
          refreshMap();
      }
  }

  function stopRefresh() {
      clearTimeout(t);
      timer_is_on = 0;
  }
//directions friend
  function calcRoute() {
    var selectedMode = document.getElementById('mode').value;
    var start = $("#pac-input").val();
    var end = $("#pac-input2").val();
    directionsDisplay.setMap(myMap);
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.TravelMode[selectedMode]
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      }
    });
  }

  function geocodeListFriend(pos){
    geocoder.geocode( { 'latLng': pos}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
          address =  results[0].formatted_address;
          addressList.push(address);
          }
      });
  }
  //Remove
  function  removeDirection(){
    directionsDisplay.setMap(null);
  }
  function removeMarkerStartEnd(){
    for (var i = 0; i < markerStartEnd.length; i++) {
        markerStartEnd[i].setMap(null);
      }
      markerStartEnd = [];
  }
//display user curent location
  function initialize() {
      var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));
      var searchBox2 = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input2));

  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markerStartEnd[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markerStartEnd.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });
// Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox2, 'places_changed', function() {
    var places = searchBox2.getPlaces();

    if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markerStartEnd[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    // markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: myMap,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markerStartEnd.push(marker);

      bounds.extend(place.geometry.location);
    }

    myMap.fitBounds(bounds);
  });
  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(myMap, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
  }

//Victim
  function getVictim(){
    var url = urlService+'service/get_victims';
    getRequest(url, function(data) {
        var data = JSON.parse(data.responseText);  
          $('#list-victim').empty();
          if(data.length==0)flag=0;
          for (var i = 0; i < data.length; i++) {
              flag=1;
               var content="<li><table style='width:100%'>"
               +"<tr><td rowspan='3'><div class='img-victim'><img src='"+urlAvatar+data[i]['member_phone']+"' width='60' height='60'></div></td>"
               +"<td ><strong>"+data[i]['member_phone']+"</strong></td>"
               +"</tr><tr><td ><p>"+data[i]['member_fname']+" "+data[i]['member_lname']+"</p>"
               +"</td></tr><tr><td><span class='distance'>"+data[i]['member_status']+" "+ ""+"</span></td></tr></table>";
               // +"<div class='img-victim'><img src='"+"ee"+"' width='60' height='60'></div><strong>"+data[i]['member_phone']+"</strong><p>"+data[i]['member_fname']+"</p><span class='distance'>"+data[i]['member_status']+" "+ ""+"</span>";
               var savior=data[i]['member_savior'];
                if(savior==""){
                  content+="<div class='img-box' style='width=30%'><a class='button' id='help-btn' onClick='displayVictim("+data[i]['member_id']+")'>Help</div></li>";
                }else{
                  content+="<div class='img-box'style='width=30%'>Savior: "+data[i]['member_savior']+"</div></li>";
                }
               $('#list-victim').append(content);
          }
    });
  }
 
  function victimFlag(){
    getVictim();
    if(flag==1){
      $("#victim").addClass("help");
    }else{
      $("#victim").removeClass("help");
    }
    setTimeout("victimFlag()",10000)
  }

  function displayVictim(id){
    window.location.href="#page_home";
    var url = urlService+'service/get_victim?id='+id;
    getRequest(url, function(data) {
        var data = JSON.parse(data.responseText);        
        for (var i = 0; i < data.length; i++) {
          var position = new google.maps.LatLng(parseFloat(data[i].member_latitude), parseFloat(data[i].member_longitude));
          for(var j=0;j<markersFriend.length;j++){
            if(data[i].member_latitude==markersFriend[j].position.lat()){
               var pos=markersFriend[j].getPosition();
              window.setTimeout(function() {
                myMap.panTo(pos);
              }, 2000);
              window.setTimeout(function(){myMap.setZoom(10);},3000);
            }
          } 
        }
    });
  }
