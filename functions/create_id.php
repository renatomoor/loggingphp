<?php
/**
 * Created by PhpStorm.
 * User: renatomoor
 * Date: 06.08.18
 * Time: 16:30
 */

function create_id_number($name){

    do {
        $id = uniqid(substr($name,0,2));

        $db = mysqli_connect('localhost', 'root', 'root', 'php');
        $sql = 'SELECT * FROM users WHERE id="'.$id.'"';
        $result = mysqli_query($db, $sql);
        $num_rows = mysqli_num_rows($result);
        if($num_rows == 0)  $check_id = true;
        else  $check_id = false;
    } while ($check_id === false);
    return $id;
};

?>