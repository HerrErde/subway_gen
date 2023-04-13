<?php
$required_params = [
  "hoverboards",
  "gamekeys",
  "gamecoins",
  "scoreboosters",
  "headstarts",
  "eventcoins",
];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Code for the wallet.json file</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <?php require "../require/connect.php"; ?>
  </head>

  <body>
    <header>
      <h1>Code for the Wallet</h1>
      <p id="title">
        Copy the generated code, find the file wallet.json in the folder
        "profile" and paste it there.
      </p>
    </header>

  <div class="btn btn-upload-input">
    <span class="btn-upload-input-title">
      <i class="fa fa-upload"></i>Choose File</span>
    <input type="file" name="jsonFile" id="jsonFileInput" accept=".json" />
  </div>


<div>
    <textarea id="textarea" rows="30" cols="30" readonly></textarea>
</div>
  <form>
  <div class="btn btn-success download" style="display: inline-block">
    <a onclick="downloadJson()">Download</a>
  </div>
  </form>
    <script>
        // Function to read and display JSON contents in textarea
        function readJSONFile(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
              document.getElementById('textarea').value = e.target.result;
            };
            reader.readAsText(input.files[0]);
          }
        }

        // Add event listener to file input
        document
          .querySelector('#jsonFileInput')
          .addEventListener('change', function () {
            var fileName = this.files[0].name;
            if (fileName !== 'wallet.json') {
              alert('Please select a file named "wallet.json"');
              this.value = ''; // reset the file input
              document.getElementById('textarea').value = ''; // reset the textarea
              $('.btn-upload-input-title').html(
                '<i class="fa fa-upload fw"></i>Choose File'
              ); // reset the button text
            } else {
              readJSONFile(this);
              $('.btn-upload-input-title').text(fileName); // set the button text to the selected file name
            }
          });

        // script.js
        ('use strict');
        $(function () {
          var btnTitle = $('.btn-upload-input-title').html();
          var btnTitleHtml = $.parseHTML(btnTitle);
          $('.btn-upload-input input:file').change(function () {
            console.log('im clicked' + this.files.length);
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
    <?php require "../require/buttons.php"; ?>
    <br /><br /><br />
    <?php require "../require/footer.php"; ?>
  </body>
</html>
