document.addEventListener("DOMContentLoaded", () => {
  const images = document.querySelectorAll("img[data-src]");
  const fallbackImg =
    "//wsrv.nl/?url=static.wikia.nocookie.net/subwaysurf/images/d/da/MissingSurfer1.png&w=300&h=300";

  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          const imgUrl = img.dataset.src;

          if (imgUrl) {
            img.src = imgUrl;
            img.removeAttribute("data-src");
          }

          img.onerror = () => {
            img.onerror = null;
            img.src = fallbackImg;
          };

          observer.unobserve(img);
        }
      });
    },
    {
      root: null,
      rootMargin: "0px",
      threshold: 0.1,
      once: true
    }
  );

  images.forEach((img) => observer.observe(img));
});
