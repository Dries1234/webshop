<?php
    include_once("imports/handler.php");
    session_start();
    if(isset($_SESSION["email"])){
      header("Location: index.php");
    }
    include_once("./imports/database.php");
    $datab = new Database();

    $error = false;
    $registered = false;
    $dberror = false;

    if(isset($_POST["submit"])){
        //prepare statement
        foreach($_POST as $i){
            if(!isset($i)){
                $error = true;
                break;
            }
            if(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
                $error = true;
            }
            if(!preg_match("/^(?:(?:\+|00)32|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/", trim($_POST["phone"]))){
                $error = true;
            }
            if(!strtotime(trim($_POST["birthdate"]))){
                $error = true;
            }
        }
        

        if(!$error){
            try{
                $datab->connect();



                $datab->prepare("INSERT INTO users(firstName,lastName,hashedPW,Address,email,phone,billingAddress,birthDate,creationDate,admin) VALUES(?,?,?,?,?,?,?,?,?,?)");

                //basic plain string info
                $name = htmlspecialchars($_POST["name"]);
                $lastName = htmlspecialchars($_POST["lastName"]);
                $address = htmlspecialchars($_POST["address"]);
                $email = htmlspecialchars($_POST["email"]);
                $phone = htmlspecialchars($_POST["phone"]);
                $billingAddress = htmlspecialchars($_POST["card"]);

                //hash password before pushing to database
                $password = htmlspecialchars($_POST["password"]);
                $password = password_hash($password, PASSWORD_DEFAULT);

                //birthDate formatting
                $birthDate = htmlspecialchars($_POST["birthdate"]);
                $birthDate = strtotime($birthDate);
                $birthDate = date("Y-m-d", $birthDate);

                //Creationdate in the correct format
                $creationdate = date("Y-m-d");


                //check if unique
                $emails = $datab->query("SELECT * FROM users WHERE email=\"" . $email . "\"");

                if($emails->num_rows > 0){
                    $registered = true;
                }
                else{
            


                  //Everything can be passed as a string
                  $datab->bind_param("sssssssssi", [$name,$lastName,$password,$address,$email,$phone,$billingAddress,$birthDate,$creationdate,(int)false]);
                  $datab->execute();
                }


            }
            catch(Exception $e){
               $dberror = true;
            }
        }
        if(!$error && !$registered && !$dberror){
          header("Location: login.php");
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
    <link href = "../css/register.css" rel = "stylesheet">
    <title>Register - Covitesse</title>
</head>
<body>
<?php
  $page="register";
  include_once("imports/navbar.php");
?>

<div class="container form_register">
    <h1 class="text-center display-4">Registration</h1>

    <form class="shadow-lg p-5 bg-white rounded-top"  onsubmit="formValidation()" action = "./register.php" method="post">

      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="enter full name" required>
      </div>
      <div class="form-group">
        <label for="name">Last Name</label>
        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="enter full name" required>
      </div>

      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="yourname@example.com" required>
      </div>

      <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="myStrongPassword123" required>
      </div>

      <div class="form-group">
        <label for="birthdate">Birth Date</label>
        <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="01/01/2000" required>
      </div>
      <div class="form-group">
        <label for="card">Card Number</label>
        <input type="text" class="form-control" id="card" name="card" placeholder="BE00 0000 0000 0000" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone number</label>
        <input type="tel" class="form-control" id="phone" pattern="^(?:(?:\+|00)32|0)\s*[1-9](?:[\s.-]*\d{2}){4}$" name="phone" placeholder="0470 00 00 00" required>
      </div>
      <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block">Register</button>
    </form>

  <?php
  if($error){
    ?>
    <div class="alert alert-danger text-center shadow-lg">
      <strong>Make sure all the fields are entered correctly!</strong>
    </div>
    <?php
  }
  if($registered){
    ?>
      <div class="alert alert-warning text-center shadow-lg">
        <strong>A user with that email already exists!</strong>
      </div>
    <?php
  }
  if($dberror){
    ?>
    <div class="alert alert-danger text-center shadow-lg">
      <strong>Something went wrong connecting to the database!</strong>
    </div>
    <?php
  }

  ?>
  </div>
</body>
</html>
<script src="../js/bootstrap.bundle.min.js"></script>
