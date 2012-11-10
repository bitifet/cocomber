<?php
namespace CocomberFramework;


$rt_ui = '';		// UI to execute.
$rt_tpl = '';		// Template to apply.
$rt_layout = '';	// Layout to encapsulate.


// Read path info:
$path = ltrim ($_SERVER['PATH_INFO'], '/');

if (
	// Starting page:
	! strlen ($path)
) {

	$rt_ui = "pages/default.ui.php";
	$rt_tpl = "pages/default.tpl.php";
	$rt_layout = "default.layout.php";

} else {

	// Extract extension if any.
	preg_match (
		'/^(.+?)(?:\.([^.]+)?)?$/',
		basename ($path),
		$matches
	);
	@list ($foo, $ui, $ext) = $matches;
	strlen ($d = dirname ($path)) && $ui = "{$d}/{$ui}";

	switch (strtolower($ext)) {
	case 'php':
	case'html':
		$rt_ui = "pages/{$ui}.ui.php";
		$rt_tpl = "pages/{$ui}.tpl.php";
		$rt_layout = 'default.layout.php';
		break;
	case '':
		$rt_ui = "widgets/{$ui}.ui.php";
		$rt_tpl = "tpl/widgets/{$ui}.tpl.php";
		$rt_layout = null;
		break;
	default:
		$rt_ui = "pages/404.ui.php";
		$rt_tpl = "pages/error.tpl.php";
		$rt_layout = "default.layout.php";
	};

};

$r =  array (
	$rt_ui,
	$rt_tpl,
	$rt_layout
);
/*// <-- Debugging switch
var_dump ($r);
die();
//*/
return $r;
