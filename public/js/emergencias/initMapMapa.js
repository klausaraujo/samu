var lat = -9.318990;
var lon = -75.234375;

var escAncho = screen.width;
var escAlto = screen.height;
var escala = 12;
if (escAncho == 1920 && escAlto == 1080)
	var escala = 12;
if (escAncho == 1680 && escAlto == 1050)
	var escala = 12;
if (escAncho == 1600 && escAlto == 900)
	var escala = 12;
if (escAncho == 1440 && escAlto == 900)
	var escala = 12;
if (escAncho == 1400 && escAlto == 1050)
	var escala = 12;
if (escAncho == 1360 && escAlto == 768)
	var escala = 12;
if (escAncho == 1280 && escAlto == 1024)
	var escala = 12;
if (escAncho == 1024 && escAlto == 768)
	var escala = 10;
if (escAncho == 800 && escAlto == 600)
	var escala = 10;

var map;
var mapMarkers = new Array();
var mapMarkersFull = new Array();
var mapMarkersFullPolygon = new Array();
var djperu;

var polygonFill = ["#4CAF50", "#f3eb2c", "#ee2cf3", "#2c3ef3", "#2cacf3",
	"#2cf3de", "#2cf367", "#f32c2c", "#f3a12c", "#f36a2c", "#a7694d",
	"#60a74d", "#4d9ca7", "#4d55a7", "#834da7", "#a74d84", "#a74d4d",
	"#fba1a1", "#fbc5a1", "#a1f8fb", "#a1b5fb", "#e0a1fb", "#8e1010",
	"#bfd20f", "#fba1a1"];

