<?php include_once('requires-login.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Header</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
<header>
  <nav>
    <div class="main-wrapper">
      <ul>
        <li><a href ="index.php">Home</a></li>
      </ul>
      <div class="nav-login">
        <?php if ($session->loggedIn()) { ?>
          <form action="logout.php" method="POST">
        		<button type="submit" name="submit">Logout</button>
          </form>
        <?php } else { ?>
          <form action="login.php" method="POST">
            <input type="text" name="user_uid" placeholder="Username/e-mail">
            <input type="password" name="user_password" placeholder="Password">
            <button type="submit" name="submit">Login</button>
          </form>
          <a href="signup.php">Sign Up</a>
        <?php } ?>
      </div>
    </div>
  </nav>
</header>
<section class="main-container">
  <div class="main-wrapper">
    <h2>Sensor Readings</h2>
<!--content inside website if logged in
session login and signup -->
<div class="welcome">

<br><br>
<table id='example' style='width:90%'>
<?php

$sensors = $query->getSensors();

?>

<tr>
	<th style='display:none;'> SensorReadingID</th>
	<th style='display:none;'> SensorID</th>
	<th> SensorName</th>
	<th> Sensor Reading</th>
	<th> TimeStamp</th>
	<th> Threshold</th>
</tr>

<?php

foreach($sensors as $sensor){
	$latestReading = $query->getLatestReadingForSensor($sensor['SensorID']);
	?>

	<tr>
		<form action='threshold_update.php' method='POST'>
		<td style='display:none;'> <input type='text' name='ids' id='ids' value="<?php echo $sensor['SensorID']; ?>"></td>

		<td><input type='text' name='sensorname' id='sensorname' disabled value="<?php echo $sensor['SensorName']; ?>"></td>

		<td><input type='text' name='reading' id='reading' disabled value="<?php echo $latestReading['Reading'] ?>"></td>
		<td><input type='text' name='timestamp' id='timestamp' disabled value="<?php echo $latestReading['TimeStamp'] ?>"></td>
		<td> <input type='text' name='threshold' id='threshold'  value="<?php echo $sensor['threshold'] ?>"> </td>
		<td> <button type='submit' name='submit'>Set</button>  </td>
		</form>
	</tr>

	<?php
}

?>
</table>

<iframe src='gauge.php'></iframe>

</section>
</body>
</html>
