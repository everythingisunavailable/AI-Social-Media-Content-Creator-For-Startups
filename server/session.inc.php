<?php
// Start session if it's not already started
function startSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Set a session value
function setSession($key, $value) {
    startSession();
    $_SESSION[$key] = $value;
}

// Get a session value
function getSession($key) {
    startSession();
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}

// Destroy entire session
function destroySession() {
    startSession();
    session_unset();  // Remove all session variables
    session_destroy(); // Destroy the session itself
}

// Destroy a specific session key
function unsetSession($key) {
    startSession();
    if (isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}
?>
