<?php
// Redirect to a specific page
function redirect($page) {
    header("Location: $page");
    exit;
}

// Format currency
function format_currency($amount) {
    return '$' . number_format($amount, 2);
}

// Check if the user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Get the current user's ID
function get_current_user_id() {
    return $_SESSION['user_id'] ?? null;
}

// Generate a random string (useful for tokens, etc.)
function generate_random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $random_string;
}
?>