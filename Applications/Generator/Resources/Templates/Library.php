<?php 
$eol = EOL;
$ht  = HT;

$controller  = "<?php".$eol;
$controller .= "class {$class} extends BaseController".$eol;
$controller .= "{".$eol;

if( ! empty($functions) ) foreach( $functions as $function )
{
	if( ! empty($function) )
	{
		$controller .= $ht."public function {$function}()".$eol;
		$controller .= $ht."{".$eol;
		$controller .= $ht.$ht."// Your codes...".$eol;
		$controller .= $ht."}".$eol.$eol;
	}
}

$controller  = rtrim($controller, $eol);
$controller .= $eol."}";

echo $controller;