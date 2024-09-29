<?php
$errors = [];

if (!empty($errors)) {
    $_SESSION["error"] = implode("<br>", $errors);
    header("Location: ../page/error.php");
    exit();
}

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

function getItemId($itemNumber, $jsonArray)
{
    foreach ($jsonArray as $index => $item) {
        if ($index + 1 == $itemNumber) { // Match by index (1-based)
            return [
                'id' => $item,
                'number' => $itemNumber
            ];
        }
    }
    return null; // Return null if item number not found
}

$json_url = 'https://github.com/HerrErde/subway-source/releases/latest/download/playerprofile_data.json';
$json_data = file_get_contents($json_url);
$item_data = json_decode($json_data, true);

$profilePortraits = $item_data['profilePortraits'];

$selectNumber = isset($_GET['select']) ? $_GET['select'] : null;

$itemsParam = isset($_GET['items']) ? $_GET['items'] : '';
$items = [];

if (preg_match_all('/(\d+-\d+|\d+)/', $itemsParam, $matches)) {
    $items = $matches[0];
}

$decompressedItems = decompress($items);

$itemIds = [];

$logScript = '<script>';
foreach ($decompressedItems as $item) {
    $item = getItemId($item, $profilePortraits);
    if ($item !== null) {
        $itemIds[] = $item['id'];
        $logScript .= 'console.log("Item: ' . $item['number'] . ', ID: ' . $item['id'] . '");';
    }
}

// Fetch the item ID based on the provided number
$selectedItemId = null;
if ($selectNumber !== null) {
    $item = getItemId($selectNumber, $profilePortraits);
    if ($item !== null) {
        $selectedItemId = $item['id'];
        $logScript .= 'console.log("Select number: ' . $selectNumber . ', Selected ID: ' . $selectedItemId . '");';
    }
}

$logScript .= '</script>';

$datalist = [];

foreach ($decompressedItems as $item) {
    $item = getItemId($item, $profilePortraits);
    if ($item !== null) {
        $datalist[$item['id']] = [
            "id" => $item['id'],
            "isSeen" => True
        ];
    }
}

$mainJsonObject = [
    "version" => 1,
    "data" => "{\"selected\":{\"$selectedItemId\"},\"owned\":" . json_encode($datalist) . "}",
];

$textareaContent = json_encode($mainJsonObject);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Code for the profile_portrait.json file</title>
    <?php
    $activePage = basename(__FILE__, '.php');
    require "../require/connect.php";
    ?>
    <script src="/assets/js/download.js"></script>
    <script>
        var filename = 'profile_portrait.json';
    </script>
    <?= $logScript ?>
</head>

<body>
    <header>
        <h1>Code for your Playerprofile</h1>
        <p id="title">
            Download or copy the generated code, find the file profile_portrait.json in the
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