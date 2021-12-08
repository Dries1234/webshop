<?php
    session_start();
    include_once("imports/database.php");
    $registered = true;
    if(isset($_POST["submit"])){
        $datab = new Database();
        try{
            $datab->connect();

            $email = htmlspecialchars($_POST["email"]);
            $pass = htmlspecialchars($_POST["password"]);

            $datab->prepare("SELECT * FROM users WHERE email=?");
            $datab->bind_param("s", [$email]);
            $datab->execute();
            $result = $datab->get_result();

           
            if($result){
                $registered = true;
                $entry = mysqli_fetch_assoc($result);
                $hashed_pw = $entry["hashedPW"];
                if(password_verify($pass, $hashed_pw)){
                    $_SESSION["name"] = $entry["firstName"];
                    $_SESSION["email"] = $entry["email"];
                    $_SESSION["admin"] = $entry["admin"];

                    header("Location: index.php");
                }
            }
            else{
                $registered = false;
            }
        }
        catch(Exception $e){
            echo $e;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href = "../css/reset.css" rel = "stylesheet">
    <link href = "../css/bootstrap.min.css" rel = "stylesheet">
    <link href = "../css/nav.css" rel = "stylesheet">
    <link href = "../css/login.css" rel = "stylesheet">
    <title>Login - Covitesse</title>
</head>
<body>
    <?php
    $page="login";
        include_once("imports/navbar.php")
    ?>
<div class="container form_login">
    <h1 class="text-center display-4">Login</h1>

    <form class="shadow-lg p-5 bg-white rounded"  action = "./login.php" method="post">



      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="yourname@example.com" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="myStrongPassword123" required>
      </div>

      <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Login</button>
    </form>
  
  <?php
    if(!$registered){
        ?>
        <div class="alert alert-danger text-center shadow-lg">
            <strong>No user with that email found! <a href="register.php">Register here</a></strong>
        </div>
        <?php
    }
  ?>
  </div>
</body>
</html>

<script src="../js/bootstrap.bundle.min.js"></script>
