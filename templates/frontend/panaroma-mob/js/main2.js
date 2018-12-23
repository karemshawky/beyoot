window.onload = function() {
	loadPredefinedPanorama();
};
// Load the predefined panorama
function loadPredefinedPanorama() {
	"use strict";
	// Loader
	var loader = document.createElement('div');
	loader.className = 'loader';
	// Panorama display
	var div = document.getElementById('360_container');
	if ( div ){
		div.style.height = '30px';
		var data = document.getElementById('data').value.toString();
	}
	PSV = new PhotoSphereViewer({
		// Path to the panorama
		panorama: data,
		// Container
		container: div,
		// Deactivate the animation
		time_anim: false,
		// Display the navigation bar
		navbar: true,
		// Resize the panorama
		size: {
			width: '100%',
			height: '500px'
		},
		// HTML loader
		loading_html: loader,
		// Disable smooth moves to test faster
		smooth_user_moves: false
	});
}
// Yep, an ugly global variable (to make tests with the console)
var PSV;