<?php
include_once 'autoloader.php';

$sensorID = $_POST['ids'];
$threshold = $_POST['threshold'];

$query->updateThreshold($threshold, $sensorID);
header("location:loggedIn.php");
