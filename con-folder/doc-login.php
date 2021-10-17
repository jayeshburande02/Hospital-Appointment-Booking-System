<?php
    session_start();

    try{
        require "dbconfig.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    if(isset($_POST["doc_login"]))
    {

        $email_id_doc=$_POST["doc_email_id"];
        $password_doc=$_POST["doc_password"];

        $query = "select * from doctor where email_id='$email_id_doc' and password='$password_doc'";
        $query_run = mysqli_query($conn,$query);

        if(mysqli_num_rows($query_run)!=1){
            echo '<script type=text/javascript>alert("password donot match")</script>';
            header("Location: ../Index.php?dberror=email or password do not match");
        }
        else{
            $_SESSION['email_id']=$email_id_doc;
            $_SESSION['doc_logged_in']=true;
            header("Location: ../Doctor_dashboard.php"); 
          }

    }


?>