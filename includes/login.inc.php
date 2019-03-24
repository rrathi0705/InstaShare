<?php
session_start();
if(isset($_POST['login'])){
    include 'dbh.inc.php';
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $pwd = mysqli_real_escape_string($conn,$_POST['password']);
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn,$sql);
    $resultcheck = mysqli_num_rows($result);
    if($resultcheck < 1){
        header("Location: ../login.php?login=false");
        exit();
    }else{
        if($row = mysqli_fetch_assoc($result)){
            //echo password_hash($pwd,PASSWORD_DEFAULT);
            $hashedpwdCheck = password_verify($pwd,$row['password']);
            if($hashedpwdCheck == false){
                header("Location: ../login.php?login=false");
                exit(); 
            }
            else if($hashedpwdCheck == true){
            	if($row['verified']==0){
            		header("Location:../login.php?RegisteredSuccessfully=true");
            		exit();
            	}
                //$sqlactivate = "SELECT * FROM users WHERE email='$email'";
                //$result = mysqli_query($conn,$sqlactivate);
                //if($row = mysqli_fetch_assoc($result)){
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    header("Location: ../home.php?login=success");
                    exit();
                //}
            }
        }
    }
}else{
    header("Location: ../login.php?login=error");
    exit();
}

