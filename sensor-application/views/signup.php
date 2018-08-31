<?php
include_once('view-protection.php');
include_once 'header.php';
 ?>
<section class="main-container">
  <div class="main-wrapper">
    <h2>Signup</h2>
    <form class= "signup-form" action="signup.inc.php" method="POST">
    <input type="text" name="first" placeholder="Firstname">
    <input type="text" name="last" placeholder="Surname">
    <input type="text" name="email" placeholder="E-mail">
    <input type="text" name="uid" placeholder="Username">
    <input type="password" name="user_password" placeholder="Password">
    <button type="submit" name="submit">Sign Up</button>
    </form>

  </div>

</section>
