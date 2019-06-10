<?php
session_start();
include_once 'inc/functions.php';
 
error_reporting(0);
$token = $_SESSION['token'];
$idxx = $_SESSION['message'];
$usr = $_SESSION['username'];
$logoutToken = generateRandomString();
$_SESSION['logtok'] = $logoutToken;

if (isset($_GET['token']) && isset($token)) {
    if ($_GET['token'] == $token) {
        echo "<script>alert('$idxx')</script>";
    }
} else { }

if ($usr == null) {
    header('Location: signup.php');
}
?>

<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once 'inc/main.php';
?>
