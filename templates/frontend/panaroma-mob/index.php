<!DOCTYPE html>
<html>
 
 <head>
  <meta charset="utf-8" />
  <title>Photo Sphere Viewer</title>
  <meta name="viewport" content="initial-scale=1.0" />
  <link rel="stylesheet" href="<?= FrontEndUrl ?>panaroma-mob/css/main.css" />
  <meta http-equiv="Content-Security-Policy"> 
 </head>
 
 <body>
  <div id="content">
   <div id="container"></div>   
      <input id="data" type="hidden" name="country" value="<?= IMG . '360/' . $data; ?>">
  </div>
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- External library -->
  <script src="<?= FrontEndUrl ?>panaroma-mob/js/three.min.js"></script>
  <!-- External library, but included in the build -->
  <script src="<?= FrontEndUrl ?>panaroma-mob/js/sphoords.js"></script>
  <!-- Photo Sphere Viewer files -->
  <script src="<?= FrontEndUrl ?>panaroma-mob/js/PhotoSphereViewer.js"></script>
  <script src="<?= FrontEndUrl ?>panaroma-mob/js/PSVNavBar.js"></script>
  <script src="<?= FrontEndUrl ?>panaroma-mob/js/PSVNavBarButton.js"></script>
 
  <!-- Main script -->
  <script src="<?= FrontEndUrl ?>panaroma-mob/js/main.js"></script>
 
 </body>
</html>