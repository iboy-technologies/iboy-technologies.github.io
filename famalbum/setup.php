<?php


$family = urldecode($_SERVER['family_name']);
$username = urldecode($_SERVER['username']);
$pass = urldecode($_SERVER['pwd']);
$user_dir = $family . "/" . $username;

if (is_dir($user_dir)){
    file_put_contents($user_dir . "/login.db", $pass);
    echo "success";
}




