<?php
function renderTemplate($file, $info) {
	$file = 'templates/' . $file .'.php';
	if (file_exists($file)){
		ob_start('ob_gzhandler');
		extract($info);
		require_once $file;
		return ob_get_clean();
	} else {
		return ("");
	}
};
?>