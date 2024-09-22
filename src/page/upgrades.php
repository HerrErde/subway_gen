<!DOCTYPE html>
<html lang="en">

<head>
  <title>Generate your Upgrades</title>
  <?php
  $activePage = basename(__FILE__, '.php');
  require "../require/connect.php";
  require "../require/buttons.php";
  ?>
</head>

<body>
  <header>
    <h1>Generate your Upgrades</h1>
    <p id="title">
      Fill out the options and generate your customized JSON template code.
    </p>
  </header>
  <form method="get" action="../generator/upgrades.php">
    <fieldset>
      <div>
        <legend class="gamedata-title">Game data</legend>

        <div>
          <label>Jetpack:</label>
          <span class="required">*</span><br>
          <input type="number" name="jetpack" min="1" max="6" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        </div>

        <div>
          <label>Super Sneakers:</label>
          <span class="required">*</span><br>
          <input type="number" name="superSneakers" min="1" max="6" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        </div>

        <div>
          <label>Magnet:</label>
          <span class="required">*</span><br>
          <input type="number" name="magnet" min="1" max="6" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        </div>

        <div>
          <label>Double Score:</label>
          <span class="required">*</span><br>
          <input type="number" name="doubleScore" min="1" max="6" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        </div>

        <div>
          <label for="doubleCoins">Double Coins:</label>
          <label class="switch">
            <input type="checkbox" id="doubleCoins">
            <span class="slider"></span>
          </label>
        </div>

        <div>
          <label for="doubleCoinsAmount">Double Coins Amount:</label>
          <span class="required">*</span>
          <input type="number" name="doubleCoinsAmount" id="doubleCoinsAmount" min="0" max="100" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required disabled>
        </div>

        <div>
          <label for="doubleCoinsTime">Double Coins Time:</label>
          <span class="required">*</span>
          <input type="number" id="doubleCoinsTime" min="1719167575" max="999999999999999"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required disabled>
        </div>

        <div>
          <label for="tokenBoost">Token Boost:</label>
          <label class="switch">
            <input type="checkbox" id="tokenBoost">
            <span class="slider"></span>
          </label>
        </div>

        <div>
          <label for="tokenBoostAmount">Token Boost Amount:</label>
          <span class="required">*</span>
          <input type="number" name="tokenBoostAmount" id="tokenBoostAmount" min="0" max="100"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required disabled>
        </div>

        <div>
          <label for="tokenBoostTime">Token Boost Time:</label>
          <span class="required">*</span>
          <input type="number" name="tokenBoostTime" id="tokenBoostTime" min="1719167575" max="999999999999999"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required disabled>
        </div>
        <div>
    </fieldset>
    <input type="submit" class="btn btn-success" value="Submit">
  </form>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const toggleFields = (checkboxId, ...fieldIds) => {
        const checkbox = document.getElementById(checkboxId);
        const fields = fieldIds.map(id => document.getElementById(id));

        checkbox.addEventListener('change', () => {
          fields.forEach(field => {
            field.disabled = !checkbox.checked;
          });
        });
      };

      toggleFields('doubleCoins', 'doubleCoinsAmount', 'doubleCoinsTime');
      toggleFields('tokenBoost', 'tokenBoostAmount', 'tokenBoostTime');
    });

  </script>
</body>

<?php require "../require/footer.php"; ?>

</html>