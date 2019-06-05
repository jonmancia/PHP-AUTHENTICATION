<?php

$db = pg_connect("host=localhost dbname=myDb");
session_start();

// Check request method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!isset($_POST['email']) && !isset($_POST['pass'])) {
    header("Location: index.php");
  } else {
    $email = $_POST['email'];

    $userPassRequest = pg_query_params("SELECT user_password, user_fname FROM users WHERE user_email = $1", array($email));
    $result = pg_fetch_assoc($userPassRequest);

    if (password_verify($_POST['pass'], $result['user_password'])) {
      $_SESSION['user'] = $result['user_fname'];
      header("Location: welcome.php");
    } else {
      echo '<h1>Invalid username or password</h1>';
    }
  }
}
