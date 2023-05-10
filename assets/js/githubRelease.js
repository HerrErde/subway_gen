const owner = 'HerrErde';
const repo = 'SubwayBooster';

const MILLISECONDS_PER_DAY = 1000 * 60 * 60 * 24;
const MILLISECONDS_PER_HOUR = 1000 * 60 * 60;
const MILLISECONDS_PER_MINUTE = 1000 * 60;
const MILLISECONDS_PER_RELEASE_CYCLE = (21 * 24 + 10) * MILLISECONDS_PER_HOUR;

let latestRelease = null;
let lastFetchTime = 0;

async function fetchLatestRelease() {
  const response = await fetch(`https://api.github.com/repos/${owner}/${repo}/releases/latest`);

  if (!response.ok) {
    console.log('Failed to get latest release.');
    return null;
  }

  return response.json();
}

async function updateRelease() {
  const now = Date.now();
  const timeSinceLastFetch = now - lastFetchTime;

  if (!latestRelease || timeSinceLastFetch > MILLISECONDS_PER_HOUR) {
    latestRelease = await fetchLatestRelease();
    lastFetchTime = now;
  }

  if (!latestRelease) {
    return;
  }

  const releaseDate = new Date(latestRelease.published_at);
  const timeSinceRelease = now - releaseDate;

  const timeUntilNextRelease = MILLISECONDS_PER_RELEASE_CYCLE - timeSinceRelease % MILLISECONDS_PER_RELEASE_CYCLE;

  const daysUntilNextRelease = Math.floor(timeUntilNextRelease / MILLISECONDS_PER_DAY);
  const hoursUntilNextRelease = Math.floor((timeUntilNextRelease % MILLISECONDS_PER_DAY) / MILLISECONDS_PER_HOUR);
  const minutesUntilNextRelease = Math.floor((timeUntilNextRelease % MILLISECONDS_PER_HOUR) / MILLISECONDS_PER_MINUTE);

  const releaseElement = document.getElementById('release');
  releaseElement.textContent = `~${daysUntilNextRelease}d ${hoursUntilNextRelease}h ${minutesUntilNextRelease}m`;
}

updateRelease();
