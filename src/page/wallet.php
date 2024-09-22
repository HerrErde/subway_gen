<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
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
        <legend class="gamedata-title">Game data</legend>

        <div>
          <label for="hoverboards">Hoverboards:</label>
          <span class="required">*</span><br>
          <input id="hoverboards" name="hoverboards" type="number" min="1" max="2147483647" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        </div>

        <div>
          <label for="gamekeys">Game keys:</label>
          <span class="required">*</span><br>
          <input id="gamekeys" name="gamekeys" type="number" min="1" max="2147483647" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        </div>

        <div>
          <label for="gamecoins">Game coins:</label>
          <span class="required">*</span><br>
          <input id="gamecoins" name="gamecoins" type="number" min="1" max="2147483647" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        </div>

        <div>
          <label for="scoreboosters">Score Boosters:</label>
          <span class="required">*</span><br>
          <input id="scoreboosters" name="scoreboosters" type="number" min="1" max="2147483647" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        </div>

        <div>
          <label for="headstarts">Headstarts:</label>
          <span class="required">*</span><br>
          <input id="headstarts" name="headstarts" type="number" min="1" max="2147483647" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        </div>

        <div>
          <label for="eventcoins">Eventcoins:</label>
          <span class="required">*</span><br>
          <input id="eventcoins" name="eventcoins" type="number" min="1" max="2147483647" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
        </div>
      </div>
    </fieldset>

    <div style="margin: 10px 0;">
      <button type="button" class="btn btn-tertiary" onclick="generateRandomNumbers()">Generate Random</button>
    </div>

    <div class="copy" style="display: inline-block">
      <a class="fa fa-pen-to-square fa-2x" style="cursor: pointer;" href="../editor/wallet.php"></a>
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