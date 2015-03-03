//lang eng
function lang_eng(){
	$('#home').text('Home');
	$('#location-map').text('Location Map');
	$('#nearby').text('Nearby');
	$('#location-list').text('Location List');
	$('#save-location').text('Save My Location');
	$('#nearby-setting').text('Nearby Setting');
	$('#page-victim').text('Support');
	$('#victim').text('Support');
	$('#refresh').text('Tracking');
	$('#stop-refresh').text('Stop');
	$('#distances-units').text('Distances Units');
	$('#km-mil').html(function(index,oldHtml){
		return oldHtml.replace('KM &nbsp;&nbsp; Dặm','KM &nbsp;&nbsp; MIL');
	});
	$('#maps-layer-setting').text('Maps Layer Setting');
	$('#traffic-layer').text('Traffic Layer');
	//$('#on-off-1').text('ON &nbsp;&nbsp; OFF');
	$('#on-off-1').html(function(index,oldHtml){
		return oldHtml.replace('Mở &nbsp;&nbsp; Tắt','ON &nbsp;&nbsp; OFF');
	});
	$('#on-off-2').html(function(index,oldHtml){
		return oldHtml.replace('Mở &nbsp;&nbsp; Tắt','ON &nbsp;&nbsp; OFF');
	});
	$('#on-off-3').html(function(index,oldHtml){
		return oldHtml.replace('Mở &nbsp;&nbsp; Tắt','ON &nbsp;&nbsp; OFF');
	});
	$('#on-off-4').html(function(index,oldHtml){
		return oldHtml.replace('Mở &nbsp;&nbsp; Tắt','ON &nbsp;&nbsp; OFF');
	});
	$('#on-off-5').html(function(index,oldHtml){
		return oldHtml.replace('Mở &nbsp;&nbsp; Tắt','ON &nbsp;&nbsp; OFF');
	});
	$('#weather-layer').text('Weather Layer');
	$('#transit-layer').text('Transit Layer');
	$('#panoramio-layer').text('Panoramio Layer');
	$('#bike-layer').text('Bike Layer');
	$('#custom-direction').text('Direction');
	$('#mode-direction').text('Mode');
	$('#route-direction').text('Route');
	$('#remove-direction').text('Remove');
	$('#go-to-direction').text('Go');
	$('#driving').text('Driving');
	$('#walking').text('Walking');
	$('#bicycling').text('Bicycling');
	$('#transit').text('Transit');
	$('#check-in').text('Check In');
	$('#date').text('Date');
	$('#location').text('Location');
	$('#title').text('Title');
	$('#description-1').text('Description');
	$('#description-2').text('Description');
	$('#form-add').text('Add Entry');
	$('#show-location-address').text('No Detect Location');
	$('#btn-show-map').text('Map');
	$('#btn-show-street').text('Street');
	$('#btn-show-directions').text('Directions');
	$('#btn-show-route').text('Route');
	$('#category').text('Category');
	$('#phone').text('Phone');
	$('#url').text('Url');
	$('#address').text('Address');
	$('#form-title').attr('placeholder','Title');
	$('#form-desc').attr('placeholder','Description');
	$('#pac-input').attr('placeholder','Start..');
	$('#pac-input2').attr('placeholder','End..');
	$('#search-list').attr('placeholder','Search..');
	$('#search-list-nearby').attr('placeholder','Search..');
	$('#advance-search').text('Advance Search');
	$('#top-text').text('Top');
	$('#range-text').text('Range (km)');
};
function lang_viet(){
	$('#home').text('Trang Chủ');
	$('#location-map').text('Bản Đồ');
	$('#nearby').text('Gần Bạn');
	$('#location-list').text('Danh Sách Địa Chỉ');
	$('#save-location').text('Địa Chỉ Của Tôi');
	$('#page-victim').text('Hỗ trợ');
	$('#victim').text('Hỗ trợ');
	$('#refresh').text('Theo dõi');
	$('#stop-refresh').text('Tạm dừng');
	$('#nearby-setting').text('Cài Đặt');
	$('#distances-units').text('Đơn Vị Đo Lường');
	$('#km-mil').html(function(index,oldHtml){
		return oldHtml.replace('KM &nbsp;&nbsp; MIL','KM &nbsp;&nbsp; Dặm');
	});
	$('#maps-layer-setting').text('Cài Đặt Bản Đồ');
	$('#traffic-layer').text('Giao Thông');
	$('#on-off-1').html(function(index,oldHtml){
		return oldHtml.replace('ON &nbsp;&nbsp; OFF','Mở &nbsp;&nbsp; Tắt');
	});
	$('#on-off-2').html(function(index,oldHtml){
		return oldHtml.replace('ON &nbsp;&nbsp; OFF','Mở &nbsp;&nbsp; Tắt');
	});
	$('#on-off-3').html(function(index,oldHtml){
		return oldHtml.replace('ON &nbsp;&nbsp; OFF','Mở &nbsp;&nbsp; Tắt');
	});
	$('#on-off-4').html(function(index,oldHtml){
		return oldHtml.replace('ON &nbsp;&nbsp; OFF','Mở &nbsp;&nbsp; Tắt');
	});
	$('#on-off-5').html(function(index,oldHtml){
		return oldHtml.replace('ON &nbsp;&nbsp; OFF','Mở &nbsp;&nbsp; Tắt');
	});
	$('#weather-layer').text('Thời Tiết');
	$('#transit-layer').text('Đường');
	$('#panoramio-layer').text('Địa Hình');
	$('#bike-layer').text('Xe Đạp');
	$('#custom-direction').text('Direction');
	$('#mode-direction').text('Phương tiện');
	$('#route-direction').text('Route');
	$('#remove-direction').text('Xoá');
	$('#go-to-direction').text('Tìm kiếm');
	$('#driving').text('Xe ôtô');
	$('#walking').text('Đi bộ');
	$('#bicycling').text('Xe đạp');
	$('#transit').text('Xe bus');
	$('#check-in').text('Tạo mới');
	$('#date').text('Ngày');
	$('#location').text('Điạ Chỉ');
	$('#title').text('Tiêu Đề');
	$('#description-1').text('Mô Tả');
	$('#description-2').text('Mô Tả');
	$('#form-add').text('Thêm');
	$('#show-location-address').text('Địa Chỉ Không Tồn Tại');
	$('#btn-show-map').text('Bản Đồ');
	$('#btn-show-street').text('Street');
	$('#btn-show-directions').text('Chỉ Dẫn');
	$('#btn-show-route').text('Hướng Dẫn');
	$('#category').text('Danh Mục');
	$('#phone').text('Điện Thoại');
	$('#url').text('Địa Chỉ Web');
	$('#address').text('Địa Chỉ');
	$('#form-title').attr('placeholder','Tiêu đề');
	$('#form-desc').attr('placeholder','Mô tả');
	$('#pac-input').attr('placeholder','Từ..');
	$('#pac-input2').attr('placeholder','Đến..');
	$('#search-list').attr('placeholder','Tìm kiếm..');
	$('#search-list-nearby').attr('placeholder','Tìm kiếm..');
	$('#advance-search').text('Tìm kiếm nâng cao');
	$('#top-text').text('Số lượng danh sách');
	$('#range-text').text('Khoảng cách (km)');
};
function loadScript_eng() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'http://maps.google.com/maps/api/js?sensor=false&libraries=weather,panoramio&language=en-GB';
  document.body.appendChild(script);
}
function loadScript_viet() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'http://maps.google.com/maps/api/js?sensor=false&libraries=weather,panoramio&language=vi';
  document.body.appendChild(script);
}

//window.onload = loadScript_viet;
$(document).ready(function(){
	//language english
	$('#lang-eng').click(function(){
		localStorage.setItem('langs','lang-eng');
		//loadScript_eng();
		$("#lang-viet >img").css({'opacity': 0.4});
		$("#lang-eng >img").css({'opacity': 1});
		lang_eng();
	});
	//language vietname
	$('#lang-viet').click(function(){
		localStorage.setItem('langs','lang-viet');
		//loadScript_viet();
		$("#lang-eng >img").css({'opacity': 0.4});
		$("#lang-viet >img").css({'opacity': 1});
		lang_viet();
	});
	//
	if(localStorage.getItem('langs')!='lang-viet'){
		//loadScript_eng();
		lang_eng();
		$("#lang-viet >img").css({'opacity': 0.4});
		$("#lang-eng >img").css({'opacity': 1});
	}else{
		//loadScript_viet();
		lang_viet();
		$("#lang-eng >img").css({'opacity': 0.4});
		$("#lang-viet >img").css({'opacity': 1});

	}
	if(localStorage.getItem('langs')!='lang-viet'){
		
	}else{
		
	}
});
	