<!DOCTYPE html>
<html lang="en">

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
    <h1>Generate your Characters</h1>
    <p id="title">Fill out the options and generate your customized JSON template code.</p>
    <!-- Select All Checkbox -->
    <label class="custom-checkbox">
      <input type="checkbox" id="selectAll">
      <span class="checkmark"></span>
      Select All
    </label>

    <!-- Search input field -->
    <!-- <input type="text" id="searchInput" placeholder="Search..." oninput="filterItems()">-->
  </header>

  <form id="form">
    <fieldset>
      <?php
      $json_data = file_get_contents("https://github.com/HerrErde/subway-source/releases/latest/download/characters_links.json");
      $items = json_decode($json_data);

      foreach ($items as $item): ?>
        <div class="item">
          <label class="custom-checkbox">
            <input class="select-checkbox" type="checkbox" name="item[]" value="<?= $item->number ?>">
            <span class="checkmark"></span>
            <?= $item->name ?>
          </label>
          <label class="custom-checkbox default-checkbox">
            <input class="default-select-checkbox" type="checkbox" name="defaultItem" value="<?= $item->number ?>">
            <span class="checkmark"></span>
            Default
          </label><br>
          <img src="<?= $item->img_url ?>" alt="<?= $item->name ?>">
        </div>
        <?php
      endforeach;
      ?>
    </fieldset>
    <!-- <div id="filteredItems"></div> -->
    <!-- <div class="copy" style="display: inline-block">
      <a class="fa fa-pen-to-square fa-2x" style="cursor: pointer;" href="../editor/character.php">
      </a>
    </div> -->
    <input type="button" class="btn btn-success" value="Submit" onclick="generateUrlFunction()">
  </form>

  <script src="/assets/js/search.js"></script>
  <script src="/assets/js/selall.js"></script>

  <script src="/assets/js/generateUrl.js" url="../generator/character.php"></script>

  <?php require "../require/footer.php"; ?>

</body>

</html>