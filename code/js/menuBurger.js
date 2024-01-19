function showResponsiveMenu() {
  // Get references to the menu, hamburger icon, and the root element
  var menu = document.getElementById("topnav_responsive_menu");
  var icon = document.getElementById("topnav_hamburger_icon");
  var root = document.getElementById("root");

  // Check if the menu is currently closed (empty className)
  if (menu.className === "") {
    // If closed, open the menu by adding the "open" class
    menu.className = "open";
    icon.className = "open";
    // Disable vertical scrolling on the root element
    root.style.overflowY = "hidden";
  } else {
    // If open, close the menu by removing the "open" class
    menu.className = "";
    icon.className = "";
    // Enable vertical scrolling on the root element
    root.style.overflowY = "";
  }
}
