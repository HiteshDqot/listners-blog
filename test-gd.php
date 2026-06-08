<?php

echo "PHP Version: " . phpversion() . "<br><br>";

echo "Loaded php.ini: " . php_ini_loaded_file() . "<br><br>";

echo "<pre>";
print_r(gd_info());