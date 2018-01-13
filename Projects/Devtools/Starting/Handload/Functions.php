<?php
function specialWord($data = '')
{
	$data = preg_replace(array('/(v\.[0-9]\.[0-9]\.[0-9])/i', '/(\#)\s/'), array('<span style="color:#00BFFF">$1</span>', '<span style="color:#00BFFF">$1</span> '), $data);

	$data = preg_replace('/\{\{\s*(.*?)\s*\}\}/', '<span style="color:#00BFFF">$1</span>', $data);

	$data = preg_replace('/\[\[\s*(.*?)\s*\]\]/', '<span style="color:#FF0000">$1</span>', $data);

	$data = preg_replace('/\[\|\]/', '\\', $data);

    $data = preg_replace('/\[php\]/', '&#60;?php', $data);

    $data = preg_replace('/\[php\-close\]/', '?&#62;', $data);

	return $data;
}
