<?php
/**
 * Created by PhpStorm.
 * User: renatomoor
 * Date: 07.08.18
 * Time: 17:13
 */

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'delete':
            delete_acc($_POST['id']);
            break;
    }
}



function delete_acc($id){
        $db = mysqli_connect("localhost", "root", "root", "php");
        $sql = "DELETE FROM users WHERE id='$id'";
        mysqli_query($db, $sql);
        mysqli_close($db);
        exit;
}
?>
