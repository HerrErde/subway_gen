function downloadJsonFromTextarea(textareaSelector, filename) {
  const data = document.querySelector(textareaSelector).value;
  downloadJsonData(data, filename);
}

function downloadJsonData(data, filename) {
  const blob = new Blob([data], { type: 'application/json' });

  // Create a URL for the blob object
  const url = URL.createObjectURL(blob);
  downloadFromUrl(url, filename);
}

function downloadFromUrl(url, filename) {
  const a = document.createElement('a');
  a.href = url;
  a.download = filename;

  // Append the anchor element to the document body
  document.body.appendChild(a);

  // Trigger the download after a short delay to ensure the URL is fully created
  setTimeout(() => {
    // Click the anchor element to trigger the download
    a.click();

    // Remove the anchor element from the document body
    document.body.removeChild(a);

    // Release the URL object to free up memory
    URL.revokeObjectURL(url);
  }, 100);
}

// Copy to Clipboard
function copyToClipboard(textareaSelector) {
  const copyText = document.querySelector(textareaSelector);
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
