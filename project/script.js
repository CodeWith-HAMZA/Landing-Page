console.log("first");

const toggleButton = document.getElementById("togBtn"); // button
const navLinks = document.getElementById("navLinks"); // ul

toggleButton.onclick = (e) => {
  const isExisted = [...navLinks.classList].includes(
    "makeResponsiveNavigation"
  );
  if (isExisted) {
    navLinks.classList.remove("makeResponsiveNavigation");
    navLinks.classList.add("hidden");
  } else {
    navLinks.classList.add("makeResponsiveNavigation");
    navLinks.classList.remove("hidden");
  }
};
