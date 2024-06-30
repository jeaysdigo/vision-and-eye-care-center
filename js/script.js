document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("logo-sidebar");
    const bottombar = document.getElementById("bottombar");
  
    // Function to toggle bottombar visibility based on viewport width
    function toggleBottombar() {
      if (window.matchMedia("(max-width: 640px)").matches) {
        bottombar.classList.add("show");
      } else {
        bottombar.classList.remove("show");
      }
    }
  
    // Listen for changes in sidebar's class attribute
    const observer = new MutationObserver(toggleBottombar);
    observer.observe(sidebar, { attributes: true, attributeFilter: ['class'] });
  
    // Listen for changes in viewport width
    const resizeObserver = new ResizeObserver(toggleBottombar);
    resizeObserver.observe(document.body);
  
    // Initial check
    toggleBottombar();
  });