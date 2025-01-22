<?php 
require_once "db/database.php";
require_once "db/token.php";
$_SESSION['role'] = 0;
$email = $emailErr = "";
$pwd = $pwdErr = "";
$invalid = false ;

if($_POST){
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    
    if($email == ""){
        $emailErr = "Email cannot be blank";
        $invalid = true;
    }
    
    if($pwd == ""){
        $pwdErr= "password cannot be blank";
        $invalid = true;
    }
  
    if(!$invalid){
        $sql =$pdo->prepare("SELECT * FROM `user` WHERE `email` = :email ");
        $sql->bindValue(':email' , $email);
       // $sql->bindValue(':password' , $pwd);
        $sql->execute();   
        $result = $sql->fetch(PDO::FETCH_ASSOC);
       // die(var_dump($result));

        if($result){
            if(password_verify($pwd, $result['password']) && $result['email'] == $email){
    
                $_SESSION['user'] = $result['email'];
                $_SESSION['user_id'] = $result['id'];
    
                echo "<script>alert('Login successful'); window.location.href = 'index.php';</script>";
               
            }
        
    }
    echo "<script>alert('Invalid email or password'); window.location.href = 'login.php';</script>";
    
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card mx-auto p-3 mt-5" style ="width:40%; height:auto; background-color:azure;">
            <h3 class ="text-center">Login</h3>
            <div class="card-body mx-auto">
                <form action="" method="POST">
                <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                    <div class="form-group mt-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name ="email" placeholder="email" style ="width:300px; height:50px">
                        <p class="err"><?=$emailErr?></p>
                    </div>
                    <div class="from-group mt-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                        <input class="form-control" name ="pwd" placeholder="password" style ="width:300px; height:50px"> 
                        <p class="err"><?=$pwdErr?></p>
                    </div>
                    
                    <div class="d-grid gap-2 mt-4">
                        <button class="btn btn-primary" type="submit">sing in</button>
                        <a href="register.php"class="btn btn-success">register</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

</body>

</html>