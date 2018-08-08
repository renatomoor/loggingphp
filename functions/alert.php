<?php
function alert($msg, $type){

echo '<div style="text-align: center" class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
    <strong> '.$msg.'</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div></button>';
};
?>