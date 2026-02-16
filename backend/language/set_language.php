<?php
// Start the session
session_start();

if (isset($_POST['language'])) {
    $lang = $_POST['language'];
    
    // Set the cookie:
    // Name: 'user_lang' (Must match the name checked in the main page)
    // Value: $lang (e.g., 'es', 'en', 'fr')
    // Expiration: time() + (86400 * 30) = 30 days (86400 seconds in a day)
    // Path: '/' makes the cookie available across the entire website.
    setcookie('user_lang', $lang, time() + (86400 * 30), '/'); 
    
    // Store in session
    $_SESSION['user_lang'] = $lang;
}
// Redirect back to the page the user came from
$referrer = $_SERVER['HTTP_REFERER'] ?? '/';
header("Location: " . $referrer);
exit;
?>