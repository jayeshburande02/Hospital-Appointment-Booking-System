<?php
    try{
        require "dbconfig.php";
    }catch(Exception $e){
        die("Database Handler Not Found : ". $e->getMessage());
    }

    if(isset($_POST["pat_reg_btn"])){

        $pat_firstname = $_POST["pat_fname"];
        $pat_lastname = $_POST["pat_lname"];
        $pat_email_id = $_POST["pat_email"];
        $pat_password = $_POST["pat_password"];
        $pat_password_confirm = $_POST["pat_password_confirm"];

        if($pat_password==$pat_password_confirm){
            $query="`select * from patient where email_id='$pat_email_id'` ";
            $query_run=mysqli_query($conn,$query);
            if(mysqli_num_rows($query_run)>0){
                echo '<script type"text/javascript">alert("User already exists...Try anoter Username")</script>';
              }
            else{
                    $query="insert into patient (first_name, last_name, email_id, password)values ('$pat_firstname','$pat_lastname','$pat_email_id','$pat_password')";
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