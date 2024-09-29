<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Generate your Playerprofile</title>
  <?php
  $activePage = basename(__FILE__, '.php');
  require "../require/connect.php";
  require "../require/buttons.php";
  ?>
</head>

<body>
  <header>
    <h1>Generate your Playerprofile</h1>
    <p id="title">
      Fill out the options and generate your customized JSON template code.
    </p>
  </header>

  <form method="get" action="../generator/badges.php">
    <fieldset>
      <div>
        <legend class="gamedata-title">Game data</legend>

        <div class="input-group">
          <label for="bronze">Bronze:</label>
          <span class="required">*</span><br>
          <div class="input-image">
            <img src="/assets/img/badges/bronze.png" alt="Bronze Icon" class="input-icon">
            <input id="bronze" name="bronze" type="number" min="1" max="2147483647" step="1"
              onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
          </div>
        </div>

        <div class="input-group">
          <label for="silver">Silver:</label>
          <span class="required">*</span><br>
          <div class="input-image">
            <img src="/assets/img/badges/silver.png" alt="Bronze Icon" class="input-icon">
            <input id="silver" name="silver" type="number" min="1" max="2147483647" step="1"
              onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
          </div>
        </div>

        <div class="input-group">
          <label for="gold">Gold:</label>
          <span class="required">*</span><br>
          <div class="input-image">
            <img src="/assets/img/badges/gold.png" alt="Bronze Icon" class="input-icon">
            <input id="gold" name="gold" type="number" min="1" max="2147483647" step="1"
              onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
          </div>
        </div>

        <div class="input-group">
          <label for="diamond">Diamond:</label>
          <span class="required">*</span><br>
          <div class="input-image">
            <img src="/assets/img/badges/diamond.png" alt="Bronze Icon" class="input-icon">
            <input id="diamond" name="diamond" type="number" min="1" max="2147483647" step="1"
              onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
          </div>
        </div>

        <div class="input-group">
          <label for="champ">Champ:</label>
          <span class="required">*</span><br>
          <div class="input-image">
            <img src="/assets/img/badges/champ.png" alt="Bronze Icon" class="input-icon">
            <input id="champ" name="champ" type="number" min="1" max="2147483647" step="1"
              onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
          </div>
        </div>
      </div>
    </fieldset>

    <div style="margin: 10px 0;">
      <button type="button" class="btn btn-tertiary" onclick="generateRandomNumbers()">Generate Random</button>
    </div>

    <input type="submit" class="btn btn-success" value="Submit">
  </form>

  <script>
    function generateRandomNumbers() {
      const max = 2147483647;
      const inputs = document.querySelectorAll('input[type="number"]');

      inputs.forEach(input => {
        input.value = Math.floor(Math.random() * max) + 1;
      });
    }
  </script>

  <?php require "../require/footer.php"; ?>
</body>

</html>