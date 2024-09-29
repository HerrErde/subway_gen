<?php
$required_params = [
  "jetpack",
  "superSneakers",
  "magnet",
  "doubleScore",
  "doubleCoinsAmount",
  "doubleCoinsTime",
  "tokenBoostAmount",
  "tokenBoostTime"
];


foreach ($required_params as $param) {
  if (($param === "doubleCoinsAmount" || $param === "tokenBoostAmount") && empty($_GET[$param])) {
    $_GET[$param] = 1;
  } elseif (empty($_GET[$param])) {
    $errors[] = "Failed to generate. Please try again.";
  }
  if (($param === "doubleCoinsTime" || $param === "tokenBoostTime") && empty($_GET[$param])) {
    $_GET[$param] = 999999999999999;
  } elseif (empty($_GET[$param])) {
    $errors[] = "Failed to generate. Please try again.";
  }
}
$errors = [];

if (!empty($errors)) {
  $_SESSION["error"] = implode("<br>", $errors);
  header("Location: ../page/error.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Code for the upgrades.json file</title>
  <?php
  $activePage = basename(__FILE__, '.php');
  require "../require/connect.php";
  ?>
  <script src="/assets/js/download.js"></script>
  <script>
    var filename = 'upgrades.json';
  </script>
</head>

<body>
  <header>
    <h1>Code for the upgrades.json file</h1>
    <p id="title">
      Download or copy the generated code, find the file upgrades.json in the
      folder "profile" and paste it there.
    </p>
    <p id="warning">
      Note that this may restart some statistics and you're using it at your
      own risk.
    </p>
  </header>
  <textarea name="textarea" rows="35" cols="35" readonly><?php require "../code/upgrades.php"; ?></textarea>
  <?php
  require "../require/down-copy.php";
  require "../require/buttons.php";
  require "../require/footer.php";
  ?>
</body>

</html>