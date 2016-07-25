<?php 
$eol = EOL;
$ht  = HT;

$controller  = "<?php".$eol;
$controller .= "class {$class} extends {$extends}".$eol;
$controller .= "{".$eol;

if( $extends === 'Grand' )
{
	$controller .= $ht."// const table = '';".$eol;
}
	
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