<?php

// Global parameters:
$fw_fw = 'cocomber'; // Framework base directory.
$fw_base = 'app'; // Application's base directory.

// Will be defined in config processing:
$fw_app = null; // Current framework application.
$fw_ui = null; // User inteface to load.
$fw_tpl = null; // Template to use.

// HTML headers:
$fw_html_headers = array(
	"<meta charset=UTF-8>",
	"<meta name=generator content=\"vim 7.0\">",
	"<script src=\"cocomber/lib/jquery/jquery.js\" type=\"text/javascript\"></script>",
	"<script src=\"cocomber/lib/cocomber/cocomber.js\" type=\"text/javascript\"></script>",
);

try {
	// Check configuration array:
	if (is_null ($fw_app = $fw_conf['app'])) throw new Exception ('Application name not configured.');


	// Call routing controller:
	if (
		! is_readable ($f = "{$fw_base}/{$fw_app}/routing.php")
	) {

		// Use default framework routing policys:
		list ($fw_ui, $fw_tpl, $fw_type) = require ("{$fw_fw}/internal/routing.php");

		if (! is_dir ($d = dirname ($f))) {
			throw new Exception ("Application directory ({$d}) doesn't exist.");
		} else {
			throw new Exception ("Routing policy file doesn't exist or isn't readable.");
		};
	} else try {
		list ($fw_ui, $fw_tpl, $fw_type) = require ($f);
	} catch (Exception $e2) {

		// Use default framework routing policys:
		list ($fw_ui, $fw_tpl, $fw_type) = require ("{$fw_fw}/internal/routing.php");

		throw new Exception ("Error occurred while processing routing polic file ({$f}):\n" . $e2->getMessage());
	};



} catch (Exception $e) {

	$fw_base = 'cocomber'; // Switch to framework.
	$fw_app = 'appfw';
	$fw_ui = 'error';

	$tpl_message = $e->getMessage();

};


$fw_tpl_path = "{$fw_base}/{$fw_app}/tpl/{$fw_type}/{$fw_tpl}.tpl.php";
$fw_ui_path = "{$fw_base}/{$fw_app}/ui/{$fw_type}/{$fw_ui}.ui.php";


@ is_null ($style = $fw_config['style']) && $style = 'default'; // Enable $config css switching.
$fw_html_headers[] = "<link rel=\"StyleSheet\" HREF=\"{$fw_base}/{$fw_app}/css/{$style}/index.css\" TYPE=\"text/css\" media=\"screen\">";


$fw_html_headers = implode ("\n", $fw_html_headers);

if (
	strlen ($fw_tpl)
) {
	// Front page:
	include ($fw_tpl_path);
} else {
	// Widget page:
	include ($fw_ui_path);
};
