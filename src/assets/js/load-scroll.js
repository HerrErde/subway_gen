// Get all the images with data-src attribute
const images = document.querySelectorAll('img[data-src]');

// Set the options for the Intersection Observer
const options = {
  root: null, // Observe in relation to the viewport
  rootMargin: '0px',
  threshold: 0.01, // Load as soon as 1% of the image is visible
  once: true // Unobserve after the first time intersection occurs
};

// Define the callback function for the Intersection Observer
const callback = (entries, observer) => {
  entries.forEach((entry) => {
    // If the image is intersecting the viewport, load it
    if (entry.isIntersecting) {
      const img = entry.target;
      img.src = img.dataset.src;
      img.removeAttribute('data-src');
      observer.unobserve(img);
    }
  });
};

// Create the Intersection Observer instance
const observer = new IntersectionObserver(callback, options);

// Observe all the images
images.forEach((image) => {
  observer.observe(image);
});
