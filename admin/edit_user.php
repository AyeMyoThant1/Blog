<?php require_once "../layout/header.php" ?>
<?php //require_once "../layout/nav.php"; ?>
<?php require_once "../db/database.php"; ?>
<?php //require_once "../layout/sidebar.php" ?>   
<?php
if($_GET['id']){

    $id = $_GET['id'];
    $sql = $pdo->prepare("SELECT * FROM `user` WHERE `id` = $id");
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
}
    
    if($_POST){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        if(empty($role)){
            $role = 0;
        }else{
            $role = 1;
        }
        $sql = $pdo->prepare("UPDATE `user` SET `name` = :name, `email` = :email, `role` = :role WHERE `id` = $id");
        $sql->bindParam(':name',$name);
        $sql->bindParam(':email',$email);
        $sql->bindParam(':role',$role);
        $sql->execute();
        echo '<script>window.location="user_list.php";</script>';
    }   

?>





<main id="main" class="main">
    <div class="container">
        <div class="card mx-auto" style ="width:40%; height:auto; background-color:azure;">
           
            <div class="card-header">
            <h3>Add User</h3>
            </div>
            <div class="card-body">
            <form action="" method="POST">
                    <div class="form-group mt-4">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="<?= $result['name'] ?> " placeholder="Name" style="width:300px; height:50px" required>
                    </div>
                    <div class="form-group mt-4">
                        <label for="name">Email</label>
                        <input type="text" class="form-control" name="email" value="<?= $result['email'] ?> " placeholder="Name" style="width:300px; height:50px" required>
                    </div>
                    <div class="form-group mt-4">
                        <label for="name">Admin</label>
                        <input type ="checkbox" name="role" value="<?= $result['role'] ?> ">
                    </div>
        
                    <button type="submit" class="btn btn-primary mt-4">submit</button>
                    <a href="user_list.php" class="btn btn-danger mt-4">Back</a>
             </form>


            </div>
    
<?php require_once "../layout/footer.php" ?>