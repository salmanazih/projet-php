// Select the search icon and search input div
const searchIcon = document.getElementById('searchicon2');
const searchInput = document.getElementById('searchinput2');

// Add a click event listener to the search icon
searchIcon.addEventListener('click', (event) => {
    // Prevent default link behavior
    event.preventDefault();
    
    // Toggle visibility by adjusting the display style
    if (searchInput.style.display === 'none' || searchInput.style.display === '') {
        searchInput.style.display = 'flex'; // Show the search input
    } else {
        searchInput.style.display = 'none'; // Hide the search input
    }
});

// Set initial display to 'none' to hide the search input on page load
searchInput.style.display = 'flex';
