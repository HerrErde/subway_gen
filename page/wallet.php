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
  <title>Generate your Wallet</title>
  <?php require "../require/connect.php"; ?>
  <?php require "../require/buttons.php"; ?>
</head>

<body>
  <p>
    <?php echo "$warn"; ?>
  </p>
  <header>
    <h1>Generate your Wallet</h1>
    <p id="title">Fill the out the options and generate your customized JSON template code.</p>
  </header>

  <form method="get" action="../generator/wallet.php">
    <fieldset>
      <legend>Game data</legend>
      <label>Hoverboards:</label><br> <input type="number" name="hoverboards" required min="0"
        max="2147483647">
      <font color="red">*</font>
      </la><br>
      <label>Game keys:</label><br> <input type="number" name="gamekeys" required min="0" max="2147483647">
      <font color="red">*</font><br>
      <label>Game coins:</label><br> <input type="number" name="gamecoins" required min="0"
        max="2147483647">
      <font color="red">*</font><br>
      <label>Score Boosters:</label><br> <input type="number" name="scoreboosters" required min="0"
        max="2147483647">
      <font color="red">*</font><br>
      <label>Headstarts:</label><br> <input type="number" name="headstarts" required min="0"
        max="2147483647">
      <font color="red">*</font><br>
      <label>Eventcoins:</label><br> <input type="number" name="eventcoins" required min="0"
        max="2147483647">
      <font color="red">*</font><br>
    </fieldset>
    <br>
<!--     <div class="copy" style="display: inline-block">
    <a
      class="fa fa-pen-to-square fa-2x"
      style="cursor: pointer;"
      href="../editor/wallet-editor.php"
    >
    </a>
  </div> -->
  <input type="submit" class="btn btn-success">
  </form>

  <?php require "../require/footer.php"; ?>

</html>
