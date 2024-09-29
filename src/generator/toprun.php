<?php
$required_params = ["highscore", "userstatsAmount"];

$errors = [];

if (!empty($errors)) {
  $_SESSION["error"] = implode("<br>", $errors);
  header("Location: ../page/error.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Code for the top_run.json file</title>
  <?php
  $activePage = basename(__FILE__, '.php');
  require "../require/connect.php";
  ?>
  <script src="/assets/js/download.js"></script>
</head>

<body>
  <header>
    <h1>Code for your Highscore</h1>
    <p id="title">
      Download or copy the generated code, find the file top_run.json and user_stats.json in the
      folder "profile" and paste it there.
    </p>
    <p id="warning">
      Note that this may restart some statistics and you're using it at your
      own risk.
    </p>
  </header>
  <textarea id="textarea1" rows="35" cols="35" readonly><?php require "../code/top_run.php"; ?></textarea>
  <textarea id="textarea2" rows="35" cols="35" readonly><?php require "../code/user_stats.php"; ?></textarea>

  <form method="post">
    <div class="btn btn-success download" style="display: inline-block">
      <i class="fa-solid fa-download"></i>
      <a onclick="download2Json('textarea1', 'top_run.json')">Top Run</a>
    </div>
    <div class="btn btn-success download" style="display: inline-block">
      <i class="fa-solid fa-download"></i>
      <a onclick="download2Json('textarea2', 'user_stats.json')">
        User Stats</a>
    </div>
  </form>

  <?php
  require "../require/buttons.php";
  require "../require/footer.php";
  ?>
</body>

</html>