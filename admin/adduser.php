<?php require_once "../layout/header.php" ?>
<?php require_once "../layout/nav.php"; ?>
<?php require_once "../db/database.php"; ?>
<?php require_once "../layout/sidebar.php" ?>   
<?php
if($_POST){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    if(empty($role)){
        $role = 0;
    }else{
        $role = 1;
    }
    $sql = $pdo->prepare("INSERT INTO `user`(`name`, `email`,`password`, `role`) VALUES (:name,:email,:password,:role)");
    $sql->bindParam(':name',$name);
    $sql->bindParam(':email',$email);
    $sql->bindParam(':password',$password);
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
                        <input type="text" class="form-control" name="name" placeholder="Name" style="width:300px; height:50px" required>
                    </div>
                    <div class="form-group mt-4">
                        <label for="name">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="Name" style="width:300px; height:50px" required>
                    </div>
                    <div class="form-group mt-4">
                        <label for="name">Password</label>
                        <input type="text" class="form-control" name="password" placeholder="Name" style="width:300px; height:50px" required>
                    </div>
                    <div class="form-group mt-4">
                        <label for="name">Admin</label>
                        <input type ="checkbox" name="role" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Add User</button>
                    <a href="user_list.php" class="btn btn-danger mt-4">Back</a>
             </form>


            </div>
    
<?php require_once "../layout/footer.php" ?>