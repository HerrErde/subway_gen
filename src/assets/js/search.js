function filterItems() {
  const input = document.getElementById("searchInput").value;
  const items = document.getElementsByClassName("item");

  for (let i = 0; i < items.length; i++) {
    const item = items[i];
    const label = item.querySelector("label.custom-checkbox");
    const nameNode = label.childNodes[label.childNodes.length - 1];
    const originalName = nameNode.textContent.trim();

    // reset highlight
    nameNode.textContent = originalName;

    if (input.trim() === "") {
      item.style.display = "";
      item.style.filter = "";
      item.classList.remove("filtered");
      const imgs = item.getElementsByTagName("img");
      for (const img of imgs) img.style.filter = "";
      continue;
    }

    const regex = new RegExp(`(${input})`, "gi");
    if (regex.test(originalName)) {
      item.style.display = "";
      item.style.filter = "";
      item.classList.remove("filtered");

      const temp = document.createElement("span");
      temp.innerHTML = originalName.replace(regex, "<mark>$1</mark>");
      nameNode.replaceWith(temp);

      const imgs = item.getElementsByTagName("img");
      for (const img of imgs) img.style.filter = "";
    } else {
      item.style.display = "none";
      item.classList.add("filtered");
      item.style.filter = "grayscale(100%)";
      const imgs = item.getElementsByTagName("img");
      for (const img of imgs) img.style.filter = "grayscale(100%)";
    }
  }
}
