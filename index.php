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
    <img
      src="/assets/img/subwaysurf-matrix.png">
  </header>
  <?php require "require/info.php"; ?>

  <br><br><br>
  <div style="color: #aaa; font-size: 17px">
  <span id="visits">undefined</span> times visited.
  </p>
  <!-- <script async src="https://api.countapi.xyz/hit/subway.herrerde.xyz/?callback=websiteVisits"></script> -->
  <script>
    function websiteVisits(response) {
      document.querySelector("#visits").textContent = response.value;
    }
  </script>
  </div>
  <?php require "require/footer.php"; ?>

</html>
