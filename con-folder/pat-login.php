<?php

    session_start();
    try{
        require "dbconfig.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    if(isset($_POST["pat_login_btn"])){

        $pat_email = $_POST["email_pat"];
        $pat_password =$_POST["password_pat"];

        $query="select * from patient where email_id='$pat_email' and password='$pat_password'";
        $query_run=mysqli_query($conn,$query);

        if(mysqli_num_rows($query_run)!=1){
            echo '<script type=text/javascript>alert("password donot match")</script>';
            header("Location: ../Index.php?dberror=email or password do not match");
        }
        else{
            $_SESSION['email_id']=$pat_email;

            header("Location: ../Patient_dashboard.php"); 
          }
    }
?>