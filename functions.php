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

function time_format($timestamp) {
    $now = strtotime('now');
    $difference_time = ($now - $timestamp) / 3600;
    if ($difference_time > 24) {
        return date('d.m.y в H:i', $timestamp);
    }
    else {
        if ($difference_time < 1) {
            return floor($difference_time * 60) . " минут назад" ;
        }
        else {
            return floor($difference_time) . ' часов назад';
        }
    }
};
?>