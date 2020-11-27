var geoserverUrl = "http://185.4.132.140:8082/geoserver/";
var selectedPoint = null;

var source = null;
var target = null;

// initialize our map
/*var map = L.map("map", {
	center: [37.95441751769712, 23.680601119995117],
	//center: [-1.2836622060674874, 36.822524070739746],
	zoom: 17 //set the zoom level
});*/

//add openstreet map baselayer to the map
/*var OpenStreetMap = L.tileLayer(
	'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
	//"http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
	{
		maxZoom: 23,
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'

		//attribution:
			//'&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}
).addTo(map);*/

// empty geojson layer for the shortes path result
var pathLayer = L.geoJSON(null);
// draggable marker for starting point. Note the marker is initialized with an initial starting position
var sourceMarker = L.marker([37.95181188681797,23.683648109436035], {
//var sourceMarker = L.marker([-1.283147351126288, 36.822524070739746], {
	draggable: true
})
	.on("dragend", function(e) {
		selectedPoint = e.target.getLatLng();
		getVertex(selectedPoint);
		getRoute();
	})
	.addTo(map);

// draggbale marker for destination point.Note the marker is initialized with an initial destination positon
var targetMarker = L.marker([37.94954457436226, 23.677167892456055], {
//var targetMarker = L.marker([-1.286107765621784, 36.83449745178223], {
	draggable: true
})
	.on("dragend", function(e) {
		selectedPoint = e.target.getLatLng();
		getVertex(selectedPoint);
		getRoute();
	})
	.addTo(map);


// function to get nearest vertex to the passed point
function getVertex(selectedPoint) {
	var url = `${geoserverUrl}/wfs?service=WFS&version=1.0.0&request=GetFeature&typeName=mosxato:nearest_vertex&outputformat=application/json&viewparams=x:${
		selectedPoint.lng};y:${selectedPoint.lat};`;
	$.ajax({
		url: url,
		async: false,
		//method: "POST",
		success: function(data) {
			//console.log(data);
			loadVertex(
				data,
				selectedPoint.toString() === sourceMarker.getLatLng().toString()
			);
		},
		error: function() { alert('Failed!'); }
	});
}

// function to update the source and target nodes as returned from geoserver for later querying
function loadVertex(response, isSource) {
	//console.log(response.features);
	var features = response.features;
	map.removeLayer(pathLayer);
	if (isSource) {
		source = features[0].properties.id;
	} else {
		target = features[0].properties.id;
	}
}

// function to get the shortest path from the give source and target nodes
function getRoute() {
	var url = `${geoserverUrl}/wfs?service=WFS&version=1.0.0&request=GetFeature&typeName=mosxato:shortest_path&outputformat=application/json&viewparams=source:${source};target:${target};`;

	$.getJSON(url, function(data) {
		//console.log(data.features.properties.time);
		var timed = 0;
		var dist = 0;
		

		for (var key in data.features) {
			timed += data.features[key].properties.time;
			dist += data.features[key].properties.distance;
		};
		// alert("Time to travel: " +roundToTwo(timed*60) + " minutes"+ "\nDistance to travel: "+Math.round(dist*1000)+" meters");
		map.removeLayer(pathLayer);
		pathLayer = L.geoJSON(data, {onEachFeature: onEachFeature});
		
		pathLayer.bindPopup("<strong>Εκτιμώμενος χρόνος: </strong>" +roundToTwo(timed*60) + " λεπτά" +  "<br /><strong>Απόσταση:</strong> "+Math.round(dist*1000)+" μέτρα");
		
		map.addLayer(pathLayer);
		//pathLayer.bindPopup("<strong>Εκτιμώμενος χρόνος: </strong>" +roundToTwo(timed*60) + " λεπτά" +  "<br /><strong>Απόσταση:</strong> "+Math.round(dist*1000)+" μέτρα").openPopup();
		
		
	});
}

function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}
function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#666',
        dashArray: '',
        fillOpacity: 0.7
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }
}
function resetHighlight(e) {
    pathLayer.resetStyle(e.target);
}
function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
		mouseout: resetHighlight
	    });
}
getVertex(sourceMarker.getLatLng());
getVertex(targetMarker.getLatLng());
getRoute();

