<?php
require_once "../db/database.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = $pdo->prepare("DELETE FROM `post` WHERE `id` =".$_GET['id']);
    $sql->execute();
    echo '<script>window.location="index.php";</script>';
}else {
    echo '<script>window.location="index.php";</script>';
}
?>