function polyBorderColor(x, val, estado) {
	var color = '#AD4545';
	var anchoBorde = 1;
	var borde = 2;
	var colorFondo = '#FFF';
	var opacidad = 0;
	var numOpacity = 0.4;
	switch (x) {
		case 1:
			if (val == 6 || val == 42) {
				colorFondo = '#F0CEBC';
				color = '#F09291';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 2:
			if (val == 32) {
				colorFondo = '#92F5BC';
				color = '#37D791';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 3:
			if (val == 32) {
				colorFondo = '#D8C0F1';
				color = '#C294CA';
				opacidad = numOpacity
			}
			break;
		case 4:
			if (val == 32) {
				colorFondo = '#92F5BC';
				color = '#37D791';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 5:
			if (val == 5 || val == 32) {
				colorFondo = '#C1C0EB';
				color = '#9594ED';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 6:
			if (val == 6 || val == 32) {
				colorFondo = '#F4EE90';
				color = '#EFEC3E';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 7:
			break;
		case 8:
			if (val == 5 || val == 9 || val == 14 || val == 25 || val == 28
				|| val == 32 || val == 46) {
				colorFondo = '#96A989';
				color = '#426932';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 9:
			if (val == 32) {
				colorFondo = '#CCC';
				color = '#424242';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 10:
			if (val == 5 || val == 19 || val == 32 || val == 37 || val == 45) {
				colorFondo = '#89BB94';
				color = '#529A6C';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 11:
			break;
		case 12:
			if (val == 5 || val == 32 || val == 9 || val == 29 || val == 45) {
				colorFondo = '#C1C0C7';
				color = '#9392A8';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 13:
			break;
		case 14:
			if (val == 32) {
				colorFondo = '#CCC';
				color = '#424242';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 15:
			if (val == 10 || val == 18 || val == 32) {
				colorFondo = '#969CEA';
				color = '#4250EE';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 16:
			if (val == 1 || val == 4 || val == 6 || val == 7 || val == 8
				|| val == 11 || val == 16 || val == 20 || val == 22
				|| val == 23 || val == 24 || val == 26 || val == 27
				|| val == 30 || val == 31 || val == 33 || val == 34
				|| val == 36 || val == 37 || val == 38 || val == 39
				|| val == 40 || val == 41 || val == 42 || val == 43
				|| val == 46) {
				colorFondo = '#92C7BC';
				color = '#3CE293';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 17:
			if (val == 2 || val == 3 || val == 13 || val == 14 || val == 15
				|| val == 25 || val == 37 || val == 46) {
				colorFondo = '#F0EF94';
				color = '#F0EF43';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 18:
			if (val == 2 || val == 32) {
				colorFondo = '#F0C0F1';
				color = '#F093FA';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 19:
			if (val == 5 || val == 32 || val == 45) {
				colorFondo = '#C191BC';
				color = '#933691';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 20:
			break;
		case 21:
			if (val == 2 || val == 32) {
				colorFondo = '#F0EF94';
				color = '#F0EF43';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 22:
			if (val == 8 || val == 6 || val == 36) {
				colorFondo = '#D3A894';
				color = '#B86342';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 23:
			if (val == 2) {
				colorFondo = '#CCC';
				color = '#424242';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
		case 24:
			break;
		case 25:
			if (val == 3 || val == 5 || val == 12 || val == 17 || val == 19
				|| val == 21 || val == 35 || val == 37 || val == 44
				|| val == 46 || val == 47) {
				colorFondo = '#E48D90';
				color = '#D85942';
				opacidad = numOpacity;
				anchoBorde = borde
			}
			break;
	}
	color = '#AD4545';
	if (estado == 'fondo')
		return colorFondo;
	if (estado == 'color')
		return color;
	if (estado == 'opacity')
		return opacidad;
	if (estado == 'borde')
		return anchoBorde;

}

var addListenersOnPolygon = function (polygon, ubicacion, departamento) {
	google.maps.event
		.addListener(
			polygon,
			'click',
			function (event) {
				$("#dataMapModalTitle").text(ubicacion);
				tbEventos.rows().remove().draw();
				tbVulnerable.rows().remove().draw();
				tbEESS.rows().remove().draw();
				tbRecursos.rows().remove().draw();
				tbCIE10.rows().remove().draw();
				$(
					"#tbEventos_wrapper,#tbVulnerable_wrapper,#tbEESS_wrapper,#tbRecursos_wrapper,#tbCIE10_wrapper")
					.css("display", "none");
				$(".mensaje p").html("No hay registros");
				$("#dataMapModal").modal("show");
				$("#departamento").val(departamento);
			});
	google.maps.event.addListener(polygon, "mouseover", function () {
		polygon.setOptions({
			fillOpacity: 0.85
		});
	});
	google.maps.event.addListener(polygon, "mouseout", function () {
		polygon.setOptions({
			fillOpacity: 0.35
		});
	});
}

function cargarPoligonos(val) {

	cont = 0;
	for (x = 1; x <= 25; x++) {
		var coordenadas_peru = djperu[x].coord;
		var ubicacion = djperu[x].desc;
		var departamento = djperu[x].id;
		console.log(coordenadas_peru.length);
		for (i = 0; i < coordenadas_peru.length; i++) {

			var polydj = new google.maps.Polygon({
				paths: coordenadas_peru[i],
				fillColor: polygonFill[x - 1],
				fillOpacity: 0.35,
				strokeColor: polyBorderColor(x, val, 'color'),
				strokeOpacity: 1,
				strokeWeight: polyBorderColor(x, val, 'borde'),
				visible: true,
				clickable: true
			});

			polydj.setMap(map);
			addListenersOnPolygon(polydj, ubicacion, departamento);
			mapMarkersFullPolygon[cont] = polydj;
			cont++;

		}
	}
}

function initMap() {

	var map = new google.maps.Map(document.getElementById('map'), {
		center: {
			lat: -11.8232637,
			lng: -75.6175247
		},
		zoom: generalZoom
	});
	
	var input = document.getElementById('ubicacion');

	var autocomplete = new google.maps.places.Autocomplete(input);
	autocomplete.bindTo('bounds', map);

	var infowindow = new google.maps.InfoWindow();
	var marker = new google.maps.Marker({
		map: map,
		anchorPoint: new google.maps.Point(0, -29),
		draggable: true,
		position: new google.maps.LatLng(-11.8232637, -75.6175247)
	});

	var geocoder = new google.maps.Geocoder();

	autocomplete
		.addListener(
			'place_changed',
			function () {
				infowindow.close();
				marker.setVisible(true);
				var place = autocomplete.getPlace();

				if (!place.geometry) {
					window
						.alert("No se encuentra la ubicaci\xf3n: '"
							+ place.name
							+ "', intente colocando una zona cercana y moviendo el marcador rojo");
					return;
				}

				if (place.geometry.viewport) {
					map.fitBounds(place.geometry.viewport);
				} else {
					map.setCenter(place.geometry.location);
					map.setZoom(15);
				}
				marker.setIcon(({
					url: place.icon,
					size: new google.maps.Size(71, 71),
					origin: new google.maps.Point(0, 0),
					anchor: new google.maps.Point(17, 34),
					scaledSize: new google.maps.Size(35, 35)
				}));
				marker.setPosition(place.geometry.location);
				marker.setVisible(true);

				var address = '';
				if (place.address_components) {
					address = [
						(place.address_components[0]
							&& place.address_components[0].short_name || ''),
						(place.address_components[1]
							&& place.address_components[1].short_name || ''),
						(place.address_components[2]
							&& place.address_components[2].short_name || '')]
						.join(' ');
				}
				/*infowindowContent.children["place-name"].textContent = place.name;
				infowindowContent.children["place-address"].textContent = place.formatted_address;*/
				infowindow.setContent('<div><strong>' + place.name
					+ '</strong><br>' + address);
				infowindow.open(map, marker);

				lat = marker.getPosition().lat();
				lng = marker.getPosition().lng();

				document.getElementById("latitud").value = lat;
				document.getElementById("longitud").value = lng;

			});

	google.maps.event.addListener(marker, "dragend", function (event) {

		lat = marker.getPosition().lat();
		lng = marker.getPosition().lng();

		document.getElementById("latitud").value = lat;
		document.getElementById("longitud").value = lng;

		geocoder.geocode({
			'latLng': marker.getPosition()
		}, function (results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var address = results[0]['formatted_address'];
			}
		});

	});

	google.maps.event.addListener(map, 'zoom_changed', function () {
		generalZoom = map.getZoom();
	});

	var distrito = document.getElementById("distrito");

	google.maps.event
		.addDomListener(
			distrito,
			"change",
			function () {

				var geocoder = new google.maps.Geocoder();

				var distritoV = distrito.value;
				if (distritoV.length > 1) {
					var departamentoT = document
						.getElementById('departamento').options[document
							.getElementById('departamento').selectedIndex].text;
					var distritoT = document.getElementById('distrito').options[document
						.getElementById('distrito').selectedIndex].text;
					var ubicacion = distritoT + ", " + departamentoT
						+ ", Peru";
					geocoder
						.geocode(
							{
								"address": ubicacion
							},
							function (data) {
								var lat = data[0].geometry.location
									.lat();
								var lng = data[0].geometry.location
									.lng();
								var origin = new google.maps.LatLng(
									lat, lng);
								document
									.getElementById('latitud').value = lat;
								document
									.getElementById('longitud').value = lng;
								marker.setPosition(origin);
								map.setCenter(origin);
								map.setZoom(15);

							});
				}

			});
}

function initialize(lat, lon, esc, val) {

	var peru = new google.maps.LatLng(lat, lon);

	var mapDiv = document.getElementById('map');
	map = new google.maps.Map(mapDiv, {
		center: peru,
		zoom: esc,
		mapTypeId: google.maps.MapTypeId.TERRAIN,
		minZoom: 15,
		scrollwheel: true,
		disableDefaultUI: false,
		streetViewControl: false,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL
		}

	});

	var strictBounds = new google.maps.LatLngBounds(new google.maps.LatLng(
		-18.309, -81.342), new google.maps.LatLng(-0.08, -68.704));

	google.maps.event
		.addListener(
			map,
			'dragend',
			function () {
				if (strictBounds.contains(map.getCenter()))
					return;

				var c = map.getCenter(), x = c.lng(), y = c.lat(), maxX = strictBounds
					.getNorthEast().lng(), maxY = strictBounds
						.getNorthEast().lat(), minX = strictBounds
							.getSouthWest().lng(), minY = strictBounds
								.getSouthWest().lat();

				if (x < minX)
					x = minX;
				if (x > maxX)
					x = maxX;
				if (y < minY)
					y = minY;
				if (y > maxY)
					y = maxY;

				map.setCenter(new google.maps.LatLng(y, x));
			});
	var input = document.getElementById('location');
          var autocomplete = new google.maps.places.Autocomplete(
            input,
            {types: ['geocode']}
          );
	// cargarPoligonos(val);

}