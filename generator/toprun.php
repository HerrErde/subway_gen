<?php
$required_params = ["highscore"];

session_start();

foreach ($required_params as $param) {
  if (!isset($_GET[$param])) {
    $_SESSION["error"] = "Failed to generate. Try again.";
    header("Location:../code/top_run.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Code for the top_run.json file</title>
    <script src="../assets/js/script.js"></script>
    <script>
      var filename1 = 'toprun.json';
      var filename2 = 'user_stats.json';
    </script>
    <?php require "../require/connect.php"; ?>
  </head>

  <body>
    <header>
      <h1>Code for your Highscore</h1>
      <p id="title">
        Download or copy the generated code, find the file wallet.json in the folder
        "profile" and paste it there.
      </p>
      <p id="warning">
        Note that this may restart some statistics and you're using it at your
        own risk.
    </p>
    </header>
  <textarea id="textarea1" rows="35" cols="35" readonly>
    <?php require "../code/top_run.php"; ?>
  </textarea>
  <textarea id="textarea2" rows="35" cols="35" readonly>
    <?php require "../code/user_stats.php"; ?>
  </textarea>
  
  <form method="post">
  <div class="btn btn-success download" style="display: inline-block">
    <a onclick="download2Json('textarea1', 'toprun.json')">Top Run</a>
  </div>
  <div class="btn btn-success download" style="display: inline-block">
    <a onclick="download2Json('textarea2', 'user_stats.json')">User Stats</a>
  </div>
</form>

    <?php require "../require/buttons.php"; ?>
    <br /><br /><br />
    <?php require "../require/footer.php"; ?>
  </body>
</html>
