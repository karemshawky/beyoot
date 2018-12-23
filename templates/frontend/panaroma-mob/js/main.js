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
	var div = document.getElementById('container');
	div.style.height = '30px';
	var data = document.getElementById('data').value.toString();
	console.log("The Data is : " + data);
	PSV = new PhotoSphereViewer({
		// Path to the panorama
		panorama: data,
		// Container
		container: div,
		// Deactivate the animation
		time_anim: false,
		// Display the navigation bar
		navbar: false,
		zoom_level: 20,
		navbar_style: {
			buttonsHeight: 0
		},
		// Resize the panorama
		size: {
			width: '100%',
			height: '100vh'
		},
		// HTML loader
		loading_html: loader,
		// Disable smooth moves to test faster
		smooth_user_moves: true
	});
}
// Yep, an ugly global variable (to make tests with the console)
var PSV;