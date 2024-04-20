<!DOCTYPE html>
<html lang="en">

<head>
  <title>Generate your Wallet</title>
  <?php
  $activePage = basename(__FILE__, '.php');
  require "../require/connect.php";
  require "../require/buttons.php";
  ?>
</head>

<body>
  <header>
    <h1>Generate your Wallet</h1>
    <p id="title">
      Fill out the options and generate your customized JSON template code.
    </p>
  </header>

  <form method="get" action="../generator/wallet.php">
    <fieldset>
      <div>
        <legend>Game data</legend>
        <label>Hoverboards:</label><br>
        <input name="hoverboards" type="number" min="1" max="2147483647" step="1"
          onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        <span class="required">*</span><br>
        <label>Game keys:</label><br>
        <input type="number" name="gamekeys" type="number" min="1" max="2147483647" step="1"
          onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        <span class="required">*</span><br>
        <label>Game coins:</label><br>
        <input type="number" name="gamecoins" type="number" min="1" max="2147483647" step="1"
          onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        <span class="required">*</span><br>
        <label>Score Boosters:</label><br>
        <input type="number" name="scoreboosters" type="number" min="1" max="2147483647" step="1"
          onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        <span class="required">*</span><br>
        <label>Headstarts:</label><br>
        <input type="number" name="headstarts" type="number" min="1" max="2147483647" step="1"
          onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        <span class="required">*</span><br>
        <label>Eventcoins:</label><br>
        <input type="number" name="eventcoins" type="number" min="1" max="2147483647" step="1"
          onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        <span class="required">*</span><br>
      </div>
    </fieldset>
    <div class="copy" style="display: inline-block">
      <a class="fa fa-pen-to-square fa-2x" style="cursor: pointer;" href="../editor/wallet-editor.php">
      </a>
    </div>
    <input type="submit" class="btn btn-success" value="Submit">
  </form>
</body>

<?php require "../require/footer.php"; ?>

</html>