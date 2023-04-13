<?php
$warn = "";
session_start();
if (isset($_SESSION["error"])) {
  $warn = $_SESSION["error"];
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Generate your Upgrades</title>
  <?php require "../require/connect.php"; ?>
  <?php require "../require/buttons.php"; ?>
</head>

<body>
  <p>
    <?php echo "$warn"; ?>
  </p>
  <header>
    <h1>Generate your Upgrades</h1>
    <p id="title">Fill the out the options and generate your customized JSON template code.</p>
  </header>

  <form method="get" action="../generator/upgrades.php">
    <fieldset>
      <legend>Game data</legend>
      <label for="number">Jetpack:</label><br> <input type="number" name="jetpack" required min="0" max="6">
      <font color="red">*</font><br>
      <label for="number">Super Sneakers:</label><br> <input type="number" name="superSneakers" required min="0" max="6">
      <font color="red">*</font><br>
      <label for="number">Magnet:</label><br> <input type="number" name="magnet" required min="0" max="6">
      <font color="red">*</font><br>
      <label for="number">Double Score:</label><br> <input type="number" name="doubleScore" required min="0" max="6">
      <font color="red">*</font><br>
      <label for="number">Double Coins:</label><br> <input type="checkbox" name="doublecoins" id="doublecoins" class="checkbox" checked disabled>
      <label for="doublecoins" class="slider"></label>
    </fieldset>
    <br><input type="submit" class="btn btn-success">
  </form>

  <br><br><br>
  <?php require "../require/footer.php"; ?>

</html>
