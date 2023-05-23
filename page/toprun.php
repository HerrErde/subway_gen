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
          <div>
            <label>Highscore:</label><br>
            <input type="number" name="highscore" required min="0"
              max="9223372036854775807">
            <span class="required">*</span><br>
          </div>
          <div>
            <label for="userstats">Stats Score:</label>
            <label class="switch">
              <input type="checkbox" id="userstats" />
              <span class="slider"></span>
            </label>
          </div>

          <div>
            <label for="userstatsAmount">Stats Score Amount:</label>
            <input
              type="number"
              name="userstatsAmount"
              id="userstatsAmount"
              min="0"
              max="2147483647"
              required
              disabled
            />
            <span class="required">*</span>
          </div>

          <script>
            const userstats = document.getElementById('userstats');
            const userstatsAmount =
              document.getElementsByName('userstatsAmount')[0];

              userstats.addEventListener('change', () => {
              userstatsAmount.disabled = !userstats.checked;
            });
          </script>
    </fieldset>
      <br><input type="submit" class="btn btn-success">
  </form>

  <?php require "../require/footer.php"; ?>

</html>
