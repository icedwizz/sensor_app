<?php
$current_location = "../";
include($current_location. 'autoloader.php');

$sensors = $query->getSensors();

$gauge_chart_data[] = array('Label', 'Value');
foreach($sensors as $sensor)
{
	$reading = $query->getLatestReadingForSensor($sensor["SensorID"]);
	$gauge_chart_data[] = array($sensor['SensorName'], $reading['Reading']);
}

echo json_encode($gauge_chart_data);
