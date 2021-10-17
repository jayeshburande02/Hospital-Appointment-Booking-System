<?php
 require "con-folder/dbconfig.php";
 if(isset($_SESSION['doc_logged_in'])==true){
   header("Location: Doctor_dashboard");
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        
        .card-deck{
            margin: 0 auto;
            margin-top: 100px;
            width: 50%;
        }


    </style>
</head>
<body style="background: rgb(184, 229, 247);">
    <div id="header">
        <h1 style="text-align: center;">Hospital Management System</h1>
    </div>
    
    
    <div class="card-deck" >
        <div class="card">
          <img style=" width: 300px; height: 300px; margin: 0 auto;" class="card-img-top" src="Images/docotr_image.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Doctor</h5>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#doctor_login">Login</a>
            <a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#doctor_registration">Sign up</a>
          </div>
        </div>
        <div class="card">
          <img style=" width: 300px; height: 300px; margin: 0 auto;" class="card-img-top" src="Images/patient_image.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Patient</h5>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#patient_login">Login</a>
            <a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#patient_registration">Sign up</a>
          </div>
        </div>
        
      </div>


<!--DOCTOR -->
      <!-- 1st Doctor login modal -->
      <div class="modal fade" id="doctor_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Login</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
                
                <form method="post" action="con-folder/doc-login.php">
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" name="doc_email_id" aria-describedby="emailHelp" placeholder="Enter email">

                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" name="doc_password" placeholder="Password">
                    </div>
  
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" value="login" class="btn btn-success" name="doc_login">
            </div>
            </form>
            </div>
          </div>
        </div>
      </div>

    <!-- 2st Doctor Registration modal -->
    <div class="modal fade" id="doctor_registration" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sign-up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="con-folder/doc-reg.php" method="post">
                    <div class="form-row">
                          
                    <div class="form-group col">
                        <label for="exampleInputFname">First Name</label>
                        <input type="text" class="form-control" name="f_name_doc" placeholder="First_Name">
                      </div>
                      
                      <div class="form-group col">
                        <label for="exampleInputLname">Last Name</label>
                        <input type="text" class="form-control" name="l_name_doc" placeholder="Last_Name">
                      </div>
                      </div>
                    
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" name="email_id_doc" aria-describedby="emailHelp" placeholder="Enter email">
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" name="password_doc" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirm Password</label>
                      <input type="password" class="form-control" name="password_doc_confirm" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputspeciality">Speciality</label>
                        <input type="text" class="form-control" name="speciality" placeholder="Speciality">
                      </div>
                    

            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" name="doc_submit_btn" value="Submit" class="btn btn-success">
            </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    <!-- <?php
    //  if(isset($_POST['doc_submit_btn'])){
    //    $first_name_doc = $_POST["f_name_doc"];
    //    $last_name_doc = $_POST["l_name_doc"];
    //    $email_id_doc = $_POST["email_id_doc"];
    //    $Password_doc = $_POST["password_doc"];
    //    $Password_doc_confirm = $_POST["password_doc_confirm"];
    //    $speciality = $_POST["speciality"];

    //     if($Password_doc==$Password_doc_confirm){
    //       $query=`select * from doctor where email_id='$email_id_doc'`;
    //       $query_run=mysqli_query($conn,$query);
    //       if(mysqli_num_rows($query_run)>0){
    //         echo '<script type"text/javascript">alert("User already exists...Try anoter Username")</script>';
    //       }
    //       else{
    //         $query="insert into doctor (first_name, last_name, email_id,	password,	speciality)values ('$first_name_doc','$last_name_doc','$email_id_doc','$Password_doc','$speciality')";
    //         $query_run=mysqli_query($conn,$query);
    //         if($query_run)
		// 					{
		// 						echo '<script type="text/javascript">alert("User Registered Successfully")</script>';
		// 					}	
		// 					else
		// 					{
		// 					echo '<script type="text/javascript">alert("Error")</script>';
		// 					}
    //       }
    //     }
    //     else{
    //       echo '<script type=text/javascript>alert("Password and Confirm Password do not match")</script>';
    //     }
    //   }

    
    ?> -->

<!--Patient -->
    
        <!--3rd patient login-->
        <div class="modal fade" id="patient_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  
                    
                    <form action="con-folder/pat-login.php" method="post">
                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" name="email_pat" aria-describedby="emailHelp" placeholder="Enter email">
    
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" name="password_pat" placeholder="Password">
                        </div>
      
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
                    <button type="submit" class="btn btn-success" name="pat_login_btn">
                      Login
                    </button>
                </div>
                </form>
    
      
                </div>
                
              </div>
            </div>
          </div>
        <!--4th patient registration-->

        <div class="modal fade" id="patient_registration" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sign-up</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form action="con-folder/patient-reg.php" method="post">
                        <div class="form-row">
                              
                        <div class="form-group col">
                            <label for="exampleInputFname">First Name</label>
                            <input type="text" class="form-control" name="pat_fname" placeholder="First_Name">
                          </div>
                          
                          <div class="form-group col">
                            <label for="exampleInputLname">Last Name</label>
                            <input type="text" class="form-control" name="pat_lname" placeholder="Last_Name">
                          </div>
                          </div>
                        
                        
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" name="pat_email" aria-describedby="emailHelp" placeholder="Enter email">
                          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" name="pat_password" placeholder="Password">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Confirm Password</label>
                          <input type="password" class="form-control" name="pat_password_confirm" placeholder="Password">
                        </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                      <button type="submit" class="btn btn-success" name="pat_reg_btn">
                        Submit
                      </button>
                </div>
                </form>
                </div>
            </div>
            </div>
        </div>
    



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</body>
</html>