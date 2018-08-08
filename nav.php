
<ul class="nav justify-content-center">

    <?php


    if (!empty($_SESSION['isAdmin'])) {
        if (($_SESSION['isAdmin'])){
            echo '    <li class="nav-item">
        <a class="nav-link" href="account_list.php"><h1 class="form-heading">Account List</h1></a>
    </li>';
        }
    }

    if (!empty($_SESSION['loggedin'])) {
        if (($_SESSION['loggedin'])) {
            echo '        <li class="nav-item">
        <a class="nav-link" href="/functions/exit.php"><h1 class="form-heading">Logout</h1></a>
    </li>';
        }
    } else {
        echo '       <li class="nav-item">
        <a class="nav-link" href="home.php"><h1 class="form-heading">Login</h1></a>
    </li>';
    }
    ?>

</ul>