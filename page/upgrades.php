<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Generate your Upgrades</title>
    <?php require "../require/connect.php"; ?>
    <?php require "../require/buttons.php"; ?>
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
          <legend>Game data</legend>
          <label>Jetpack:</label><br>
          <input type="number" name="jetpack" required min="0" max="6">
          <span class="required">*</span><br>
        </div>
        <div>
          <label>Super Sneakers:</label><br>
          <input type="number" name="superSneakers" required min="0" max="6">
          <span class="required">*</span><br>
        </div>
        <div>
          <label>Magnet:</label><br>
          <input type="number" name="magnet" required min="0" max="6">
          <span class="required">*</span><br>
        </div>
        <div>
          <label>Double Score:</label><br>
          <input type="number" name="doubleScore" required min="0" max="6">
          <span class="required">*</span><br>
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
          <input
            type="number"
            name="doubleCoinsAmount"
            id="doubleCoinsAmount"
            min="0"
            max="100"
            required
            disabled
         >
          <span class="required">*</span>
        </div>

        <script>
          const doubleCoins = document.getElementById('doubleCoins');
          const doubleCoinsAmount =
            document.getElementsByName('doubleCoinsAmount')[0];

          doubleCoins.addEventListener('change', () => {
            doubleCoinsAmount.disabled = !doubleCoins.checked;
          });
        </script>

        <div>
          <label for="tokenBoost">Token Boost:</label>
          <label class="switch">
            <input type="checkbox" id="tokenBoost">
            <span class="slider"></span>
          </label>
        </div>

        <div>
          <label for="tokenBoostAmount">Token Boost Amount:</label>
          <input
            type="number"
            name="tokenBoostAmount"
            id="tokenBoostAmount"
            min="0"
            max="100"
            required
            disabled
         >
          <span class="required">*</span>
        </div>

        <script>
          const tokenBoost = document.getElementById('tokenBoost');
          const tokenBoostAmount =
            document.getElementsByName('tokenBoostAmount')[0];

          tokenBoost.addEventListener('change', () => {
            tokenBoostAmount.disabled = !tokenBoost.checked;
          });
        </script>
      </fieldset>
      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </body>

  <?php require "../require/footer.php"; ?>
</html>
