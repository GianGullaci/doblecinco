<?php 
	include("includes/session.php");
	include("includes/coneccion.php");
	include("includes/functions.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>elFinder 2.0</title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/smoothness/jquery-ui.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/elfinder.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/theme.css">

		<!-- elFinder JS (REQUIRED) -->
		<script type="text/javascript" src="js/elfinder/js/elfinder.min.js"></script>

		<!-- elFinder translation (OPTIONAL) -->
		<script type="text/javascript" src="js/elfinder/js/i18n/elfinder.ru.js"></script>

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
			
			
			var keyStr = "ABCDEFGHIJKLMNOP" +
               "QRSTUVWXYZabcdef" +
               "ghijklmnopqrstuv" +
               "wxyz0123456789-_" +
               ".";

			function decode64(input) {
				 var output = "";
				 var chr1, chr2, chr3 = "";
				 var enc1, enc2, enc3, enc4 = "";
				 var i = 0;

				 // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
				 var base64test = /[^A-Za-z0-9\+\/\=]/g;
				 if (base64test.exec(input)) {
					alert("There were invalid base64 characters in the input text.\n" +
						  "Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" +
						  "Expect errors in decoding.");
				 }
				 input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

				 do {
					enc1 = keyStr.indexOf(input.charAt(i++));
					enc2 = keyStr.indexOf(input.charAt(i++));
					enc3 = keyStr.indexOf(input.charAt(i++));
					enc4 = keyStr.indexOf(input.charAt(i++));

					chr1 = (enc1 << 2) | (enc2 >> 4);
					chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
					chr3 = ((enc3 & 3) << 6) | enc4;

					output = output + String.fromCharCode(chr1);

					if (enc3 != 64) {
					   output = output + String.fromCharCode(chr2);
					}
					if (enc4 != 64) {
					   output = output + String.fromCharCode(chr3);
					}

					chr1 = chr2 = chr3 = "";
					enc1 = enc2 = enc3 = enc4 = "";

				 } while (i < input.length);

				 return unescape(output);
			  }
		
		
			$().ready(function() {
				var elf = $('#elfinder').elfinder({
					url : 'js/elfinder/php/connector.php',  // connector URL (REQUIRED)
					/*handlers : {
						add : function(event, elfinderInstance) {
						// // 		      console.log(event.data);
						// // 		      console.log(event.data.added[0]); 
						// // 		      console.log(event.data.added[0].mime); // tipo de achivo/dir
						// // 		      console.log(event.data.added[0].name); // nombre de lo que agrego
						// // 		      console.log(event.data.added[0].phash); // path codificado
						// // 		      console.log((event.data.added[0].phash).substring(3)); // path codificado sin el prefijo
									for (index = 0, len = event.data.added.length; index < len; ++index) {
										if (event.data.added[index].mime=="directory"){
											// console.log("save dir");
											var path = decode64((event.data.added[index].phash).substring(3));			  
											var nombre = event.data.added[index].name;
											var hash = event.data.added[index].hash;
											$.ajax({
												 method: "POST",
												 url: "save-folder.php",
												 data: { name: nombre, path:  path.replace(/[^A-Za-z0-9 ,.]/ig, ''), hash: hash}
											})
										}
									}
						},
						remove : function(event, elfinderInstance) {      
						// console.log("del dir");
									for (index = 0, len = event.data.removed.length; index < len; ++index) {
										hash = event.data.removed[index];
										$.ajax({
											 method: "POST",
											 url: "delete-folder.php",
											 data: { hash: hash }
										})
									}
						}
					}*/
				}).elfinder('instance');
			});
		</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>
