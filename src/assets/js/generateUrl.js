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
        compressed.push(start.toString());
      } else if (start === end - 1) {
        compressed.push(start.toString());
        compressed.push(end.toString());
      } else {
        compressed.push(`${start}-${end}`);
      }
      start = end = num;
    }
  }

  // Append the last range or single number
  if (start === end) {
    compressed.push(start.toString());
  } else if (start === end - 1) {
    compressed.push(start.toString());
    compressed.push(end.toString());
  } else {
    compressed.push(`${start}-${end}`);
  }

  return compressed;
}

// JavaScript function to generate URL with selected IDs and default selection
function generateUrl(url) {
  const checkboxes = document.querySelectorAll('.select-checkbox:checked');
  const defaultCheckbox = document.querySelector(
    '.default-select-checkbox:checked'
  );

  const ids = [];
  checkboxes.forEach(function (checkbox) {
    ids.push(parseInt(checkbox.value)); // Parse value as integer
  });

  const defaultId = defaultCheckbox ? parseInt(defaultCheckbox.value) : 1;

  // Compress the IDs for URL
  const compressedIds = compress(ids);

  // Include selected default ID and compressed IDs in URL
  const generatedUrl =
    url + defaultId + '&items=' + JSON.stringify(compressedIds);
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
