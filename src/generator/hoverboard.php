<?php
$errors = [];

if (!empty($errors)) {
    $_SESSION["error"] = implode("<br>", $errors);
    header("Location: ../page/error.php");
    exit();
}


// Function to decompress the compressed data
function decompress($compressed)
{
    $decompressed = [];

    foreach ($compressed as $item) {
        if (strpos($item, '-') !== false) {
            list($start, $end) = array_map('intval', explode('-', $item));
            $decompressed = array_merge($decompressed, range($start, $end));
        } else {
            $decompressed[] = intval($item);
        }
    }

    return $decompressed;
}

// Function to get the ID from the json file based on item number
function getItemId($itemNumber, $jsonArray)
{
    foreach ($jsonArray as $item) {
        if ($item['number'] == $itemNumber) {
            return $item;
        }
    }
    return null;
}

$json_url = 'https://github.com/HerrErde/subway-source/releases/latest/download/boards_data.json';
$json_data = file_get_contents($json_url);
$item_data = json_decode($json_data, true);

// Extract the "select" number and the items from the URL parameters
$selectNumber = isset($_GET['select']) ? $_GET['select'] : null;

// Parse the items parameter directly from the URL
$itemsParam = isset($_GET['items']) ? $_GET['items'] : '';
$items = [];

// Extract items from the URL parameter
if (preg_match_all('/(\d+-\d+|\d+)/', $itemsParam, $matches)) {
    $items = $matches[0];
}

// Decompress the items
$decompressedItems = decompress($items);

$itemIds = [];

// JavaScript for logging picked items
$logScript = '<script>';
foreach ($decompressedItems as $item) {
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

$datalist = [];

// Generate datalist objects for each selected item
foreach ($decompressedItems as $item) {
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

$mainJsonObject = [
    "version" => 3,
    "data" => "{\"selected\":\"$selectedItemId\",\"owned\":" . json_encode($datalist) . "}",
];

// convert object to string and remove spaces
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
    <script src="/assets/js/download.js"></script>

    <?= $logScript ?>
    <script>
        var filename = 'boards_inventory.json';
    </script>
</head>

<body>
    <header>
        <h1>Code for your Hoverboard Inventory</h1>
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
    require "../require/down-copy.php";
    require "../require/buttons.php";
    require "../require/footer.php";
    ?>
    <br><br><br>
</body>

</html>