<?php
    $email=$_POST['email'];
    $password=$_POST['password'];

    //Database connection here
    $conn = new mysqli("localhost", "root", "", "codefactz");
    if($conn->connect_error){
        die("Failed to connect: ".$conn->connect_error);
    }else{
        $stmt=$conn->prepare("select * from register where email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows>0){
            $data = $stmt_result->fetch_assoc();
            if($data['password'] === $password){
                header("Location: index2.html");
            }else{
                echo "<h2>invalid email or password</h2>";
            }
        }else{
            echo "<h2>invalid email or password";
        }
    }
?>