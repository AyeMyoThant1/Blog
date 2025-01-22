<?php
session_start();

function generateCsrfToken() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['_token']) || !hash_equals($_SESSION['_token'], $_POST['_token'])) {
            die("CSRF validation failed.");
        }else {
    
            unset($_SESSION['_token']);
        }
        
    }



    if (empty($_SESSION['_token'])) {
        $_SESSION['_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['_token'];
}

$csrfToken = generateCsrfToken();




function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>
