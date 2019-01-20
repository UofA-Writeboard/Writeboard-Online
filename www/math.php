<?php

require_once(__DIR__.'/php/vendor/autoload.php');
require_once(__DIR__."/php/inter.php");

if (!(
			isset($_POST['math'])
		 && isset($_POST['xmin'])
		 && isset($_POST['xmax'])
		 && is_numeric($_POST['xmin'])
		 && is_numeric($_POST['xmax'])
	))
{
	header('Location: /');
}

$math = $_POST['math'];
$xmin = floatval($_POST['xmin']);
$xmax = floatval($_POST['xmax']);

if ($xmax < $xmin)
{
	header('Location: /');
}


$bed_max_x = 300;
$bed_min_x = -300;
$bed_max_y = 800;
$bed_min_y = 300;
$step_count = 250;


use MathParser\StdMathParser;
use MathParser\Interpreting\Evaluator;

$parser = new StdMathParser();

$AST = $parser->parse($_POST['math']);

$evaluator = new Evaluator();
$evaluator->setVariables(['x'=>$xmin]);
$value = $AST->accept($evaluator);
$min_y = $value;
$max_y = $value;
$values = Array();

class Point
{
	public $x;
	public $y;
	
    function __construct($x, $y)
	{
        $this->$x = $x;
		$this->$y = $y;
    }
}

for ($iter = 0; $iter <= $step_count; $iter++)
{
	$x = (($iter * ($xmax - $xmin) / $step_count) + $xmin);
	$evaluator->setVariables(['x'=>$x]);
	$y = $AST->accept($evaluator);
	$values[$iter] = $y;
	
	if ($y < $min_y)
	{
		$min_y = $y;
	}
	if ($y > $max_y)
	{
		$max_y = $y;
	}
}

$bed_height = $bed_max_y - $bed_min_y;
$graph_height = $max_y - $min_y;
$scale_y = $bed_height / $graph_height;

$gcode = "";

for ($iter = 0; $iter <= $step_count; $iter++)
{
	$gx = (($iter * ($bed_max_x - $bed_min_x) / $step_count) + $bed_min_x);
	$gy = $bed_max_y - (($values[$iter] - $min_y) * $scale_y);
	
	if ($iter == 0)
	{
		$gcode .= sprintf("G00 X%.2f Y%.2F\n", $gx, $gy);
	}
	else
	{
		$gcode .= sprintf("G01 X%.2f Y%.2F\n", $gx, $gy);
	}
}

\Writeboard\post_gcode($gcode);
//echo($gcode);

?>
