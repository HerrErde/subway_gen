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
</head>

<body>
  <header>
    <h1>Edit your Wallet</h1>
    <p id="title">
      Upload your wallet.json file (unencrypted) and then edit away, <br>after that just download or copy the file into
      the folder "profile".
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
        <legend>Game data</legend>
        <?php foreach ($required_params as $param): ?>
          <label>
            <?php echo ucfirst($param); ?>:
          </label><br />
          <input type="number" name="<?php echo $param; ?>" id="<?php echo $param; ?>" max="2147483647" name="eventcoins"
            type="number" min="1" max="2147483647" step="1"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
          <span class="required">*</span><br>
        <?php endforeach; ?>
        <input type="submit" class="btn btn-success" />
      </form>
    </div>
  </div>

  <script>
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


    // Add event listener to file input
    document.querySelector('#jsonFileInput').addEventListener('change', function () {
      var fileName = this.files[0].name;
      if (fileName !== 'wallet.json') {
        alert('Please select a file named "wallet.json"');
        this.value = ''; // Reset the file input
        document.getElementById('textarea').value = ''; // Reset the textarea
        $('.btn-upload-input-title').html('<i class="fa fa-upload fw"></i>Choose File'); // Reset the button text
      } else {
        readJSONFile(this);
        $('.btn-upload-input-title').text(fileName); // Set the button text to the selected file name
      }
    });

    ('use strict');
    $(function () {
      var btnTitle = $('.btn-upload-input-title').html();
      var btnTitleHtml = $.parseHTML(btnTitle);
      $('.btn-upload-input input:file').change(function () {
        if (this.files && this.files.length >= 1) {
          var file = this.files[0];
          var reader = new FileReader();
          // Set preview image into the popover data-content
          reader.onload = function (e) {
            $('.btn-upload-input-title').text(file.name);
          };
          reader.readAsDataURL(file);
        } else {
          $('.btn-upload-input-title').html(btnTitle);
        }
      });
    });
  </script>
  <br>
  <br><br><br>
  <?php require "../require/footer.php"; ?>
</body>

</html>