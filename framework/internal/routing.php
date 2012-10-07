<?php

// Read path info:
$path = ltrim ($_SERVER['PATH_INFO'], '/');


if (
	strlen ($path)
) {
	return array (
		$path,	// Directly path as user interface path.
		null		// Doesn't use any template.
	);
} else {
	return array (
		'default',	// Redirect to 'default' user interface.
		'default'	// User 'default' template.
	);
};

