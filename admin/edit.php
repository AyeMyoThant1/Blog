
<?php require_once "../layout/header.php" ?>
<?php  require_once "../layout/nav.php" ?>
<?php  require_once "../layout/sidebar.php" ?>
<?php require_once "../db/database.php" ?>
<?php require_once "../db/token.php" ?>

<?php 
 if ($_GET['id']) {
    if($_POST){
        $id = $_GET['id'];
        $title = $_POST['title'];
          $content = $_POST['content'];
         
         
         $sql = $pdo->prepare("UPDATE `post` SET `title` = :title, `context` = :content WHERE `id` = $id");
         $sql->bindParam(':title',$title);
         $sql->bindParam(':content',$content);
         $sql->execute();
         echo '<script>window.location="index.php";</script>';
         

 }
 $ID = $_GET['id'];
    
 $sql = $pdo->prepare("SELECT * FROM `post` WHERE `id` = $ID");
 $sql->execute();
 $result = $sql->fetch(PDO::FETCH_ASSOC);
 
        
    }else {
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
           <form action="" method="POST">
           <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
              <input type="hidden" name="id" value="<?php echo $result['id']?>">
                    <div class="form-group mt-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name ="title" value="<?php echo escape($result['title'])?>"   placeholder="Title" style ="width:300px; height:50px" required>  
                    </div>  
                    <div class="form-group mt-3">
                        <label for="content" class="form-label">content</label>
                        <input type="text" class="form-control" name ="content" value="<?php echo escape($result['context'])?>"  placeholder="content" style ="width:300px; height:50px" required>  
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">submit</button>
                    <a href="index.php" class="btn btn-danger mt-4">Back</a>

        </div>
      </div>
    </div>

  </main>

  <?php require_once "../layout/footer.php" ?>

  