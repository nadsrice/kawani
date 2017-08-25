<style>

	/* Always set the map height explicitly to define the size of the div
	* element that contains the map. */
	#map {
		height: 400px;
        width: 100%;
	}

	/* Optional: Makes the sample page fill the window. */
	html, body {
		height: 100%;
		margin: 0;
		padding: 0;
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<div id="map"></div>
	</div>
</div>
<script>

	var x = document.getElementById("map");

	function initMap() {

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(setPosition, showError);
		} else { 
			alert("Geolocation is not supported by this browser.");
			x.innerHTML = "Geolocation is not supported by this browser.";
		}

		function setPosition(position) {

			var uluru = {lat: position.coords.latitude, lng: position.coords.longitude};
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 18,
				center: uluru
			});
			var marker = new google.maps.Marker({
				position: uluru,
				map: map
			});
		}

		function showError(error) {
			switch(error.code) {
				case error.PERMISSION_DENIED:
					x.innerHTML = "User denied the request for Geolocation."
				break;
				case error.POSITION_UNAVAILABLE:
					x.innerHTML = "Location information is unavailable."
				break;
				case error.TIMEOUT:
					x.innerHTML = "The request to get user location timed out."
				break;
				case error.UNKNOWN_ERROR:
					x.innerHTML = "An unknown error occurred."
				break;
			}
		}
	}
</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGsSD33vkcDefMwknNjM3LA_ZDYD9p6rs&callback=initMap" async defer></script>