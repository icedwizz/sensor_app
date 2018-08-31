<?php
//Protects views from being accessed directly
if(!isset($session)){
  header("Location: ../index.php");
}