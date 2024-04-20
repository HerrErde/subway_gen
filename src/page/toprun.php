<!DOCTYPE html>
<html lang="en">

<head>
  <title>Generate your Highscore</title>
  <?php
  $activePage = basename(__FILE__, '.php');
  require "../require/connect.php";
  require "../require/buttons.php";
  ?>
</head>

<body>
  <header>
    <h1>Generate your Highscore</h1>
    <p id="title">Fill out the options and generate your customized JSON template code.</p>
  </header>

  <form method="get" action="../generator/toprun.php">
    <fieldset>
      <div>
        <legend>Game data</legend>
        <div>
          <label>Highscore:</label><br>
          <input type="number" name="highscore" type="number" min="0" max="9223372036854775807" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
          <span class="required">*</span><br>
        </div>
        <div>
          <label for="userstats">Stats Score:</label>
          <label class="switch">
            <input type="checkbox" id="userstats">
            <span class="slider"></span>
          </label>
        </div>

        <div>
          <label for="userstatsAmount">Stats Score Amount:</label>
          <input type="number" name="userstatsAmount" id="userstatsAmount" type="number" min="0" max="2147483647"
            step="1" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required disabled>
          <span class="required">*</span>
        </div>
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
    <input type="submit" class="btn btn-success" value="Submit">
  </form>
</body>

<?php require "../require/footer.php"; ?>

</html>