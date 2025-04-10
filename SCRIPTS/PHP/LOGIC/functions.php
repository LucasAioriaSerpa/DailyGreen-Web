
<?php

function debug_var($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
}

function debug_array($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
