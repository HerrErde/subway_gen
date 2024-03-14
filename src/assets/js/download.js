function downloadJson() {
  // Get the JSON data from the textarea
  const data = document.querySelector('textarea').value;

  // Create a new blob object containing the JSON data
  const blob = new Blob([data], { type: 'application/json' });

  // Create a URL for the blob object
  const url = URL.createObjectURL(blob);

  // Create a new anchor element with the download attribute
  const a = document.createElement('a');
  a.href = url;

  a.setAttribute('download', filename);

  // Append the anchor element to the document body
  document.body.appendChild(a);

  // Click the anchor element to trigger the download
  a.click();

  // Remove the anchor element from the document body
  document.body.removeChild(a);

  // Release the URL object to free up memory
  URL.revokeObjectURL(url);
}

// Function to download JSON data from a textarea
function download2Json(textareaId, filename) {
  // Get the JSON data from the textarea
  const data = document.getElementById(textareaId).value;

  // Create a new blob object containing the JSON data
  const blob = new Blob([data], { type: 'application/json' });

  // Create a URL for the blob object
  const url = URL.createObjectURL(blob);

  // Create a new anchor element with the download attribute
  const a = document.createElement('a');
  a.href = url;
  a.setAttribute('download', filename);

  // Append the anchor element to the document body
  document.body.appendChild(a);

  // Click the anchor element to trigger the download
  a.click();

  // Remove the anchor element from the document body
  document.body.removeChild(a);

  // Release the URL object to free up memory
  URL.revokeObjectURL(url);
}

// Copy to Clipboard
function copyToClipboard() {
  // Get the textarea element to copy from
  const copyText = document.querySelector('textarea');

  // Select the text in the textarea
  copyText.select();
  copyText.setSelectionRange(0, 99999); // Set selection range to cover the entire text

  // Copy the selected text to clipboard using Clipboard API
  navigator.clipboard
    .writeText(copyText.value)
    .then(() => {
      // Show success alert when text is copied
      alert('Copied to clipboard!');
    })
    .catch((err) => {
      // Log error to console when copying text to clipboard fails
      console.error('Failed to copy to clipboard:', err);
    });
}
