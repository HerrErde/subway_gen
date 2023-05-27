<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Generate your Wallet</title>
    <?php require "../require/connect.php"; ?>
    <?php require "../require/buttons.php"; ?>
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
        <legend>Game data</legend>
        <label>Hoverboards:</label><br>
        <input
          type="number"
          name="hoverboards"
          required
          min="0"
          max="2147483647"
       >
        <span class="required">*</span><br>
        <label>Game keys:</label><br>
        <input
          type="number"
          name="gamekeys"
          required
          min="0"
          max="2147483647"
       >
        <span class="required">*</span><br>
        <label>Game coins:</label><br>
        <input
          type="number"
          name="gamecoins"
          required
          min="0"
          max="2147483647"
       >
        <span class="required">*</span><br>
        <label>Score Boosters:</label><br>
        <input
          type="number"
          name="scoreboosters"
          required
          min="0"
          max="2147483647"
       >
        <span class="required">*</span><br>
        <label>Headstarts:</label><br>
        <input
          type="number"
          name="headstarts"
          required
          min="0"
          max="2147483647"
       >
        <span class="required">*</span><br>
        <label>Eventcoins:</label><br>
        <input
          type="number"
          name="eventcoins"
          required
          min="0"
          max="2147483647"
       >
        <span class="required">*</span><br>
      </fieldset>
      <div class="copy" style="display: inline-block">
        <a class="fa fa-pen-to-square fa-2x"
          style="cursor: pointer;"
          href="../editor/wallet-editor.php">
        </a>
      </div>
      <input type="submit" class="btn btn-success">
    </form>
  </body>

  <?php require "../require/footer.php"; ?>
</html>
