<?php

require_once(__DIR__."/php/inter.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	\Writeboard\post_gcode("G00 X0.0 Y200.0\n");
}

?>
