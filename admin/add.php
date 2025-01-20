<?php session_start(); ?>
<?php require_once "../layout/header.php" ?>
<?php require_once "../layout/nav.php" ?>
<?php  require_once "../layout/sidebar.php" ?>
<?php require_once "../db/database.php" ?>
<?php 
$title = $titleErr = "";
$content = $contentErr = "";
$image = $imgErr = "";
$invalid = false ;
//var_dump($_SESSION['user_id']);
if($_POST){
  $image = $_FILES['image']['name'];
  $tempname = $_FILES['image']['tmp_name'];
  var_dump($tempname);
  move_uploaded_file($tempname, "./image/$image");
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sessionid = $_SESSION['user_id'];  

    if($title == ""){
      $titleErr = "title cannot be Blank";
      $invalid = true;
      }
  
      if($content == "") {
          $contentErr = "content cannot be blank";
          $invalid = true;
      }
      if($image == ""){
          $imgErr = "Please choice images";
          $invalid = true;
      }

      if(!$invalid){
        $sql = $pdo->prepare("INSERT INTO `post`(`title`, `context`, `author_id` ,`image`) VALUES (:title,:context,:author_id , :image)");
    $sql->bindParam(':title',$title);
    $sql->bindParam(':context',$content);
    $sql->bindParam(':image',$image);
    $sql->bindParam(':author_id',$sessionid);
    $sql->execute();

    
    
   echo '<script>window.location="index.php";</script>';

      }
    

    
    
    
    
    
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
                        <input type="text" class="form-control" name ="title" placeholder="Title" style ="width:300px; height:50px" >  
                        <p class="err"><?=$titleErr?></p>
                      </div>  
                    <div class="form-group mt-3">
                        <label for="content" class="form-label">content</label>
                        <input type="text" class="form-control" name ="content" placeholder="content" style ="width:300px; height:50px" >  
                        <p class="err"><?=$contentErr?></p>
                      </div>

                    <div class="form-group mt-3">
                        <label for="content" class="form-label">Image</label>
                        <input type="file" class="form-control" name ="image" placeholder="content" style ="width:300px; height:50px" >  
                        <p class="err"><?=$imgErr?></p>
                      </div>

                    <button type="submit" class="btn btn-primary mt-4">submit</button>
                    <a href="index.php" class="btn btn-danger mt-4">Back</a>

        </div>
      </div>
    </div>

  </main>

  <?php require_once "../layout/footer.php" ?>

  