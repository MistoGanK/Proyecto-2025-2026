<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
// Check if session exists
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
  // Check if header is already sent
  if (headers_sent()) {
    echo "<script>window.location.href='/student022/backend/admin_panel.php';</script>";
  } else {
    header('Location: /student022/backend/admin_panel.php');
  }
  exit();
}
