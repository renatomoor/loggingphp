

<?php
    function check_name_validity($name){

        $db = mysqli_connect('localhost', 'root', 'root', 'php');
        $sql = 'SELECT * FROM users WHERE username="'.$name.'"';
        $result = mysqli_query($db, $sql);
        $num_rows = mysqli_num_rows($result);
        if($num_rows == 0) return true;
        else return false;
    };
?>
