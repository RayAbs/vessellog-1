<?php
require "connect.php";

if($_SERVER['REQUEST_METHOD']=="POST"){
    $response = array();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $company_id = $_POST['company_id'];
    $company_name = $_POST['company_name'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $image = $_FILES['image']['name'];
    $d = explode(".",$image);
    $name = $lname.".".$d[1];
    $image_Path = "assets/images/signatures/client/".$name;
    move_uploaded_file($_FILES['image']['tmp_name'],$image_Path);

    $sql = "SELECT username FROM users WHERE username = '".$username."'";

	$result = mysqli_query($con,$sql);
	$count = mysqli_num_rows($result);

    }
    if ($count == 1) {
		echo json_encode("Error");
	}else{
        $insert = "INSERT INTO users(username,password,email,company_id,company_name,fname,mname,lname,signature,pp,usertype) VALUES ('$username','$password','$email','$company_id','$company_name','$fname','$mname','$lname','$name',NULL,'client')";
		$query = mysqli_query($con,$insert);
		if ($query) {
			echo json_encode("Success");
		}
	}
   


?>



