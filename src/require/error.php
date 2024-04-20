<?php
require "../require/connect.php";

$errors = [];

function sanitizeInput($value)
{
  return preg_replace("/[^0-9]/", "", $value);
}

foreach ($required_params as $param) {
  if (isset($_GET[$param])) {
    $_GET[$param] = sanitizeInput($_GET[$param]);
  }

  if (!isset($_GET[$param]) || empty($_GET[$param]) || !is_numeric($_GET[$param])) {
    $errors[] = "Invalid value for $param. Please provide a numeric value.";
  }
}

if (!empty($errors)) {
  $_SESSION["error"] = implode("<br>", $errors);
  header("Location: ../page/error.php");
  exit();
}
?>