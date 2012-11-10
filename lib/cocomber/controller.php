<?php
namespace CocomberFramework;

class Cocomber {

	// Global constants:/*{{{*/
	const fw_dir = 'cocomber'; // Framework base directory.
	const app_dir = 'app'; // Application's base directory.
	const default_layout = 'default.layout.php'; // Framework's default layout.
	 /*}}}*/

	// Error messages:/*{{{*/
	const E_Internal = "<b>INTERNAL ERROR!!</b>";
	const E_Missconfigured = "Application name not configured.";
	const E_AppNotFound = "Application directory (%s) doesn't exist.";
	const E_RoutingNotFound = "Routing policy file doesn't exist or isn't readable.";
	const E_RoutingProcessing = "Error occurred while processing routing polic file (%s):\n%s";
	 /*}}}*/

	// Global parameters:/*{{{*/
	private $fw_conf; // Primary configuration.
	private $fw_base; // Application's directory base (redirectable).
	private $fw_app; // Application name.
	private $fw_routing; // Path to routing implementation.
	 /*}}}*/

	// Routing:/*{{{*/
	private $rt_ctg = null; // Response category (pages / widgets).
	private $rt_ui = null; // User inteface to load.
	private $rt_tpl = null; // Template to use.
	private $rt_layout = null; // Template to use.
	 /*}}}*/

	// Layout:/*{{{*/
	private $layout_data;
	/*}}}*/


	public function __construct (/*{{{*/
		$fw_conf
	) {

		$this->fw_conf = $fw_conf;
		$this->fw_base = self::app_dir; // Switchable application base directory.

		try {
			// Check configuration array:
			if (is_null ($this->fw_app = $this->fw_conf['app'])) throw new Exception (self::E_Missconfigured);

			// Check for routing controller:
			if (
				! is_readable ($this->fw_routing = self::app_dir . "/{$this->fw_app}/routing.php")
			) {

				// Use default framework routing policys:
				if (! is_readable (
					$this->fw_routing  = self::fw_dir . "/internal/routing.php"
				)) die (self::E_Internal);

				if (! is_dir ($d = dirname ($this->fw_routing))) {
					throw new Exception (sprintf(base::E_AppNotFound, $d));
				} else {
					throw new Exception (self::E_RoutingNotFound);
				};
			};

		} catch (Exception $e) {

			$this->fw_base = self::fw_dir; // Switch to framework.
			$this->fw_app = 'appfw';
			$this->rt_ui = 'error';

			$tpl_message = $e->getMessage();

		};

	}/*}}}*/


	public function set_layout (/*{{{*/
		$partid,
		$data
	) {
		$this->layout_data[$partid] = $data;
		return $data;
	}/*}}}*/


	public function append_layout (/*{{{*/
		$partid,
		$data
	) {
		$this->layout_data[$partid][] = $data;
		return $data;
	}/*}}}*/


	public function cocomber_layout() {/*{{{*/
		$this->append_layout ('headers', "<meta charset=UTF-8>");
		$this->append_layout ('headers', "<meta name=generator content=\"vim 7.0\">");
		$this->append_layout ('headers', "<script src=\"cocomber/lib/jquery/jquery.js\" type=\"text/javascript\"></script>");
		$this->append_layout ('headers', "<script src=\"cocomber/lib/cocomber/cocomber.js\" type=\"text/javascript\"></script>");

		// Style Sheet:
	 @ is_null ($style = $this->fw_conf['style']) && $style = 'default'; // Enable $config css switching.
		$this->append_layout ('headers', "<link rel=\"StyleSheet\" HREF=\"" . self::app_dir . "/{$this->fw_app}/css/{$style}/index.css\" TYPE=\"text/css\" media=\"screen\">");


	}/*}}}*/


	public function debugm ( // Set debug message./*{{{*/
		$type,
		$text
	) {
		$type = strtoupper ($type);
		$this->append_layout (
			'debug',
			"<p><em>{$type}:</em> {$text}</p>"
		);
		return $text;
	}/*}}}*/


	private function route (/*{{{*/
	) {

		try {
			list (
				// Routing parameters (not stored in session):
				$this->rt_ui,		// UI to execute.
				$this->rt_tpl,		// Template to apply.
				$this->rt_layout	// Layout to encapsulate.
			) = require (
				// Application routing implementation:
				// (typicall include to framework default)
				$this->fw_routing
			);
		} catch (Exception $e) {

			// Use default framework routing policys:
			list ($this->rt_ui, $this->rt_tpl, $this->rt_layout) = require (self::fw_dir . "/internal/routing.php");

			throw new Exception (sprintf (base::E_RoutingProcessing, $this->fw_routing, $e->getMessage()));

		};

	}/*}}}*/


