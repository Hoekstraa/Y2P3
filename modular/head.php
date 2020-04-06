<head>
	<meta charset="utf-8">
	<title>Ritsema Banken - <?php echo htmlspecialchars($title) ?></title>
	<meta name="description" content="$Description">
	<meta name="author" content="Ritsema Banken">
	
	<?php
	$css_dir='./css/';
		if (is_dir($css_dir)){
			if ($dh = opendir($css_dir)){
				while (($file = readdir($dh)) !== false){
					echo '<link rel="stylesheet" href="' . $css_dir . $file . '">';
				}
				closedir($dh);
			}
		}
	?>
	<!-- FontAwesome Free 5.4.1 -- local is broken for now -->
	<!-- <link rel="stylesheet" href="css/fontawesome.css"> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
	<!-- <link rel="stylesheet" href="css/pure-min.css"> -->
	<!-- <link rel="stylesheet" href="css/custom.css"> -->
	<!-- <script src="js/scripts.js"></script> -->
</head>
