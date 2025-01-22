
<?php require_once "../layout/header.php" ?>
<?php require_once "../layout/nav.php" ?>
<?php require_once "../db/database.php"; ?>
<?php require_once "../layout/sidebar.php" ?>
<?php require_once "../db/token.php"; ?>


<?php
if(!isset($_SESSION['user_id'])){
    header("Location: ./login.php");

}
  ?>
<main id="main" class="main">   
    <div class="container">
    <div class="card mx-auto" >
       
        <div class="card-header">
        <a href="adduser.php" class="btn btn-success mb-3">Add User</a>
        <h3>Add User</h3>
        </div>
        <div class="card-body">
        <table class="table-bordered table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
              if(isset($_POST['search'])){
                $search = $_POST['search'];
                $sql = $pdo->prepare("SELECT * FROM user WHERE `name` LIKE '%$search%' OR `email` LIKE '%$search%'");
                 $sql->execute();
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
              } else{
                $sql = $pdo->prepare("SELECT * FROM `user`");
                $sql->execute();
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
                $i = 1;
                foreach($result as $user):
                ?>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo escape($user['name']) ?></td>
                    <td><?php echo escape($user['email']) ?></td>
                    <td><?php  if($user['role'] == 1){
                        echo "Admin";
                    }else{
                        echo "User";
                    } ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_user.php?id=<?php echo $user['id'] ?>" class="btn btn-danger"
                        onclick="return confirm('Are you sure to Delete   ?')">Delete</a>
                    </td>
                </tr>

                <?php  $i++; endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
    

<?php require_once "../layout/footer.php" ?>