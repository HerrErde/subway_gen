<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(E_ERROR | E_PARSE);
// Fetch and decode the JSON data from the GitHub API
$json = json_decode(file_get_contents("https://api.github.com/repos/HerrErde/subway-source/releases/latest", false, stream_context_create(['http' => ['header' => "User-Agent: PHP"]])), true);

// Check the version and prepare the warning message
$warningMessage = ($json['tag_name'] == "3-34-0") ? "Generation will be inaccurate until the next version." : "";

echo "<script>
          document.addEventListener('DOMContentLoaded', function() {
            if ('$warningMessage' !== '') {
              document.getElementById('title').innerHTML += '<p style=\"color: red;\">$warningMessage</p>';
            }
          });
        </script>";
?>

<head>
  <title>Generate your Characters</title>
  <?php
  $activePage = basename(__FILE__, '.php');
  require "../require/connect.php";
  require "../require/buttons.php";
  ?>
  <link rel="stylesheet" href="/assets/css/gen.css">
</head>

<body>
  <header>
    <h1>Generate your Playerprofile</h1>
    <p id="title">Fill out the options and generate your customized JSON template code.</p>
    <label class="custom-checkbox">
      <input type="checkbox" id="selectAll">
      <span class="checkmark"></span>
      Select All
    </label>

  </header>

  <form id="form">
    <fieldset>
      <?php
      $json_data = file_get_contents("https://github.com/HerrErde/subway-source/releases/latest/download/playerprofile_links.json");
      $items = json_decode($json_data);

      $counter = 1;
      foreach ($items->Portraits as $item): ?>
        <div class="item">
          <label class="custom-checkbox">
            <input class="select-checkbox" type="checkbox" name="item[]" value="<?= $counter ?>">
            <span class="checkmark"></span>
            <?= $item->name ?>
          </label>
          <label class="custom-checkbox default-checkbox">
            <input class="default-select-checkbox" type="checkbox" name="defaultItem" value="<?= $counter ?>">
            <span class="checkmark"></span>
            Default
          </label><br>
          <img src="<?= $item->img_url ?>" alt="<?= $item->name ?>">
        </div>
        <?php
        $counter++;
      endforeach;
      ?>
    </fieldset>
    <div id="filteredItems"></div>
    <input type="button" class="btn btn-success" value="Generate URL" onclick="generateUrlFunction()">
  </form>


  <script src="/assets/js/search.js"></script>
  <script src="/assets/js/selall.js"></script>

  <script src="/assets/js/generateUrl.js" url="../generator/portraits.php"></script>

  <?php require "../require/footer.php"; ?>

</body>

</html>