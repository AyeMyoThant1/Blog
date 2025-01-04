<?php session_start(); ?>
<?php require_once "../layout/header.php" ?>
<?php  require_once "../layout/nav.php" ?>
<?php  require_once "../layout/sidebar.php" ?>
<?php require_once "../db/database.php" ?>

<?php 

if($_POST){
  $file = 'images/'.($_FILES['image']['name']);
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],$file);

    
    
    $sql = $pdo->prepare("INSERT INTO `posts`(`title`, `content`, `author_id` ,`image`) VALUES (:title,:content,:author_id , :image)");
    $sql->bindParam(':title',$title);
    $sql->bindParam(':content',$content);
    $sql->bindParam(':image',$image);
    $sql->bindParam(':author_id',$_SESSION['user_id']);
    $sql->execute();

    
    
    echo '<script>window.location="index.php";</script>';
    
    
}

?>

  <main id="main" class="main">
    <div class="container">
      <div class="card mx-auto" style ="width:40%; height:auto; background-color:azure;">
        <div class="card-header">
        <h3>create new</h3>
        </div>
        <div class="card-body">
           <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group mt-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name ="title" placeholder="Title" style ="width:300px; height:50px" required>  
                    </div>  
                    <div class="form-group mt-3">
                        <label for="content" class="form-label">content</label>
                        <input type="text" class="form-control" name ="content" placeholder="content" style ="width:300px; height:50px" required>  
                    </div>

                    <div class="form-group mt-3">
                        <label for="content" class="form-label">Image</label>
                        <input type="file" class="form-control" name ="image" placeholder="content" style ="width:300px; height:50px" required>  
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">submit</button>
                    <a href="index.php" class="btn btn-danger mt-4">Back</a>

        </div>
      </div>
    </div>

  </main>

  <?php require_once "../layout/footer.php" ?>

  