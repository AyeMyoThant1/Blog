<?php require_once "../db/database.php"; ?>

<?php
if($_GET['id']){
    $id = $_GET['id'];
    $sql = $pdo->prepare("DELETE FROM `user` WHERE `id` = $id");
    $sql->execute();
    echo '<script>window.location="user_list.php";</script>';

}
  ?>


?>