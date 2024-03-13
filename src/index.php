<!DOCTYPE html>
<html lang="en">

<head>
  <title>A JSON code template generator for Subway Surfers.</title>
  <?php require "require/connect.php"; ?>
</head>

<body>
  <header>
    <h1>A JSON code template generator for Subway Surfers.</h1>
    <p id="title">Earn coins, keys and more for free in Subway Surfers.</p>
    <img src="/assets/img/subwaysurf-matrix-min.png" />
  </header>
  <?php require "require/info.php"; ?>
  <?php
  $activePage = basename(__FILE__, '.php');
  require "require/buttons.php";
  ?>
  <?php require "require/footer.php"; ?>
</body>

</html>