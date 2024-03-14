// JavaScript for Select All checkbox
document.getElementById('selectAll').addEventListener('change', function () {
  var checkboxes = document.querySelectorAll('.select-checkbox');
  checkboxes.forEach(function (checkbox) {
    checkbox.checked = document.getElementById('selectAll').checked;
  });
});

// JavaScript for selecting item when clicking anywhere on the div
document.querySelectorAll('.item').forEach((item) => {
  item.addEventListener('click', () => {
    const checkbox = item.querySelector('.select-checkbox');
    checkbox.checked = !checkbox.checked;
  });
});

// JavaScript for Selecting Item When Default Checkbox is Selected
document
  .querySelectorAll('.default-select-checkbox')
  .forEach((defaultCheckbox) => {
    defaultCheckbox.addEventListener('change', function () {
      // Select the corresponding item checkbox when default checkbox is selected
      const itemCheckbox =
        this.parentElement.parentElement.querySelector('.select-checkbox');
      itemCheckbox.checked = this.checked;

      if (this.checked) {
        // Uncheck all other default checkboxes
        document
          .querySelectorAll('.default-select-checkbox')
          .forEach((checkbox) => {
            if (checkbox !== this) {
              checkbox.checked = false;
            }
          });
      }
    });
  });
