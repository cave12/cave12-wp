jQuery(document).ready(function($){
	
	 $("a[href^=http]").each(
	   function(){ 
	          if(this.href.indexOf(location.hostname) == -1) {
	      $(this).attr('target', '_blank');
	    }
	  }
	 ) 
	 
	 // SHOW-HIDE STUFF
	 
	$(".show-hide-action").click(function(){
		//$(this).replaceWith('<a href="#" class="hide-hide-action">moins d\'infos</a>');
		$(".show-hide").show("1000");
		$(".instant-show").show();
		$(this).hide();
		return false;
	});
	 
	 
	$(".hide-hide-action").click(function(){
	 	//$(this).replaceWith('<a href="#" class="show-hide-action">plus d\'infos</a>');
	 	$(".show-hide").hide("1000");
	 	$(".show-hide-action").show();
	 	$(".instant-show").hide();
	 	return false;
	 });
	
	
	
	// code pour formulaire mailing-liste:
	
	function clearForm() { document.formulaire.email.value = "nom@adresse";
	document.formulaire.email.select();}
	
	// show mailing-list form
	
	
	$("label.prop-item-label").click(function(){
		$(".newsletter-form .form-text,.newsletter-form .button").show();
		$(".newsletter-form .form-text").focus();
		$(".newsletter-form").addClass("form-padding");
	//	return false;
	});
	
	 
	 
	// AJAX loader for maps 
	 
	 $('#map-loaderXXXX').click(function(){ // info
	  		var toLoad = $(this).attr('href')+' #contenu .texte';
	  		$('#map-container').show('fast');
	  		// $('#map-container .content').html('<div class="ajax-loading"></div>');
	 		$('#map-container').load(toLoad, function() {
	 		// $('#map-container').show('fast');
	 		// loadGmapScript();
	 			//alert('defining vars');
	 			// now we must get the variables...
	 			locCaveLat = $('#data-storage').data('lat');
	 			locCaveLong = $('#data-storage').data('long');
	 			locCaveTitle = $('#data-storage').data('marker');
	 			//alert('vare Lat: '+ locCaveLat);
	 		// window.onload();
	 			loadGmapScriptAjax();
	 		}); // end Load
	 		return false;
	 }); // end
	 
	
	$('#map-loader').toggle(function() {
	  var toLoad = $(this).attr('href')+' #contenu .texte';
	  	$('#map-container').show();
	  	// $('#map-container .content').html('<div class="ajax-loading"></div>');
	  $('#map-container').load(toLoad, function() {
	  // $('#map-container').show('fast');
	  // loadGmapScript();
	  	//alert('defining vars');
	  	// now we must get the variables...
	  	locCaveLat = $('#data-storage').data('lat');
	  	locCaveLong = $('#data-storage').data('long');
	  	locCaveTitle = $('#data-storage').data('marker');
	  	//alert('vare Lat: '+ locCaveLat);
	  // window.onload();
	  	loadGmapScriptAjax();
	  }); // end Load
	  return false;
	}, function() {
		$('#map-container').hide();
	  // alert('Second handler for .toggle() called.');
	});


}); // end document ready


// Google Maps Function

function initialize() {

// CUSTOM :

// var locCave12 = new google.maps.LatLng(46.211807,6.141577); //6.141577,46.211807

//var locCaveLat = '46.211807';
//var locCaveLong = '6.141577';
//var locCaveTitle = 'L Ecurie';

var locCave12 = new google.maps.LatLng(locCaveLat,locCaveLong);


// Create an array of styles.
var styles = [
{ "featureType": "road.arterial",
	"elementType": "geometry",
	"stylers": [
	{ "visibility": "on" },
	{ "color": "#ffffff" } ] },
	{ "elementType": "labels.text.stroke",
	"stylers": [ { "visibility": "on" },
	{ "color": "#ffffff" } ] },
{ "featureType": "landscape.man_made", "stylers": [ { "color": "#d4d2cd" } ] },
{ "featureType": "water", "stylers": [ { "visibility": "on" },
	{ "color": "#808080" } ] },
{ "featureType": 'poi.park',
	"stylers": [ { "visibility": "on" },
	{ "color": "#bcdeb5" } ] },
{ "featureType": "poi.business",
	"elementType": "all",
	"stylers": [ { "visibility": "off" } ] },
// { "featureType": "road.arterial", "elementType": "labels", "stylers": [ { "visibility": "off" } ] },
// { "featureType": "road.local", "elementType": "labels", "stylers": [ { "visibility": "off" } ] },
// { "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ] },
// { "featureType": "administrative", "elementType": "labels", "stylers": [ { "visibility": "off" } ] },
];


// Create a new StyledMapType object, passing it the array of styles,
// as well as the name to be displayed on the map type control.
var styledMap = new google.maps.StyledMapType(styles,
{name: "Plan"});

// Create a map object, and include the MapTypeId to add
// to the map type control.

var mapOptions = {
center: locCave12,
zoom: 15,
panControl: false,
zoomControl: true,
//zoomControlOptions: { style: google.maps.ZoomControlStyle.SMALL },
zoomControlOptions: { style: google.maps.ZoomControlStyle.LARGE },
mapTypeControl: true,
mapTypeControlOptions: {
style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
mapTypeIds: [ 'map_style', google.maps.MapTypeId. HYBRID ] },
streetViewControl: false,
// zoomControl: true,
// mapTypeControlOptions: {
// mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style'] }
mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map(document.getElementById("map_canvas"),
mapOptions);

var marker = new google.maps.Marker({
position: locCave12,
map: map,
title: locCaveTitle,
});

//Associate the styled map with the MapTypeId and set it to display.
map.mapTypes.set('map_style', styledMap);
map.setMapTypeId('map_style');

}

function loadGmapScriptAjax() {
	// c12vars(); 
	// alert ('c12vars loaded:  '+ locCaveTitle);
	// alert('locCaveLa:'+ locCaveLat);
	var script = document.createElement("script");
	script.type = "text/javascript";
	script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCEJxiLc0qlowfZNYGcm7Hz2OXMvobK6mE&sensor=false&callback=initialize";
	document.body.appendChild(script);
}

function loadGmapScriptLocal() {
	c12vars(); 
	// alert ('c12vars loaded:  '+ locCaveLat);
	var script = document.createElement("script");
	script.type = "text/javascript";
	script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCEJxiLc0qlowfZNYGcm7Hz2OXMvobK6mE&sensor=false&callback=initialize";
	document.body.appendChild(script);
}