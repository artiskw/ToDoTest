const checkboxes = document.querySelectorAll('input[type="checkbox"]');

checkboxes.forEach((checkbox) => {
  checkbox.addEventListener("change", function () {
    const listItem = this.closest(".list");
    const h3 = listItem.querySelector("h3");
    const listBottom = listItem.querySelector(".list-bottom");
    const upgradeLink = listItem.querySelector(".upgrade-to-do");

    if (this.checked) {
      h3.style.textDecoration = "line-through";
      h3.style.marginBottom = "20px";
      listBottom.classList.add("hidden");
      upgradeLink.style.display = "none"; // Pievienojiet šo rindiņu, lai paslēptu "upgrade-to-do" pogu
    } else {
      h3.style.textDecoration = "none";
      h3.style.marginBottom = "";
      listBottom.classList.remove("hidden");
      upgradeLink.style.display = "inline-block"; // Pievienojiet šo rindiņu, lai parādītu "upgrade-to-do" pogu
    }

    const checkboxId = checkbox.getAttribute("id");
    const checkboxState = checkbox.checked;
    localStorage.setItem(checkboxId, checkboxState);
  });

  const checkboxId = checkbox.getAttribute("id");
  const savedCheckboxState = localStorage.getItem(checkboxId);

  if (savedCheckboxState === "true") {
    checkbox.checked = true;
    checkbox.dispatchEvent(new Event("change"));
  }
});

var today = new Date().toISOString().split("T")[0];
document.getElementsByName("todoDate")[0].setAttribute("min", today);
