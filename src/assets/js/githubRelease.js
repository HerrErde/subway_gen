const owner = 'HerrErde';
const repo = 'SubwayBooster';

// Define constants for milliseconds per day, hour, minute, and release cycle
const MILLISECONDS_PER_DAY = 1000 * 60 * 60 * 24;
const MILLISECONDS_PER_HOUR = 1000 * 60 * 60;
const MILLISECONDS_PER_MINUTE = 1000 * 60;
const MILLISECONDS_PER_RELEASE_CYCLE = (21 * 24 + 8) * MILLISECONDS_PER_HOUR;

// Define variables to store the latest release and the time of the last fetch
let latestRelease = null;
let lastFetchTime = 0;

// Define an asynchronous function to fetch the latest release of the specified repository
async function fetchLatestRelease() {
  const response = await fetch(
    `https://api.github.com/repos/${owner}/${repo}/releases/latest`
  );

  if (!response.ok) {
    // if the response is not successful, log an error message and return null
    console.log('Failed to get latest release.');
    return null;
  }

  return response.json(); // return the parsed JSON data of the latest release
}

// Define a function to update the time until the next release
async function updateRelease() {
  if (!latestRelease) {
    // if the latest release has not been fetched yet, fetch it
    latestRelease = await fetchLatestRelease();
  }

  // Calculate the time since the latest release and the time until the next release based on the release cycle
  const releaseDate = new Date(latestRelease.published_at.substring(0, 10));
  const timeSinceRelease = Date.now() - releaseDate;
  const timeUntilNextRelease =
    MILLISECONDS_PER_RELEASE_CYCLE -
    (timeSinceRelease % MILLISECONDS_PER_RELEASE_CYCLE);

  // Format the time as days, hours, and minutes
  const daysUntilNextRelease = Math.floor(
    timeUntilNextRelease / MILLISECONDS_PER_DAY
  );
  const hoursUntilNextRelease = Math.floor(
    (timeUntilNextRelease % MILLISECONDS_PER_DAY) / MILLISECONDS_PER_HOUR
  );
  const minutesUntilNextRelease = Math.floor(
    (timeUntilNextRelease % MILLISECONDS_PER_HOUR) / MILLISECONDS_PER_MINUTE
  );

  // Update the text content of an HTML element with id "release"
  const releaseElement = document.getElementById('release');
  releaseElement.textContent = `~${daysUntilNextRelease}d ${hoursUntilNextRelease}h ${minutesUntilNextRelease}m`;

  // Set the title attribute to the release date
  const nextReleaseDate = new Date(Date.now() + timeUntilNextRelease);
  releaseElement.setAttribute('title', nextReleaseDate);
}

// Call the updateRelease function to initialize the time until the next release when the page loads
updateRelease();

// Add event listener for hover to set title attribute to the release date
const dataContainer = document.getElementById('dataContainer');
dataContainer.addEventListener('mouseover', function () {
  const releaseDate = new Date(dataContainer.getAttribute('title'));
  dataContainer.setAttribute('title', releaseDate.toDateString());
});
