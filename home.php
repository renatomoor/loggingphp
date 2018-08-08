<?php
session_start();
$loggedin;

require 'functions/alert.php';
$username = "";

if(isset($_POST['name']) && isset($_POST['password'])){
    $db = mysqli_connect('localhost', 'root', 'root', 'php');
    $sql = sprintf("SELECT * FROM users WHERE username='%s'",
        mysqli_real_escape_string($db,$_POST['name']));

    $username = $_POST['name'];

    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);

    if($row) {
        $hash = $row['password'];
        $isAdmin = $row['isAdmin'];

        if (password_verify($_POST['password'], $hash)) {
            alert("Login successful! ", 'success');

            $_SESSION['username'] = $row['username'];
            $_SESSION['isAdmin'] = $isAdmin;
            $_SESSION['loggedin'] = true;




        } else{
            alert("Login Failed", 'danger');
        }

    }   else {

        alert("Login Failed", "danger");

    }
    mysqli_close($db);
};
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles/home.css">
</head>


<body id="LoginForm">

<?php include('nav.php'); ?>
<div class="container">
    <div class="login-form">
        <div class="main-div">
<div class="panel">
                <h2>Login</h2>
                <p>Please enter your username and password</p>
            </div>
                <form method="post" action="" id="Login">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" value="<?php ($username != "")?$username:'' ?>" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                </div>
                <div style="text-align: center" class="forgot">
                    <a  href="create_acc.php">Create Account</a>
                </div>
                
                <button type="submit" class="btn btn-primary">Login</button>

            </form>
        </div>
    </div></div></div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>