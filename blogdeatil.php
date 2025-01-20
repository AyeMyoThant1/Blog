<?php 
session_start(); ?>

<?php require_once "db/database.php"; ?>
<?php 

    $Id = $_GET['id'];
    $sql = $pdo->prepare("SELECT * FROM `post` where id = $Id");
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
        
    
   }

    if($Id){
    //$atuhor_id = $result[0]['author_id'] ;
     $sql = $pdo->prepare("SELECT * FROM `comments` where post_id = $Id");
     $sql->execute();
     $Commentresult = $sql->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($Commentresult);
    

    $Userresult = [];
        
     if($Commentresult){
        foreach($Commentresult as $key => $value){
        
            $atuhor_id = $Commentresult[$key]['author_id'];
        
            $sql = $pdo->prepare("SELECT * FROM `user` where id = $atuhor_id");  
            $sql->execute();
            $Userresult[]= $sql->fetchAll(PDO::FETCH_ASSOC); 
        }
       

     }
   
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
    <div class="card" style="background-color: azure; max-width: 600px; margin: auto; margin-top: 30px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        
        <?php foreach($result as $post): ?>
            <div class="card-header text-center">
                <h3><?php echo htmlspecialchars($post['title']); ?></h3>
            </div>
            <div class="card-body text-center">
                <img src="admin/image/<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image" style="width:100%; height:auto; border-radius:10px;">
                <div style="margin-top: 10px; font-size: 16px; line-height: 1.5;">
                    <?php echo nl2br(htmlspecialchars($post['context'])); ?>
                </div>
            </div>
        <?php endforeach; ?>
        
        <div class="card-footer">
            <div class="comment">
                <h5>Comments</h5>
                <?php if (!empty($Commentresult)): ?>
                    <?php foreach ($Commentresult as $key => $comment): ?>
                        <div style="margin-bottom: 10px; padding: 10px; border-bottom: 1px solid #ddd;">
                            <strong><?php echo htmlspecialchars($Userresult[$key][0]['name'] ?? 'Anonymous'); ?>:</strong><br>
                            <span><?php echo nl2br(htmlspecialchars($comment['content'])); ?></span>
                        </div>
                    <?php endforeach; ?>
                
                    
                <?php endif; ?>
            </div>
            
            <form action="" method="POST" style="margin-top: 15px;">
                <input type="text" name="comment" id="comment" class="form-control" placeholder="Add a comment" required>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
        
        <a href="index.php" class="btn btn-primary mt-3" style="width: 100%;">Back</a>
    </div>
</div>

</body>
</html>