<!DOCTYPE html>
<html lang="en">

<head>
  <title>Edit your characters_inventory.json file</title>
  <?php
  $activePage = basename(__FILE__, '.php');
  require '../require/connect.php';
  require '../require/buttons.php';
  ?>
  <link rel="stylesheet" href="/assets/css/gen.css">
  <script src="/assets/js/load-scroll.js"></script>
  <style>
    body.dragging {
      background-color: #f0f0f0;
      transition: background-color 0.3s ease;
    }

    .btn-upload-input-title {
      transition: color 0.3s ease, background-color 0.3s ease;
    }

    .file-selected {
      color: rgb(64, 236, 104);
      font-weight: bold;
    }

    .file-input {
      display: none;
    }

    .file-input-wrapper {
      display: inline-block;
      position: relative;
    }

    .file-input-label {
      display: inline-block;
      padding: 10px 20px;
      background-color: rgb(0, 123, 255);
      color: #fff;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
      font-size: 16px;
    }

    .file-input-label:hover {
      background-color: rgb(34, 141, 255);
    }
  </style>
</head>


<body>
  <header>
    <h1>Edit your Characters</h1>
    <p id="title">
      Select your characters_inventory.json file, and then edit away.<br>
      After that, download or copy the file into the folder "profile".
    </p>
  </header>

  <div>
    <div class="file-input-wrapper">
      <input type="file" id="jsonFileInput" class="file-input" accept=".json" />
      <label for="jsonFileInput" id="fileInputTitle" class="file-input-label">
        <i class="fa fa-upload"></i> Choose a file
      </label>
    </div>
    <script>
      const fileInput = document.getElementById('jsonFileInput');
      const fileInputTitle = document.getElementById('fileInputTitle');

      fileInput.addEventListener('change', function () {
        if (this.files[0].name !== 'characters_inventory.json') {
          alert('Please select a file named "hoverboard_inventory.json"');
        } else {
          readJSONFile(this);
          console.log(`${this.files[0].name} was loaded`);
        }

        // Update the file selection title
        if (this.files && this.files.length > 0) {
          fileInputTitle.innerHTML = `<i class="fa fa-file"></i> ${this.files[0].name}`;
          fileInputTitle.classList.add('file-selected');
        }
      });

      // Function to read and parse the uploaded JSON file
      function readJSONFile(input) {
        if (input.files && input.files[0]) {
          const reader = new FileReader();

          reader.onload = function (e) {
            try {
              // Parse the uploaded JSON file
              const jsonData = JSON.parse(e.target.result);

              // Ensure the `data` field is parsed as JSON (if it's a string)
              if (jsonData.data && typeof jsonData.data === 'string') {
                jsonData.data = JSON.parse(jsonData.data); // Convert to JSON object
              }

              // Access `selected.character` and `selected.outfit` from the parsed `data`
              if (jsonData.data.selected) {
                const selectedCharacter = jsonData.data.selected.character;
                const selectedOutfit = jsonData.data.selected.outfit;

                console.log("Selected Character:", selectedCharacter);
                console.log("Selected Outfit:", selectedOutfit);
                updateSelect(this);
              } else {
                console.log("No 'selected' field found in data.");
              }
            } catch (err) {
              console.error("Error parsing JSON:", err.message);
              alert('Error parsing the file. Please ensure it is a valid JSON file.');
            }
          };

          // Read the file as text
          reader.readAsText(input.files[0]);
        }
      }
    </script>
  </div>

  <form id="form">
    <fieldset>
      <?php
      // PHP code to dynamically generate checkboxes based on characters_links.json
      $json_data = file_get_contents('https://github.com/HerrErde/subway-source/releases/latest/download/characters_links.json');
      $items = json_decode($json_data);
      $fallback_img = "https://static.wikia.nocookie.net/subwaysurf/images/d/da/MissingSurfer1.png";

      foreach ($items as $item):
        ?>
        <div class="item">
          <label class="custom-checkbox">
            <input class="select-checkbox" type="checkbox" name="item" value="<?= $item->number ?>">
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
      <?php endforeach; ?>
    </fieldset>
    <input type="button" class="btn btn-success" value="Submit" onclick="generateUrlFunction()">
  </form>

  <script>
    document.getElementById('jsonFileInput').addEventListener('change', function () {
      processUploadedFile(this);
    });

    function processUploadedFile(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = async function (e) {
          try {
            const jsonData = JSON.parse(e.target.result);

            // If the 'data' field is a string, parse it into an object
            if (jsonData.data && typeof jsonData.data === 'string') {
              jsonData.data = JSON.parse(jsonData.data);
            }

            const selectedCharacter = jsonData.data?.selected?.character;
            const ownedCharacters = jsonData.data?.owned;

            const proxyUrl = 'https://corsproxy.io/?url=';
            const jsonUrl = 'https://github.com/HerrErde/subway-source/releases/latest/download/characters_data.json';

            const data = await fetch(proxyUrl + jsonUrl).then(response => response.json());

            // selected characters
            if (selectedCharacter) {
              console.log("Selected Character:", selectedCharacter);
              updateSelect(data, selectedCharacter);
            } else {
              console.warn("No selected character found in the data.");
            }

            // owned characters
            if (ownedCharacters) {
              Object.keys(ownedCharacters).forEach(characterKey => {
                const character = ownedCharacters[characterKey];
                const characterId = character.value.id;

                updateOwnedCheckbox(data, characterId);
              });
            } else {
              console.warn("No owned characters found in the data.");
            }
          } catch (err) {
            console.error("Error parsing JSON:", err.message);
            alert('Error parsing the file. Please ensure it is a valid JSON file.');
          }
        };

        reader.readAsText(input.files[0]);
      }
    }

    async function updateSelect(characterData, selectedCharacter) {
      try {
        // If characterData is an object, check its keys or properties
        for (const key in characterData) {
          const character = characterData[key];
          if (character.id === selectedCharacter) {
            const characterNumber = character.number;
            const checkbox = document.querySelector(`input.default-select-checkbox[value="${characterNumber}"]`);
            if (checkbox) {
              checkbox.checked = true;
              console.log(`Checkbox for default character "${selectedCharacter}" (number: ${characterNumber}) is now checked.`);
            }
            break; // Exit loop once character is found
          }
        }
      } catch (error) {
        console.error("Error in updateSelect function:", error);
      }
    }




    async function updateOwnedCheckbox(characterData, characterId) {
      try {
        const character = characterData.find(item => item.id === characterId);
        if (character) {
          const characterNumber = character.number;
          const checkbox = document.querySelector(`input.select-checkbox[value="${characterNumber}"]`);
          if (checkbox) {
            checkbox.checked = true;
            console.log(`Checkbox for owned character "${characterId}" (number: ${characterNumber}) is now checked.`);
          }
        } else {
          console.warn(`Owned character "${characterId}" not found in the data.`);
        }
      } catch (error) {
        console.error("Error in updateOwnedCheckbox function:", error);
      }
    }
  </script>

  <script src="/assets/js/generateUrl.js" url="../generator/character.php"></script>

  <?php require '../require/footer.php'; ?>
</body>

</html>