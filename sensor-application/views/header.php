<?php include_once('view-protection.php'); ?>
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
      <?php
      //logouts
        if (isset($_SESSION['s_id'])) {
		echo '<form action="loggedIn.php" method="POST">
            <button type="submit" name="submit">Threshold</button>
            </form>';
          echo '<form action="logout.php" method="POST">
            <button type="submit" name="submit">Logout</button>
            </form>';

        }

        else {
            echo '<form action="login.php" method="POST">
            <input type="text" name="user_uid" placeholder="Username/e-mail">
            <input type="password" name="user_password" placeholder="Password">
            <button type="submit" name="submit">Login</button>
          </form>';
		  echo '
          <a href="signup.php">Sign Up</a>';

        }
        ?>

      </div>

    </div>
  </nav>
</header>
