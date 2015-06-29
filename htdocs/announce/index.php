<?php

$result = array(
	'message' => '',
	'time' => time()
);

if (rand(0,1))
{
	$result['message'] = 'OK';
}
else
{
	$result['message'] = 'Catastrophic Failure!';
}

header('Content-Type: application/bson');
echo bson_encode($result);

