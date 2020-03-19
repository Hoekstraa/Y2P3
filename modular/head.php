<head>
	<meta charset="utf-8">
	<title>Ritsema Banken - <?php echo $title ?></title>
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
	<!-- <link rel="stylesheet" href="css/pure-min.css"> -->
	<!-- <link rel="stylesheet" href="css/custom.css"> -->
	<!-- <script src="js/scripts.js"></script> -->
</head>
