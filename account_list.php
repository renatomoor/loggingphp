<?php
require 'functions/auth.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/account_list.css">
</head>
<body id="List_of_Users">
    <?php
        include('nav.php');
    ?>

<div class="container">

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Username</th>
        <th style="text-align: center" scope="col">Gender</th>
        <th style="text-align: center" scope="col">IsAdmin</th>
        <th style="text-align: center" scope="col">Options</th>
    </tr>
    </thead>
    <tbody>

    <?php
        $db = mysqli_connect('localhost' , 'root', 'root', 'php');
        $sql = 'SELECT * FROM users';
        $result = mysqli_query($db,$sql);


        if (isset($_GET['delete'])){

            if(delete_acc($_GET['delete'])){
                alert("Account Deleted", "success");
            } else {
                alert("Error ", "danger");
            }

        }


        foreach ($result as $user) {
            printf('
                <tr>
                    <th scope="row">%s</th>
                    <td>%s</td>
                    <td style="text-align: center">%s</td>
                    <td style="text-align: center">%s</td>
                    <td style="text-align: center"><a href="update.php?id=%s">EDIT</a><br><a href="" data-toggle="modal" data-target="#delete_modal">DELETE</a></td>
                </tr>
                
                    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> DELETE </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    You are going to delete %s?
                                </div>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" id="delete_acc" name="delete" value="delete" data-id="%s" class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                
            ', htmlspecialchars($user['id']),
                htmlspecialchars($user['username']),
                htmlspecialchars($user['gender']),
                htmlspecialchars($user['isAdmin']),
                htmlspecialchars($user['id']),
                htmlspecialchars($user['username']),
            htmlspecialchars($user['id']));

        }
        mysqli_close($db);
    ?>
    </tbody>
</table>

</div>





<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    <script>

        $(document).ready(function(){
            $('#delete_acc').click(function(){
                var clickBtnValue = $(this).val();
                var id_value = $(this).data('id');
                var ajaxurl = 'delete.php',
                    data =  {'action': clickBtnValue, 'id' : id_value};
                $.post(ajaxurl, data, function (response) {
                    // Response div goes here.
                    location.reload();
                });
            });

        });</script>


</body>
</html>