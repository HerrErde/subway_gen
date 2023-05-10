<!DOCTYPE html>
<html lang="en">

<head>
  <title>Generate your Highscore</title>
  <?php require "../require/connect.php"; ?>
  <?php require "../require/buttons.php"; ?>
</head>

<body>
  <header>
    <h1>Generate your Highscore</h1>
    <p id="title">Fill out the options and generate your customized JSON template code.</p>
  </header>

  <form method="get" action="../generator/toprun.php">
    <fieldset>
      <legend>Game data</legend>
      <label>Highscore:</label><br>
      <input type="number" name="highscore" required min="0"
        max="9223372036854775807">
      <span class="required">*</span><br>
    </fieldset>
    <br><input type="submit" class="btn btn-success">
  </form>

  <?php require "../require/footer.php"; ?>

</html>
