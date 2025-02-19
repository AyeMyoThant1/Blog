<?php 

require_once "db/database.php";
require_once "db/token.php";
$name = $nameErr ="";
$email = $emailErr = "";
$pwd = $pwdErr ="";
$invalid = false;

if($_POST){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

    $sql = $pdo->prepare("SELECT * FROM `user` WHERE `email` = :email");
    $sql->bindValue(':email' , $email);
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);
    if($name == ""){
        $nameErr = "Name cannot be Blank";
        $invalid = true;
        }
    
        if($email == "") {
            $emailErr = "Email cannot be blank";
            $invalid = true;
        }
    
        if($pwd == ""){
            $pwdErr = "Password cannot be blank";
            $invalid = true;
        }

        if(!$invalid){
            if($user){
                echo "<script>alert('Email already exists')</script>";  
            }
            else{
                $sql = $pdo->prepare("INSERT INTO `user`(`name`, `email`, `password`) VALUES (:name,:email,:password)");
                $sql->bindParam(':name',$name);
                $sql->bindParam(':email',$email);
                $sql->bindParam(':password',$pwd);
                $sql->execute();

                echo "<script>alert('Register success'); window.location='login.php';</script>";
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
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="card mx-auto p-3 mt-5" style ="width:40%; height:auto; background-color:azure;">
            <h3 class ="text-center">Register</h3>
            <div class="card-body mx-auto">
                <form action="" method="POST">
                <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                    <div class="form-group mt-3">
                        <label for="exampleFormControlInput1" class="form-label">Name</label>
                        <input type="text" class="form-control" name ="name" placeholder="name" style ="width:300px; height:50px">
                        <p class="err"> <?=$nameErr?></p>
                    </div>
                    <div class="from-group mt-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                        <input class="form-control" name ="email" placeholder="email" style ="width:300px; height:50px">
                        <p class="err"> <?=$emailErr?></p>
                    </div>
                    <div class="from-group mt-3">
                        <label for="exampleFormControlTextarea1" class="form-label">password</label>
                        <input class="form-control" name ="pwd" placeholder="password" style ="width:300px; height:50px">
                        <p class="err"><?=$pwdErr?></p>
                    </div>


                    <button type="submit" class="btn btn-primary mt-4">register</button>
                    <a href="login.php" class="btn btn-success mt-4">login</a>

                </form>
            </div>
        </div>
    </div>

</body>

</html>