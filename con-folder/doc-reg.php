<?php

    try{
        require "dbconfig.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    if(isset($_POST['doc_submit_btn'])){
        $first_name_doc = $_POST["f_name_doc"];
        $last_name_doc = $_POST["l_name_doc"];
        $email_id_doc = $_POST["email_id_doc"];
        $Password_doc = $_POST["password_doc"];
        $Password_doc_confirm = $_POST["password_doc_confirm"];
        $speciality = $_POST["speciality"];
 
         if($Password_doc==$Password_doc_confirm){
           $query=`select * from doctor where email_id='$email_id_doc'`;
           $query_run=mysqli_query($conn,$query);
           if(mysqli_num_rows($query_run)>0){
             echo '<script type"text/javascript">alert("User already exists...Try anoter Username")</script>';
           }
           else{
             $query="insert into doctor (first_name, last_name, email_id,	password,	speciality)values ('$first_name_doc','$last_name_doc','$email_id_doc','$Password_doc','$speciality')";
             $query_run=mysqli_query($conn,$query);
             if($query_run)
            {
                echo '<script type="text/javascript">alert("User Registered Successfully")</script>';
            }	
            else
            {
            echo '<script type="text/javascript">alert("Error")</script>';
            }
           }
         }
         else{
           echo '<script type=text/javascript>alert("Password and Confirm Password do not match")</script>';
         }
       }
 
       header("Location: ../Index.php"); 
?>