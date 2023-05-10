<!DOCTYPE html>
<html lang="en">

<head>
  <title>Generate your Boards</title>
  <?php require "../require/connect.php"; ?>
  <?php require "../require/buttons.php"; ?>
</head>

<body>
  <header>
    <h1>Generate your Boards</h1>
    <p id="title">Fill out the options and generate your customized JSON template code.</p>
  </header>

  <form method="get" action="../code/wallet.php">
    <fieldset>
      <?php
      // Define the URL to retrieve the file from
      $url = "https://raw.githubusercontent.com/HerrErde/SubwayBooster/main/Todo/Boards.md";

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
// Set the API endpoint and query parameters
//$api_url = "https://subwaysurf-api.herrerde.xyz/api/images/boards.php";
$api_url = "http://127.0.0.1:8000/api/images/board.php";
$params = array(
  "search" => $item_name
);

// Build the URL with query parameters
$url = $api_url . "?" . http_build_query($params);

// Make the API request and get the response as a JSON string
$response = file_get_contents($url);

// Parse the JSON string into an array of objects
$items = json_decode($response);

// Start the HTML output
echo "<div>";

// Loop through each item in the array
foreach ($items as $item) {
  // Generate HTML code for displaying the item name and image
  echo "<div class=\"item\">
  <input id=\"select\" type=\"checkbox\">
  <label id=\"select\">" . $item->name . "</label><br>
  <img data-src=\"" . $item->img . "\">
  </div>";
}

// Print a closing </div> tag to the output
echo "</div>";
?>
<script src="../assets/js/load-scroll.js"></script>

  </fieldset>
</form>

<br><input type="submit" class="btn btn-success">

<?php require "../require/footer.php"; ?>

</html>