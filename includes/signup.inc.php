<?php
    session_start();
    if(isset($_POST['signup'])){    
        include_once 'dbh.inc.php';
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $_SESSION['username']=$username;
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $fname=mysqli_real_escape_string($conn,$_POST['fname']);
        $lname=mysqli_real_escape_string($conn,$_POST['lname']);
        $pwd=mysqli_real_escape_string($conn,$_POST['password']);
        $hash = md5( rand(0,1000) );
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);
        if($resultcheck > 0){
           header("location: ../signup.php?signup=UsernameNotAvailable");
            exit(); 
        }
        else{
            $hashpwd = password_hash($pwd,PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(username,fname,lname,email,password,verified,hash) VALUES ('$username','$fname','$lname','$email','$hashpwd','0','$hash');";
            mysqli_query($conn, $sql);
            $_SESSION['email']=$email;
            $_SESSION['password']=$pwd;
            $_SESSION['fname']=$fname;
            $_SESSION['hash']=$hash;
            header("location:verify.php");
            exit();
        }
    }else{
        header("location: ../signup.php");
        exit();
    }
?>