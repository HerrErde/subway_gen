<?php
$warn = "";
session_start();
if (isset($_SESSION["error"])) {
  $warn = $_SESSION["error"];
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Generate your Characters</title>
  <?php require "../require/connect.php"; ?>
  <?php require "../require/buttons.php"; ?>
</head>

<body>
  <p>
    <?php echo "$warn"; ?>
  </p>
  <header>
    <h1>Generate your Characters</h1>
    <p id="title">Fill the out the options and generate your customized JSON template code.</p>
  </header>

  <form method="get" action="../code/wallet.php">
    <fieldset>
      <?php
      // Define the URL to retrieve the file from
      $url = "https://raw.githubusercontent.com/HerrErde/SubwayBooster/main/Todo/Character.md";

      // Use the file_get_contents function to retrieve the contents of the file
      $file = file_get_contents($url);
      // Use a regular expression to remove any [x] or [ ] characters
      $file = preg_replace("/\[(x| )\] /", "", $file);
      // Split the resulting string into an array using "- " as the delimiter
      $items = explode("- ", $file);
      // Remove the first empty item from the array
      array_shift($items);

      // Initialize counters for the number of items listed and trimmed
      $count_listed = 0;
      $count_trimmed = 0;

      // Loop through each item in the array
      foreach ($items as $item) {
        // Remove any leading or trailing whitespace from the item
        $item_name = trim($item);

        // Check if the item contains parentheses or is empty
        if (
          preg_match("/\(.+\)/", $item_name) || // Check if the item contains parentheses
          preg_match('/^\s*$/', $item_name) // Check if the item is empty
        ) {
          $count_trimmed++; // If the item is trimmed, increment the trimmed counter
          continue; // Skip the rest of the loop for this item
        }
        $count_listed++; // If the item is listed, increment the listed counter
      }

      // Generate HTML code for displaying the counter at the top right corner of the output
      echo "<div style=\"position: relative; text-align: center\">\n";
      echo "<div style=\"position: absolute; top: 0; right: 0;\">$count_listed/" .
        ($count_listed + $count_trimmed) . // Calculate the total number of items (listed + trimmed)
        "</div>";
      ?>

      <?php
      // Loop through each item in the array
      foreach ($items as $item) {
        // Remove any leading or trailing whitespace from the item
        $item_name = trim($item);

        // Check if the item contains parentheses or is empty
        if (
          preg_match("/\(.+\)/", $item_name) || // Check if the item contains parentheses
          preg_match('/^\s*$/', $item_name) // Check if the item is empty
        ) {
          continue; // Skip the rest of the loop for this item
        }

        // Generate HTML code for displaying the item name and image
        echo "<div style=\"display: inline-block;\">
        <input id=\"select\" type=\"checkbox\">
        <label id=\"select\">" . $item_name . "</label><br>
        <img src=\"https://static.wikia.nocookie.net/subwaysurf/images/c/c8/" . urlencode($item_name) . // Encode the item name to be used in the image URL
          "1.png\">
        </div>";
      }

      // Print a closing </div> tag to the output
      echo "</div>";
      ?>

    </fieldset>
    </form>

    <br><input type="submit" class="btn btn-success">

    <br><br><br>
    <?php require "../require/footer.php"; ?>

</html>