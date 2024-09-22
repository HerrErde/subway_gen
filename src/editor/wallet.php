<!DOCTYPE html>
<html lang="en">

<?php
$required_params = [
  "gamecoins",
  "gamekeys",
  "hoverboards",
  "headstarts",
  "scoreboosters",
  "eventcoins",
];
?>

<head>
  <title>Edit your wallet.json file</title>
  <?php
  $activePage = basename(__FILE__, '.php');
  require "../require/connect.php";
  require "../require/buttons.php";
  ?>
  <style>
    body.dragging {
      background-color: #f0f0f0;
      transition: background-color 0.3s ease;
    }
  </style>
</head>

<body>
  <header>
    <h1>Edit your Wallet</h1>
    <p id="title">
      Drag your wallet.json file anywhere on the page or click to select a file, and then edit away.<br> After that,
      download or copy the file into the folder "profile".
    </p>
  </header>

  <div class="btn btn-upload-input">
    <span class="btn-upload-input-title">
      <i class="fa fa-upload"></i>Choose File
    </span>
    <input type="file" name="jsonFile" id="jsonFileInput" accept=".json" />
  </div>

  <div style="display: flex;">
    <div style="flex: 1; justify-content: flex-start;">
      <textarea id="textarea" rows="35" cols="45" readonly></textarea>
    </div>
    <div style="flex: 1; justify-content: flex-end;">
      <form id="fileData" method="get" action="../generator/wallet.php">
        <legend class="gamedata-title">Game data</legend>
        <?php foreach ($required_params as $param): ?>
          <label>
            <?php echo ucfirst($param); ?>:
          </label><span class="required">*</span><br />
          <input type="number" name="<?php echo $param; ?>" id="<?php echo $param; ?>" min="1" max="2147483647" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' oninput="updateJSON()" required>
          <br>
        <?php endforeach; ?>
        <input type="submit" class="btn btn-success" value="Submit">
      </form>
    </div>
  </div>

  <script>
    // Update the JSON in the textarea based on input values using wallet.php
    function updateJSON() {
      // Collect values from the form fields
      var formData = new FormData(document.getElementById('fileData'));

      // Send an AJAX request to wallet.php with the form data
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '../code/wallet.php?' + new URLSearchParams(formData).toString(), true);

      xhr.onload = function () {
        if (xhr.status === 200) {
          // Set the response (wallet.json content) into the textarea
          document.getElementById('textarea').value = xhr.responseText;
        } else {
          alert('Error generating wallet.json: ' + xhr.status);
        }
      };

      xhr.send();
    }

    // Handle drag-and-drop for the entire page
    var fileInput = document.getElementById('jsonFileInput');

    document.addEventListener('dragover', function (e) {
      e.preventDefault();
      document.body.classList.add('dragging');
    });

    document.addEventListener('dragleave', function () {
      document.body.classList.remove('dragging');
    });

    document.addEventListener('drop', function (e) {
      e.preventDefault();
      document.body.classList.remove('dragging');

      var files = e.dataTransfer.files;
      if (files.length > 0) {
        if (files[0].name !== 'wallet.json') {
          alert('Please select a file named "wallet.json"');
        } else {
          fileInput.files = files; // Set files to the input element
          readJSONFile(fileInput);
        }
      }
    });

    // Handle file selection through the input
    fileInput.addEventListener('change', function () {
      if (this.files[0].name !== 'wallet.json') {
        alert('Please select a file named "wallet.json"');
        this.value = ''; // Reset the input
        document.getElementById('textarea').value = ''; // Reset the textarea
      } else {
        readJSONFile(this);
      }
    });

    // Function to read and display JSON contents in textarea
    function readJSONFile(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          document.getElementById('textarea').value = e.target.result;

          // Parse JSON and populate input fields
          var jsonData = JSON.parse(e.target.result);
          var currencies = JSON.parse(jsonData.data).currencies;

          var requiredParams = <?php echo json_encode($required_params); ?>;
          requiredParams.forEach(function (param, index) {
            var currencyId = index + 1;
            var value = currencies[currencyId]?.value || '';
            document.getElementById(param).value = value;
          });
        };
        reader.readAsText(input.files[0]);
      }
    }
  </script>

  <?php require "../require/footer.php"; ?>
</body>

</html>