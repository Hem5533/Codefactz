<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($name) || !empty($email) || !empty($password)){
    $host="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="codefactz";

    //create connection
    $conn  = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if(mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '.mysqli_connect_error());
    }
    else{
        $SELECT = "SELECT email FROM register where email=? Limit 1";
        $INSERT = "INSERT  Into register(name, email, password) values(?,?,?)";

        //prepare statement
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        //checking username
        if($rnum==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sss", $name, $email, $password);
            $stmt->execute();
            echo "Registered successfully.";
            echo 'Click here to <a href="login.html">login</a>';
        }else{
            echo "Someone already register using this email";
        }
        $stmt->close();
        $conn->close();
    }
}else{
    echo "All field are required";
    die();
}
?>