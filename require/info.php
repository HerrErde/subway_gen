<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <script src="../assets/js/githubRelease.js"></script>
  </head>
  <body>
    <h2>Android Tutorial</h2>
    <ol style="display: grid; place-items: center">
      <li>
        Download
        <a
          href="https://play.google.com/store/apps/details?id=com.kiloo.subwaysurf"
          style="color: lightgreen; text-decoration: underline"
          >Subway Surfers</a
        >.
      </li>
      <li>Open your file manager app.</li>
      <li>Navigate between the folders.</li>
      <li>Android > data > com.kiloo.subwaysurf > files > profile</li>
      <li>
        Download or copy the generated code, find the file in the folder "profile" and paste
        it there.
      </li>
    </ol>
    <h2>Available generators</h2>
    <?php
    $url = "https://raw.githubusercontent.com/HerrErde/SubwayBooster/main/Android/data/com.kiloo.subwaysurf/files/version.json";
    $playapi = "https://gplayapi.srik.me/api/apps/com.kiloo.subwaysurf";

    $json = json_decode(file_get_contents($url), true);
    $api = json_decode(file_get_contents($playapi), true);
    ?>

<div class="version-info">
  <div class="version-column">
    <div>
      <span>Latest Version:</span>
      <span>v<?= $json["version"] ?></span>
    </div>
    <div>
      <span>Next Release:</span>
      <span id="release"></span>
    </div>
  </div>
  <div class="version-column">
    <div>
      <span>Latest App Version:</span>
      <span><?= $api["version"] ?></span>
    </div>
    <div>
      <span>Supported App Version:</span>
      <span><?= $json["appversion"] ?></span>
    </div>
  </div>
</div>
  </body>
</html>
