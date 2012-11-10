<!DOCTYPE html>
<html>
<head>
	<title><?php echo $layout_title; ?></title>
	<?php echo implode ("\n", $layout_headers); ?>
</head>
<body>
	<h1><?php echo $layout_heading; ?></h1>
	<?php echo $layout_contents; ?>
	<div style="background:#ddcccc;"><?php echo implode ("\n", $layout_debug); ?></div>
</body>
</html>
