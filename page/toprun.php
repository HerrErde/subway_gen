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
  <title>Generate your Highscore</title>
  <?php require "../require/connect.php"; ?>
  <?php require "../require/buttons.php"; ?>
</head>

<body>
  <p>
    <?php echo "$warn"; ?>
  </p>
  <header>
    <h1>Generate your Highscore</h1>
    <p id="title">Fill the out the options and generate your customized JSON template code.</p>
  </header>

  <form method="get" action="../generator/toprun.php">
    <fieldset>
      <legend>Game data</legend>
      <label for="number">Highscore:</label><br> <input type="number" name="highscore" required min="0"
        max="9223372036854775807">
      <font color="red">*</font><br>
    </fieldset>
    <br><input type="submit" class="btn btn-success">
  </form>

  <br><br><br>
  <?php require "../require/footer.php"; ?>

</html>
