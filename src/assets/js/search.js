function filterItems() {
  // Get the input value and convert it to lowercase
  var input = document.getElementById('searchInput').value.toLowerCase();

  // Get the items and filteredItems div
  var items = document.getElementsByClassName('item');
  var filteredItems = document.getElementById('filteredItems');

  // If the input is empty, remove the filter from all items and show them
  if (input.trim() === '') {
    for (var i = 0; i < items.length; i++) {
      var item = items[i];
      item.style.display = '';
      item.classList.remove('filtered');
      item.style.filter = ''; // Remove the gray filter
      var images = item.getElementsByTagName('img');
      for (var j = 0; j < images.length; j++) {
        images[j].style.filter = ''; // Remove the gray filter from the images
      }
    }
    filteredItems.innerHTML = '';
  } else {
    // Loop through the items and check if they contain the input string
    for (var i = 0; i < items.length; i++) {
      var item = items[i];
      var label = item.getElementsByTagName('label')[0];
      var name = label.textContent || label.innerText;

      // If the item contains the input string, show it and remove the gray filter; otherwise, hide it and add the filtered class
      if (name.toLowerCase().includes(input)) {
        item.style.display = '';
        item.style.filter = ''; // Remove the gray filter
        filteredItems.appendChild(item);
        var images = item.getElementsByTagName('img');
        for (var j = 0; j < images.length; j++) {
          images[j].style.filter = ''; // Remove the gray filter from the images
        }
      } else {
        item.style.display = 'none';
        item.classList.add('filtered');
        item.style.filter = 'grayscale(100%)'; // Add a gray filter
        var images = item.getElementsByTagName('img');
        for (var j = 0; j < images.length; j++) {
          images[j].style.filter = 'grayscale(100%)'; // Add a gray filter to the images
        }
      }
    }
  }
}
