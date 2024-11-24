// Function to set active tab
function setActiveTab(tab) {
  // Update active tab styling
  const navLinks = document.querySelectorAll("nav ul li");
  navLinks.forEach((link) => {
    link.classList.remove("active");
    if (link.dataset.tab === tab) {
      link.classList.add("active");
    }
  });

  // Save the active tab to localStorage
  localStorage.setItem("activeTab", tab);
}

// Initialize active tab on page load
function initializeActiveTab() {
  const savedTab = localStorage.getItem("activeTab") || "dashboard"; // Default to 'dashboard'
  setActiveTab(savedTab);
}

// Handle navigation link clicks for tab switching
const navLinks = document.querySelectorAll("nav ul li");
navLinks.forEach((link) => {
  link.addEventListener("click", (event) => {
    event.preventDefault(); // Prevent default link behavior
    const currentTab = event.target.closest("li").dataset.tab;
    setActiveTab(currentTab);
    window.location.href = event.target.closest("a").href; // Navigate to the link's URL
  });
});

// Run the initialize function on page load
document.addEventListener("DOMContentLoaded", initializeActiveTab);
