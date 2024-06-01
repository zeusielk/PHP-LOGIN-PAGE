<?php

$success = 0;
$user = 0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include ('connection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = $conn->prepare("SELECT * FROM admintable WHERE username = ?");
    $sql->bind_param("s", $username);
    if($sql->execute()){
        $result = $sql->get_result();
        $num = mysqli_num_rows($result);
        if($num>0){
            // echo "user already exist";
            $user = 1;
        }else{
            $stmt = $conn->prepare("INSERT INTO admintable (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
        
            if($stmt->execute()){
                // echo "Signup success!!!";
                $success = 1;
            }else{
                echo "connection error!!!";
            }

        }
    }  
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body >

  <?php
  if($user){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Holy Shit!</strong> User already exists!
    
  </div>';
  }
  if($success){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Hooray!</strong> Signup success!
    
  </div>';
  }
  ?>
    <div class="container full-height">

    <h1 class="text-center">SignUp to Website</h1>
      
    <form class="mt-5" action="signup.php" method="post">
  <div class="form-group ">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" name="username">
    
  </div>
  <div class="form-group mb-300">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
  </div>

  
  <button type="submit" class="btn btn-primary w-100 ">SignUp</button>
  
  <p><a href="index.php" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Already have account ? Login here</a></p>
</form>
    </div>
    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>