<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Heatmaps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel {
        background-color: #fff;
        border: 1px solid #999;
        left: 25%;
        padding: 5px;
        position: absolute;
        top: 10px;
        z-index: 5;
      }
    </style>
  </head>

  <body>
    <div id="floating-panel">
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <button onclick="changeRadius()">Change radius</button>
      <button onclick="changeOpacity()">Change opacity</button>
	  <button onclick="viewTotalEntries()">Total entries</button>
    </div>
    <div id="map"></div>
    <script>

      var map, heatmap, totalEntries;
	  var WeightedCoordinates = [];
	  
	  function downloadUrl(url, callback) {
            var request = window.ActiveXObject ?
                    new ActiveXObject('Microsoft.XMLHTTP') :
                    new XMLHttpRequest;
            request.onreadystatechange = function() {
                if (request.readyState == 4) {
                    request.onreadystatechange = doNothing;
                    callback(request, request.status);
                }
            };
            request.open('GET', url, true);
            request.send(null);
        }
        function doNothing() {
        }
		
		downloadUrl("PhpToXmlConvertor.php", function(data) {
			//window.alert("Checkpoint 2");
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName("marker");
			totalEntries = markers.length;
            for (var i = 0; i < markers.length; i++) {
				//window.alert("Checkpoint 1");
				lat = parseFloat(markers[i].getAttribute("latitude"));
				//window.alert(lat);
                lng = parseFloat(markers[i].getAttribute("longitude"));
				//window.alert(lng);
				co = parseFloat(markers[i].getAttribute("CO"));
				so2 = parseFloat(markers[i].getAttribute("SO2"));
				combined = co + so2;
				//window.alert(co);
				//coordinates = new google.maps.LatLng(lat, lng);
				//window.alert("Hello" . coordinates);
				WeightedCoordinates.push({location: new google.maps.LatLng(lat, lng), weight: combined});
				//WeightedCoordinates.push(new google.maps.LatLng(lat, lng));
				//console.log(lat, lng);
				//document.write(lat);
				//window.alert(lat);
            }
        });

      function initMap() {
		  //window.alert("Checkpoint 1");
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 30.6904641, lng: 76.8434015},
          mapTypeId: 'satellite'
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
          data: getPoints(),
          map: map
        });
      }

      //window.alert(1);
	  function toggleHeatmap() {
        heatmap.setMap(heatmap.getMap() ? null : map);
      }
	  
	  function viewTotalEntries(){
		  window.alert(totalEntries);
	  }

      function changeGradient() {
        var gradient = [
          'rgba(0, 255, 255, 0)',
          'rgba(0, 255, 255, 1)',
          'rgba(0, 191, 255, 1)',
          'rgba(0, 127, 255, 1)',
          'rgba(0, 63, 255, 1)',
          'rgba(0, 0, 255, 1)',
          'rgba(0, 0, 223, 1)',
          'rgba(0, 0, 191, 1)',
          'rgba(0, 0, 159, 1)',
          'rgba(0, 0, 127, 1)',
          'rgba(63, 0, 91, 1)',
          'rgba(127, 0, 63, 1)',
          'rgba(191, 0, 31, 1)',
          'rgba(255, 0, 0, 1)'
        ]
        heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
      }

      function changeRadius() {
        heatmap.set('radius', heatmap.get('radius') ? null : 5);
      }

      function changeOpacity() {
        heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
      }

      // Heatmap data: 500 Points
      function getPoints() {
		  return WeightedCoordinates;
        /*return [
          new google.maps.LatLng(37.776743, -122.412186),
          new google.maps.LatLng(37.776440, -122.411800),
          new google.maps.LatLng(37.776295, -122.411614),
          new google.maps.LatLng(37.776158, -122.411440),
          new google.maps.LatLng(37.775806, -122.410997),
          
        ];*/
      }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBdecn3geITgeaXDx0vRNox3xk3Xpf8Gho&libraries=visualization&callback=initMap">
    </script>
  </body>
</html>