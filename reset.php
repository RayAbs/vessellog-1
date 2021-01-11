<?php
     $db = mysqli_connect("localhost","root","","vessellog");
     if(!$db){
         echo "Database connect error".mysqli.error();
     }

    $userid = $_GET['userid'];
    $email = $_GET['email'];

    $select = $db->query("SELECT * FROM users WHERE userid = '".$userid."' AND email = '".$email."' ");
    $count = mysqli_num_rows($select);

    $newPass =  rand(11111,9999);

    if($count == 1){
        $update = $db->query("UPDATE users SET password = '".$newPass."' WHERE userid = '".$userid."' AND email = '".$email."'");

        if($update){
            echo json_encode($newPass);
        }
    }

?>