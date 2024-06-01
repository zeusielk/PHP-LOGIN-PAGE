<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('connection.php');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password FROM admintable WHERE username = ?");
    $stmt->bind_param("s", $username);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $row['id'];
                header("Location: home.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Invalid username.";
        }
    } else {
        echo "Error executing query.";
    }
    $stmt->close();
    $conn->close();
}
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body >


  
    <div class="container full-height">
        <h1 class="text-center p-30">Login to your account</h1>
    <form class="mt-5" action="index.php" method="post">
  <div class="form-group ">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" name="username">
    
  </div>
  <div class="form-group mb-300">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
  </div>
  
  <button type="submit" class="btn btn-primary w-100 ">Log in</button>
  
  <p><a href="signup.php" class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">No account! Signup here</a></p>

</form>
    </div>
    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>