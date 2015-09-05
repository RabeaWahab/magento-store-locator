// on keyup event check ZipCode
$$('#zipcode').invoke('observe','keyup',function(){
    var fieldValue = this.value;
    if(fieldValue.length == 5) {
        codeAddress(fieldValue);
    }
});

// initialize the map and make an ajax request to grab the store from the backend
var map;
function initialize() {
	var mapOptions = {
		zoom: 4,
		center: new google.maps.LatLng(37.09024, -95.712891),
		mapTypeId: 'roadmap'
	};

	var bounds = new google.maps.LatLngBounds();

	var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

	map.setTilt(45);

	new Ajax.Request('<?php echo Mage::getUrl("storelocator/index/stores"); ?>', {
			onSuccess: function(response) {
				var stores = JSON.parse(response.transport.response);
				console.log(stores);

				var marker, i;
				var infowindow = new google.maps.InfoWindow();
                var address = '';

				for(i=0; i < stores.length; i++) {
					var longitude = String(stores[i].longitude);
					var latitude  = String(stores[i].latitude);

                    if(longitude.length > 0 && latitude.length > 0) {
    		            var myLatlng = new google.maps.LatLng(latitude, longitude);
    		            bounds.extend(myLatlng);

    		            marker = new google.maps.Marker({
    			            position: myLatlng,
    			            map: map,
    			            title: '<div><strong>' + String(stores[i].name) + '</strong></div>'
    			        });

                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
    						return function() {
                              var content = '<div style="color: #000;"><strong>' + stores[i].name + '</strong><div>' + stores[i].address + '</div></div>';
    						  infowindow.setContent(content);
    						  infowindow.open(map, marker);
    						}
    					})(marker, i));
                    }
				}

				map.fitBounds(bounds);
			}
	});

	// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });

    window.map = map;
}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyAEsXZMr4cGtydPkINR3ub_TAGhkECICuw' +
      '&callback=initialize';
  document.body.appendChild(script);
}

function codeAddress(zipCode) {
    var geocoder= new google.maps.Geocoder();
    var address = zipCode;
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            if (typeof customerMarker !== 'undefined') customerMarker.setMap(null);
            customerMarker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });

            map.setZoom(10);
            map.panTo(customerMarker.position);
        } else {
            console.log('Geocode was not successful for the following reason: ' + status);
        }
    });
  }


function sortByDist(a,b) {
   return (a.distance- b.distance)
}

window.onload = loadScript;