	private function render_layout (/*{{{*/
		$mode = null,
		$ui_path = null
	) {

		$ok = false;
		if (
			strlen ($l = $this->rt_layout)
			&& (
				// Try application custom layout:
				($ok = is_readable ($f = self::app_dir . "/{$this->fw_app}/layout/{$l}"))
				// Try framework generic layout:
				|| ($ok = is_readable ($f = self::fw_dir . "/appfw/layout/{$l}"))
				// Failback to framework's default layout:
				|| is_readable ($f = self::fw_dir . "/appfw/layout/" . self::default_layout)
			)
		) {

			$this->cocomber_layout();

			if (! $ok) $this->debugm ('error', "Cannot open layout: {$f}. Using framework's default.");

			// Add extra useful info if any debug output generated:/*{{{*/
			if (count ($this->layout_data['debug'])) {
				$this->append_layout ('debug', "<hr>");
				$this->append_layout ('debug', "<h2>Framework info:</h2>");
				$this->append_layout ('debug', "<ul>");
				$this->append_layout ('debug', "<li>MODE: " . $mode . "</li>");
				$this->append_layout ('debug', "<li>UI path: " . $ui_path . "</li>");
				$this->append_layout ('debug', "<li>rt_ctg: " . $this->rt_ctg . "</li>");
				$this->append_layout ('debug', "<li>rt_ui: " . $this->rt_ui . "</li>");
				$this->append_layout ('debug', "<li>rt_tpl: " . $this->rt_tpl . "</li>");
				$this->append_layout ('debug', "<li>rt_layout: " . $this->rt_layout . "</li>");
				$this->append_layout ('debug', "</ul>");
				$this->append_layout ('debug', "<hr>");
				$this->append_layout ('debug', "<h2>Headers:</h2>");
				$this->append_layout ('debug', "<ul>");
				$this->append_layout ('debug', nl2br(htmlentities(
					implode ("\n", $this->layout_data['headers'])
				)));
				$this->append_layout ('debug', "</ul>");
				$this->append_layout ('debug', "<hr>");
			};/*}}}*/

			extract ($this->layout_data, EXTR_PREFIX_ALL, 'layout');
			include ($f);

		} else {

			echo $this->layout_data['contents'];
/////			$this->debugm ('error', "Cannot find framework's default layout: {$f}.");
/////			echo implode ("\n", $this->layout_data['debug']);

		};

	}/*}}}*/



	private function render_template (/*{{{*/
		$data
	) {

		extract ($data, EXTR_PREFFIX_ALL, 'tpl');

		include (self::app_dir . "/{$this->fw_app}/tpl/{$this->rt_ctg}/{$this->rt_tpl}.tpl.php");

	}/*}}}*/



	private function render_ui (/*{{{*/
	) {

		ob_start();
		$response = include (
			$f = self::app_dir . "/{$this->fw_app}/ui/{$this->rt_ui}"
		);


		// Decode response meaning:/*{{{*/
		if (is_numeric ($response)) { // Error code:
			$mode = $response + 0;
			($mode == 0) && $mode = 404; // Remap 0 (include-like fail) to 404.
			($mode == 1) && $mode = 'notpl'; // Remap default include's return value.
		} else if (is_string ($response)) { // Layout change:
			$mode = trim($response) == '' ? 'nolayout' : 'changelayout';
		} else if (is_bool ($response)) {
			$mode = $response ? 'notpl' : 404;
		} else if (is_array ($response)) {
			$mode = 'tpldata';
		};/*}}}*/

		switch ($mode) {
		case 'nolayout': // Empty string to disable layout rendering./*{{{*/

			// This is the FASTEST way to serve the response.
			// Contents are supposed to be echoed during ui processing.
			// No template or layout is rendered. EVEN if specified thought routing data.

			// Directly flush rendered page.
			ob_end_flush();
			return; // Return as fast as possible.

			break;/*}}}*/
		case 'changelayout': // String specifies alternative layout./*{{{*/

			// Change layout:
			$this->rt_layout = $response;

			// (Continue...) /*}}}*/
		case 404: // Not found:/*{{{*/

			header("HTTP/1.0 404 Not Found");

			/*}}}*/
		case 'notpl': // Boolean true uses layout but disable templating./*{{{*/

			// Contents are supposed to be echoed during ui processing.
			// No template is rendered.

			// Capture contents:
			$this->set_layout('contents', ob_get_contents());
			ob_end_clean();

			break;/*}}}*/
		case 'tpldata': // Array with template data./*{{{*/

			// Capture rendered contents as debug info:
			$this->append_layout ('debug', ob_get_contents());
			ob_end_clean();

			// Render template:
			$this->set_layout ('contents', $this->render_template ($response));

			break;/*}}}*/
		case 304: // Not Modified:/*{{{*/

			header("HTTP/1.0 304 Not Modified");
			ob_end_clean(); // Discard any output.
			return;

			break;/*}}}*/
		};

		$this->render_layout ($mode, $f);

	}/*}}}*/


	public function render (/*{{{*/
	) {
		$this->route();
		$this->render_ui();
	}/*}}}*/


}

/*
@ is_null ($style = $this->fw_conf['style']) && $style = 'default'; // Enable $config css switching.

$fw_html_headers[] = "<link rel=\"StyleSheet\" HREF=\"" self::app_dir . "/{$this->fw_app}/css/{$style}/index.css\" TYPE=\"text/css\" media=\"screen\">";


$fw_html_headers = implode ("\n", $fw_html_headers);

if (
	strlen ($this->rt_tpl)
) {
	// Front page:
	include ($fw_tpl_path);
} else {
	// Widget page:
	include ($fw_ui_path);
};


 */


// vim: foldmethod=marker
