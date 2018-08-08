

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Create Account</title>
        <link rel="stylesheet" href="styles/create_acc.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


    </head>
    <body id="CreateForm">
    <?php

    include('nav.php');
    require 'functions/verify_user.php';
    require 'functions/create_id.php';
    require 'functions/alert.php';
    require 'functions/db.php';

    $name = '';
    $gender = '';
    $password = '';

     if (isset($_POST['submit'])){
         // process form
          $ok = true;

          if (!isset($_POST['name']) || $_POST['name'] === ''){
              alert("Please correct your name!", "danger");
                  $ok = false;
          } else{
              $name = $_POST['name'];
          }

         if (!isset($_POST['gender']) || $_POST['gender'] === ''){
             alert("Please Select a gender!", "danger");
                  $ok = false;
          } else{
              $gender = $_POST['gender'];
          }

         if (!isset($_POST['password']) || $_POST['password'] === '' ||  $_POST['password'] !==  $_POST['password_copy']){
             alert("Your passwords are not matching!", "danger");
             $ok = false;
         } else{
             $password = $_POST['password'];
         }

         if (!check_name_validity($name) && $name != ""){
             $ok = false;
             alert("Username " . $name . " Already Taken, please try with another one!" , "danger");
         }

         if(!$ok){

         }
         else{
             alert("Your Account was created with success" , "success");
        }

        if($ok){

//            $sql = sprintf("INSERT INTO users (id, name, gender, password, isAdmin)  VALUES ( '%s', '%s', '%s', '%s', 0)",
//                create_id_number($name),
//                $name,
//                $gender,
//                $hash
//            );

            $sql = $db->prepare("INSERT INTO users (username, gender, password, isAdmin) VALUES (:username, :gender, :pwd ,0)");

            $sql->execute([
                'username' => $name,
                'gender' => $gender,
                "pwd" => password_hash($password, PASSWORD_DEFAULT)
            ]);

        }
     }
    ?>

    <div class="container">
        <div class="create-form">
            <div class="main-div">
                <div class="panel">
                    <h2>Create Account</h2>
                    <p>Please fill all the champs</p>
                </div>
                <form id="Login" method="post">

                    <div class="form-group">

                        <input type="text" class="form-control"  name="name" value="<?php echo htmlspecialchars($name) ?>" placeholder="User name">
                    </div>

                    <div class="form-group">

                        <input type="password" class="form-control" name="password"  placeholder="Password">

                    </div>

                    <div class="form-group">

                        <input type="password" class="form-control" name="password_copy"  placeholder="Repeat password">

                    </div>

                    <div class="form-group">
                        <span class="radio-options"><input  type="radio" name="gender" value="f" <?php if($gender === "f") echo "checked" ?>>  Female</span>
                        <span class="radio-options"><input  type="radio" name="gender" value="m" <?php if($gender === "m") echo "checked" ?>>  Male</span>
                    </div>

                    <button type="submit" value="submit" name="submit"   class="btn btn-success">Create Account</button>
                    <br>
                    <span style="color: #777777;">- or -</span>
                    <br>
                    <button formaction="home.php" class="btn btn-primary">Log In</button>

                </form>
            </div>
        </div></div></div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    </body>
</html>