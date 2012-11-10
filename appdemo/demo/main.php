<?php
namespace CocomberFramework;

require_once ('cocomber/lib/cocomber/controller.php');

isset ($_SESSION['cocomber_fw'])
|| $_SESSION['cocomber_fw'] = new Cocomber (array (
	'app' => 'demo',
	'title' => 'COCOMBER demo',
	// 'style' => 'default',
));
$c =& $_SESSION['cocomber_fw'];

$c->set_layout ('title', "Cocomber Framework DEMO");
$c->set_layout ('heading', "Cocomber Framework DEMO");

$c->render();
