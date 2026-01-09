<?php
if (extension_loaded('gd')) {
    echo "GD is enabled.";
    $info = gd_info();
    print_r($info);
} else {
    echo "GD is NOT enabled.";
}
