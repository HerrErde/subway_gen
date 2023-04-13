<?php
$required_params = [
  "hoverboards",
  "gamekeys",
  "gamecoins",
  "scoreboosters",
  "headstarts",
  "eventcoins",
];

session_start();

foreach ($required_params as $param) {
  if (!isset($_GET[$param])) {
    $_SESSION["error"] = "Failed to generate. Try again.";
    header("Location:../code/wallet.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Code for the wallet.json file</title>
    <script src="../assets/js/script.js"></script>
    <script>
      var filename = 'wallet.json';
    </script>
    <?php require "../require/connect.php"; ?>
  </head>

  <body>
    <header>
      <h1>Code for the Wallet</h1>
      <p id="title">
        Copy the generated code, find the file wallet.json in the folder
        "profile" and paste it there.
      </p>
      <p id="warning">
        Note that this may restart some statistics and you're using it at your
        own risk.
    </p>
    </header>
  <textarea name="textarea" rows="35" cols="35" readonly>
    <?php require "../code/wallet.php"; ?>
  </textarea>
    <?php require "../require/down-copy.php"; ?>

    <?php require "../require/buttons.php"; ?>
    <br /><br /><br />
    <?php require "../require/footer.php"; ?>
  </body>
</html>
