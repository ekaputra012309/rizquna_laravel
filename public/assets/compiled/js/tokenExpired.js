function checkTokenExpiration() {
    // Get the stored token and expiration time
    const token = localStorage.getItem("jwtToken");
    const expirationTime = localStorage.getItem("tokenExpiration");

    // If token and expiration time are present
    if (token && expirationTime) {
        // Parse expiration time as a Date object
        const expirationDate = new Date(expirationTime);

        // If the current time is past the expiration time
        if (new Date() > expirationDate) {
            // Perform logout action
            logoutUser();
        }
    }
}

// Function to logout the user
function logoutUser() {
    // Clear token and expiration time from storage
    localStorage.removeItem("jwtToken");
    localStorage.removeItem("tokenExpiration");

    // Redirect the user to the login page or perform any other logout actions
    window.location.href = "/login"; // Example: Redirect to login page
}

// Check token expiration every 5 minutes
setInterval(checkTokenExpiration, 5 * 60 * 1000); // 5 minutes in milliseconds
