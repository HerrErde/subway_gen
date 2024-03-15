<?php
// Function to get the ID from the json file based on item number
function getItemId($itemNumber, $jsonArray)
{
    foreach ($jsonArray as $item) {
        if ($item['number'] == $itemNumber) {
            return $item;
        }
    }
    return null; // Return null if item number not found
}

// Fetch and decode the json file
$json_url = 'https://github.com/HerrErde/subway-source/releases/latest/download/boards_data.json';
$json_data = file_get_contents($json_url);
$item_data = json_decode($json_data, true);

// Extract the "select" number and the items from the URL parameters
$selectNumber = isset($_GET['select']) ? $_GET['select'] : null;
$items = isset($_GET['items']) ? json_decode($_GET['items']) : [];

// Initialize an array to store the IDs
$itemIds = [];

// JavaScript for logging picked items
$logScript = '<script>';
foreach ($items as $item) {
    $item = getItemId($item, $item_data);
    if ($item !== null) {
        $itemIds[] = $item['id'];
        $logScript .= 'console.log("Item: ' . $item['number'] . ', ID: ' . $item['id'] . '");';
    }
}

// Fetch the item ID based on the provided number
$selectedItemId = null;
if ($selectNumber !== null) {
    $item = getItemId($selectNumber, $item_data);
    if ($item !== null) {
        $selectedItemId = $item['id'];
        $logScript .= 'console.log("Select number: ' . $selectNumber . ', Selected item ID: ' . $selectedItemId . '");';
    }
}

$logScript .= '</script>';

// Initialize an array to store the datalist objects
$datalist = [];

// Generate datalist objects for each selected item
foreach ($items as $item) {
    $item = getItemId($item, $item_data);
    if ($item !== null) {
        // Create the datalist object for the current item
        $ownedUpgrades = [];
        if ($item['upgrades'] !== null) {
            // If upgrades exist, include all upgrades with "value" set to true
            foreach ($item['upgrades'] as $upgrade) {
                $ownedUpgrades[$upgrade['id']] = ["value" => true];
            }
        } else {
            // If upgrades are null, include only the "default" upgrade
            $ownedUpgrades['default'] = ["value" => true];
        }

        $datalist[$item['id']] = [
            "value" => [
                "id" => $item['id'],
                "ownedUpgrades" => $ownedUpgrades
            ]
        ];
    }
}

// Construct the main JSON object
$mainJsonObject = [
    "version" => 3,
    "data" => "{\"selected\":\"$selectedItemId\",\"owned\":" . json_encode($datalist) . "}",
];

// Convert the main JSON object to a string and remove spaces
$textareaContent = json_encode($mainJsonObject);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Code for the boards_inventory.json file</title>
    <?php
    $activePage = basename(__FILE__, '.php');
    require "../require/connect.php";
    ?>
    <script src="../assets/js/download.js"></script>

    <?= $logScript ?> <!-- Include the JavaScript for logging -->
    <script>
        var filename = 'boards_inventory.json';
    </script>
</head>

<body>
    <header>
        <h1>Code for your Board Inventory</h1>
        <p id="title">
            Download or copy the generated code, find the file boards_inventory.json in the
            folder "profile" and paste it there.
        </p>
        <p id="warning">
            Note that this may restart some statistics and you're using it at your
            own risk.
        </p>
    </header>

    <textarea name="textarea" rows="35" cols="60" readonly><?= $textareaContent ?></textarea>

    <?php
    $activePage = basename(__FILE__, '.php');
    require "../require/down-copy.php";
    require "../require/buttons.php";
    require "../require/footer.php";
    ?>
    <br><br><br>
</body>

</html>