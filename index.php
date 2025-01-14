<?php 
session_start();
require_once "db/database.php";

if(!isset($_SESSION['user'])){
    echo "<script>alert('Please login first'); window.location.href = 'login.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
<div class="container">
<?php 
    $sql = $pdo->prepare("SELECT * FROM `posts`");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    
   
    ?>
    
    <div class="row mt-4">

   

    <?php foreach($result as $post): ?>
        <div class="col-4 mt-2">
            <div class="card" style="background-color:azure;">
                <div class="card-header">
                    <h3 class="text-center"><?php echo $post['title'] ?> </h3> 
                </div>
                <div class="card-body">
                    <a href="blogdeatil.php?id=<?php echo $post['id'] ?>"><img src="admin/image/<?php echo $post['image'] ?>" alt="" style="width:100%; height:200px"></a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
  
    </div>
    <a href="logout.php" type="submit" class="btn btn-primary mt-2">Logout</a>
</div>

</body>
</html>