<?php
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function go_back() {
    echo "<script type='text/javascript'>history.go(-1);</script>";
}
?>