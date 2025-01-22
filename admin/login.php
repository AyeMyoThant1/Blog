<?php 
session_start();


require_once "../db/database.php";
 if(isset($_POST['submit'])){
     $email = $_POST['email'];
     $pwd = $_POST['pwd'];
    
     $sql =$pdo->prepare("SELECT * FROM `user` WHERE `email` = :email");
     $sql->bindValue(':email' , $email);
     $sql->execute();
     $result = $sql->fetch(PDO::FETCH_ASSOC);
    
        if($result){
            if(password_verify($pwd, $result['password'])){
         setcookie("user", json_encode($result), time() + (86400 * 30), "/");
                $_SESSION['user_id'] = $result['id'];

               header('location:../admin/index.php');
        }
        
 }
 echo "<script>alert('Invalid email or password')</script>";
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
    <div class="container-fluid">
        <div class="card mx-auto p-3 mt-5" style ="width:40%; height:auto; background-color:azure;">
            <h3 class ="text-center">Login</h3>
            <div class="card-body mx-auto">
                <form action="" method="POST">
                    <div class="form-group mt-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name ="email" placeholder="email" style ="width:300px; height:50px">
                    </div>
                    <div class="from-group mt-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                        <input class="form-control" name ="pwd" placeholder="password" style ="width:300px; height:50px">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mt-4">submit</button>

                </form>
            </div>
        </div>
    </div>

</body>

</html>