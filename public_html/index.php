<!DOCTYPE html>
<html>
<head>
    <script src="js/jquery-1.10.2.js"></script>  
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true"></script>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
	
</head>

<body>

	<!--
	<p>Click the button to get your position:</p>
	<button onclick="getLocation()">Try It</button>
	-->
	<div id="context">
		<div id="banner">
        	<div id="banner_title">Find Way In Bentley - Twitter Prototype v0.1</div>
       		<div id="banner_right"><div id="tweet_home"><a href="https://twitter.com/share" data-hashtags="findmywaybentley" data-count="horizontal" 
                data-counturl="http://isaacfindmayway.comli.com" class="twitter-share-button" data-lang="en">Tweet</a></div>
            </div>
		</div>
		<div id="content">
			
			<div id="map-canvas"></div>
			<div id="map-content">
				<div id="demoCoord"></div>
				<div id="errorMessage"></div>
			</div>
		</div>
	</div>
    
    
	<!-- tweet button js script-->
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	
	<script>
		/*
		 * identify device type and store id in mobileDeviceId
		 * Id|Device
		 *  0|Others
		 *  1|iPhone           
		 *  2|iPad             
		 *  3|Mobile Android  
		 *  4|Tablet Android   
		 */
		function getMobileDeviceId(){
			var result = 0
			if (navigator.userAgent.indexOf('iPhone') > 0 ) result = 1; // iPhone
			else if (navigator.userAgent.indexOf('iPad') > 0 ) result = 2; // iPad
			else if (navigator.userAgent.indexOf('Android') > 0 &&
			 navigator.userAgent.indexOf('Mobile') > 0) result = 3;// Mobile Android
			else if (navigator.userAgent.indexOf('Android') > 0 ) result = 4; // Tablet Android
			return result;
		}
		var mobileDeviceId = getMobileDeviceId();

		var cssPath = "/css/common.css";
		
		if (mobileDeviceId > 0)
			cssPath = "/css/common_mobile.css";
		
		var fileref = document.createElement("link");
		
		fileref.setAttribute("rel", "stylesheet");
		fileref.setAttribute("type", "text/css");
		fileref.setAttribute("href", cssPath);
		
		document.getElementsByTagName("head")[0].appendChild(fileref);
	</script>
    
	<script>
	// script for loading Google Map and Coordinates
		var browserSupportFlag =  new Boolean();
		
		var myOptions = {
			zoom: 16,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

		var demoCoordText=document.getElementById("demoCoord");

		function initialize() {

		  // Try W3C Geolocation (Preferred)
		  if(navigator.geolocation) {
			browserSupportFlag = true;
			
			//navigator.geolocation.getCurrentPosition(showCurrentPosInMap, function() {handleNoGeolocation(browserSupportFlag);}, {		
			//enableHighAccuracy: true 
			//});
			
			navigator.geolocation.watchPosition(handleSuccess, function() {handleNoGeolocation(browserSupportFlag);}, {		
			enableHighAccuracy: true 
			});
		  }
		  // Browser doesn't support Geolocation
		  else {
			browserSupportFlag = false;
			handleNoGeolocation(browserSupportFlag);
		  }
		}
		
		// handle success from geolocation get current location
		function handleSuccess(position){
			showCurrentPosInMap(position);
			showCurrentPosCoord(position);
		}
		
		var infowindow;
		// display current position in map
		function showCurrentPosInMap(position) {
		  var location = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
		  
		  	// info window
				infowindow = new google.maps.InfoWindow({
				map: map,
				position: location,
				content: 'Tweet here: <div id="tweet_info"><a href="https://twitter.com/share" data-hashtags="findmywaybentley" data-count="horizontal" data-counturl="http://isaacfindmayway.comli.com" class="twitter-share-button" data-lang="en">Tweet</a></div>'
			  });
			
			var marker = new google.maps.Marker({
				position: location,
				title: 'Your Location',
				map: map
			});
		  
		  map.setCenter(location);
		  
			// for info box's tweet button
			google.maps.event.addListener(infowindow, 'domready', function(event) {
			!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];
			if(!d.getElementById(id)){js=d.createElement(s);js.id=id;
			js.src="//platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
			alert(234);
			});
			  
		}
		
		// display current position coordinates
		function showCurrentPosCoord(position){
		  demoCoordText.innerHTML="Latitude: " + position.coords.latitude +
		  "<br>Longitude: " + position.coords.longitude;
		}

		  
		function handleNoGeolocation(errorFlag) {
			var location = new google.maps.LatLng(60, 105);
			var options = {
				map: map,
				position: location,
				content: "Failed to find your location"
			};
		  
			var infowindow = new google.maps.InfoWindow(options);
			map.setCenter(location);

		}
		google.maps.event.addDomListener(window, 'load', initialize);

	</script>
	
	
</body>

</html>
