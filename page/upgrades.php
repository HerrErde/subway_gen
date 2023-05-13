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
      <p id="title">Fill out the options and generate your customized JSON template code.</p>
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
          <input type="number" name="doubleCoinsAmount" id="doubleCoinsAmount" required min="0" max="100" disabled>
          <span class="required">*</span>
        </div>
        <script>
          const doubleCoins = document.getElementById("doubleCoins");
          const doubleCoinsAmount = document.getElementsByName("doubleCoinsAmount")[0];

          doubleCoins.addEventListener("change", () => {
            doubleCoinsAmount.disabled = !doubleCoins.checked;
          });
        </script>
      </fieldset>
      <br>
      <input type="submit" class="btn btn-success">
    </form>
    
    <?php require "../require/footer.php"; ?>
  </body>
</html>
