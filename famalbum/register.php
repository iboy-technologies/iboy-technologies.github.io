<?php

$family = urldecode($_SERVER['HTTP_FAMILY']);
$user = urldecode($_SERVER['HTTP_USERNAME']);
$pass = urldecode($_SERVER['HTTP_PWD']);
$email = urldecode($_SERVER['HTTP_EMAIL']);
$icon = '[';
$family_dir = $family;
$user_dir = $family . "/members/" . $user;

if (!is_dir($family_dir)) {
    mkdir($family_dir, 0755, true);
    mkdir($family_dir . '/gallery', 0755, true);
    file_put_contents($family_dir . "/gallery/gallery.db", $icon);
 
    if (!is_dir($user_dir)) {
        mkdir($user_dir, 0755, true);
        file_put_contents($user_dir . "/login.db", $pass);
        echo 'success';
    }else{
        echo "user exists";

    }
}else{
    if ($email == ""){
        //mkdir($family_dir, 0755, true);
        //mkdir($family_dir . '/gallery', 0755, true);
       // file_put_contents($family_dir . "/gallery/gallery.db", $icon);
 
        if (!is_dir($user_dir)) {
            mkdir($user_dir, 0755, true);
            file_put_contents($user_dir . "/login.db", $pass);
            echo 'success';
        }else{
            echo "user exists";

        }
    }else{
        echo "family exists";
    }
    
}    





