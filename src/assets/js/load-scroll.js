// Get all the images
const images = document.querySelectorAll('img[data-src]');

// Set the options for the Intersection Observer
const options = {
  rootMargin: '0px',
  threshold: 0.1,
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
