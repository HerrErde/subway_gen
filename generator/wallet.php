<?php
$required_params = [
  "hoverboards",
  "gamekeys",
  "gamecoins",
  "scoreboosters",
  "headstarts",
  "eventcoins",
];

$errors = [];

foreach ($required_params as $param) {
  if (!isset($_GET[$param])) {
    $_GET[$param] = 1;
  } elseif (empty($_GET[$param])) {
    $errors[] = "Failed to generate. Please try again.";
  }
}

if (!empty($errors)) {
  $_SESSION["error"] = implode("<br>", $errors);
  header("Location:
  ../code/upgrades.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Code for the wallet.json file</title>
  <?php require "../require/connect.php"; ?>
  <script src="../assets/js/download.js"></script>
  <script>
    var filename = 'wallet.json';
  </script>
</head>

<body>
  <header>
    <h1>Code for your Wallet</h1>
    <p id="title">
      Download or copy the generated code, find the file wallet.json in the
      folder "profile" and paste it there.
    </p>
    <p id="warning">
      Note that this may restart some statistics and you're using it at your
      own risk.
    </p>
  </header>
  <textarea name="textarea" rows="35" cols="35" readonly><?php require "../code/wallet.php"; ?></textarea>
  <?php require "../require/down-copy.php"; ?>
  <?php require "../require/buttons.php"; ?>
  <?php require "../require/footer.php"; ?>
</body>

</html>