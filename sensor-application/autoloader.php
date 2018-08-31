<?php

if(!isset($current_location)){
  $current_location = "";
}

include_once($current_location."config/database.php");
include_once($current_location."controllers/SessionController.php");
include_once($current_location."controllers/QueryController.php");
