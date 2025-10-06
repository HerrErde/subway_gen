<!DOCTYPE html>
<html lang="en">

<head>
  <title>Generate your Hoverboards</title>
  <?php
  $activePage = basename(__FILE__, '.php');
  require "../require/connect.php";
  require "../require/buttons.php";
  ?>
  <link rel="stylesheet" href="/assets/css/gen.css">
  <script src="/assets/js/load-scroll.js"></script>
</head>

<body>
  <header>
    <h1>Generate your Hoverboards</h1>
    <p id="title">Fill out the options and generate your customized JSON template code.</p>
    <!-- Select All Checkbox -->
    <label class="custom-checkbox">
      <input type="checkbox" id="selectAll">
      <span class="checkmark"></span>
      Select All
    </label>

    <input type="text" id="searchInput" placeholder="Search..." oninput="filterItems()">
  </header>

  <form id="form">
    <fieldset>
      <?php
      $json_data = file_get_contents("https://github.com/HerrErde/subway-source/releases/latest/download/boards_links.json");
      $items = json_decode($json_data);
      $fallback_img = "../assets/img/board_default_silhouette_preview_big.png";

      foreach ($items as $item): ?>
        <div class="item">
          <label class="custom-checkbox">
            <input class="select-checkbox" type="checkbox" value="<?= $item->number ?>">
            <span class="checkmark"></span>
            <?= $item->name ?>
          </label>
          <label class="custom-checkbox default-checkbox">
            <input class="default-select-checkbox" type="checkbox" name="defaultItem" value="<?= $item->number ?>">
            <span class="checkmark"></span>
            Default
          </label><br>
          <img data-src="<?= $item->img_url ?>" src="<?= $fallback_img ?>" alt="<?= $item->name ?>"
            onerror="this.onerror=null; this.src='<?= $fallback_img ?>';">
        </div>
        <?php
      endforeach;
      ?>
    </fieldset>
    <div class="copy" style="display: inline-block">
      <a class="fa fa-pen-to-square fa-2x" style="cursor: pointer;" href="../editor/hoverboard.php"></a>
    </div>
    <input type="button" class="btn btn-success" value="Submit" onclick="generateUrlFunction()">
  </form>

  <script src="/assets/js/search.js"></script>
  <script src="/assets/js/selall.js"></script>

  <script src="/assets/js/generateUrl.js" url="../generator/hoverboard.php"></script>

  <?php require "../require/footer.php"; ?>

</body>

</html>