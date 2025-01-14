<?php require_once "db/database.php"; ?>
<?php 
     session_start();
    $Id = $_GET['id'];
    $sql = $pdo->prepare("SELECT * FROM `posts` where id = $Id");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
   if($_POST){
       $comment = $_POST['comment'];
       $author_id = $_SESSION['user_id'];
        $post_id = $_GET['id'];
       $sql = $pdo->prepare("INSERT INTO `comments`(`content`, `author_id` ,`post_id`) VALUES (:comment,:author_id,:post_id)");
       $sql->bindParam(':comment',$comment);
       $sql->bindParam(':author_id',$author_id);
       $sql->bindParam(':post_id',$post_id);
       $sql->execute();
       $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo "<pre>";
        
    
   }

    if($Id){
    //$atuhor_id = $result[0]['author_id'] ;
     $sql = $pdo->prepare("SELECT * FROM `comments` where post_id = $Id");
     $sql->execute();
     $Commentresult = $sql->fetchAll(PDO::FETCH_ASSOC);
     $atuhor_id = $Commentresult[0]['author_id'];   
   
     $sql = $pdo->prepare("SELECT * FROM `user` where id = $atuhor_id");  
     $sql->execute();
     $Userresult = $sql->fetchAll(PDO::FETCH_ASSOC); 

    //die(var_dump($Userresult));

    //echo '<script>window.location="blogdeatil.php?id='.$Id.'";</script>';

    
    //die(var_dump($Userresult));
   }
   
  
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
    <title>Document</title>
</head>
<body>

    <div class="container">
    <div class="card" style="background-color:azure;
    width: 50%; margin: auto; margin-top: 50px;">
        <?php foreach($result as $post): ?>
                <div class="card-header">
                    <h3 class="text-center"><?php echo $post['title'] ?> </h3> 
                </div>
                <div class="card-body">
                    <img src="admin/image/<?php echo $post['image'] ?>" alt="" style="width:100%; height:auto;">
                    <div><?php echo $post['content'] ?></div>
                </div>
                
                <?php endforeach; ?>
              
                 

                <div class="card-footer">

                  
                <div class="comment">
                    <h5>Comments</h5>
                
                    <span>name -><?= $Userresult[0]['name'] ?></span></br>
                    <span><?php echo $Commentresult[0]['content'] ?></span>
                
                 
                    <form action="" method="POST">
                   
                    <input type="text" name="comment" id="comment" class="form-control mt-3" placeholder="Add comment">
                
                    </form>
            </div>
            <a href="index.php" class="btn btn-primary">back</a>
        </div>

    </div>
</body>
</html>