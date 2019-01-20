<?php


namespace Writeboard;

require_once(__DIR__.'/vendor/autoload.php');


function post_gcode($gcode)
{
	$sqs = new \Aws\Sqs\SqsClient([
		"credentials"=>json_decode(file_get_contents(__DIR__."/creds.json"), true),
		"region"=>"us-west-1",
		"version"=>"2012-11-05"
	]);
	$url = $sqs->getQueueUrl(["QueueName"=>"WriteboardTest"])->get("QueueUrl");
	$sqs->SendMessage([
		"MessageBody"=>$gcode,
		"QueueUrl"=>$url
	]);
}

?>