// JavaScript function to compress numbers for URL
function compress(numbers) {
  if (!numbers || numbers.length === 0) {
    return [];
  }

  const compressed = [];
  let start = (end = numbers[0]);

  for (let i = 1; i < numbers.length; i++) {
    const num = numbers[i];
    if (num === end + 1) {
      end += 1;
    } else {
      if (start === end) {
        compressed.push(start);
      } else {
        compressed.push([start, end]);
      }
      start = end = num;
    }
  }

  // Append the last range or single number
  if (start === end) {
    compressed.push(start);
  } else {
    compressed.push([start, end]);
  }

  return compressed;
}

// JavaScript function to generate URL with selected IDs and default selection
function generateUrl(url) {
  const checkboxes = document.querySelectorAll('.select-checkbox:checked');
  const defaultCheckbox = document.querySelector(
    '.default-select-checkbox:checked'
  );

  if (!checkboxes || checkboxes.length === 0) {
    // Handle the case where no checkboxes are checked
    console.error('No checkboxes are checked.');
    alert('You did not select any checkboxes.');
    return;
  }

  const ids = [];
  checkboxes.forEach(function (checkbox) {
    ids.push(parseInt(checkbox.value)); // Parse value as integer
  });

  const defaultId = defaultCheckbox ? parseInt(defaultCheckbox.value) : 1;

  // Compress the IDs for URL
  const compressedIds = compress(ids);

  // Construct the items part of the URL
  let itemsStr = '[';
  for (let i = 0; i < compressedIds.length; i++) {
    if (Array.isArray(compressedIds[i])) {
      // Range format [start, end]
      itemsStr += `${compressedIds[i][0]}-${compressedIds[i][1]}`;
    } else {
      // Single number
      itemsStr += compressedIds[i];
    }
    if (i < compressedIds.length - 1) {
      itemsStr += ',';
    }
  }
  itemsStr += ']';

  // Construct the final URL
  const generatedUrl = `${url}?select=${defaultId}&items=${itemsStr}`;
  window.location.href = generatedUrl;
}

// JavaScript function to retrieve URL from the script tag and call generateUrl() function
function generateUrlFunction() {
  // Retrieve the URL from the script tag
  var scriptTag = document.querySelector('script[src$="generateUrl.js"]');
  var url = scriptTag.getAttribute('url');

  // Call the generateUrl() function with the retrieved URL
  generateUrl(url);
}
