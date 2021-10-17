<?php

session_start();

try{
  require "con-folder/dbconfig.php";
}catch(Exception $e){
  die("Database Handler Not Found : ". $e->getMessage());
}

$patient_id=$_SESSION['pat_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

  <style>
    body {
      font-family: "Lato", sans-serif;
    }
    hr{
      background: white;
    }
    .sidenav {
      height: 100%;
      width: 0;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      transition: 0.5s;
      padding-top: 60px;
    }
    
    .sidenav a {
      padding: 8px 8px 8px 32px;
      text-decoration: none;
      font-size: 20px;
      color: #818181;
      display: block;
      transition: 0.3s;
    }
    
    .sidenav a:hover {
      color: #f1f1f1;
    }
    
    .sidenav .closebtn {
      position: absolute;
      top: 0;
      right: 25px;
      font-size: 36px;
      margin-left: 50px;
    }
    
    @media screen and (max-height: 450px) {
      .sidenav {padding-top: 15px;}
      .sidenav a {font-size: 18px;}
    }
    </style>
</head>
<body>

  <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
      <!--Side Navigation bar-->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="Patient_dashboard.html">Home</a>
    <a href="#">Today's Appointments</a>
    <a href="#">Previous Appointments</a>
    <a href="#">Upcoming Appointments</a>
  </div>
  
  <!--side nav ends-->

    <ul class="nav">
      <li class="nav-item"><span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span></li>
      <li class="nav-item" style="margin-left: 20px;"><a style="color: white;" class="navbar-brand" href="practice.php">Appointments</a> </li>
      <li class="nav-item"><a style="color: white;" class="navbar-brand" href="Patient_dashboard.php">Home</a></li> 
    </ul>  
    <form action="Index.php" method="post">
        <button class="btn btn-danger" type="submit" name="logout-btn">Log-Out</button>
  </form>    
    </div>
  </nav>
  
        <?php
            if(isset($_POST["logout-btn"])){
              session_destroy();
              header("Location: Index.php"); 
            }
            ?>

  <!--Navbar ends-->
  <div style="margin: 5%; background-color: rgb(0, 0, 0);">
  <h1 style="color: whitesmoke; text-align: center;">Today's Appointment</h1>
  <hr>
    <!--card 1-->

    
    <?php
      $today=date("Y-m-d");
      $query="select * from appointment where date='$today' and pat_id='$patient_id' and status=-1";
      $query_run=mysqli_query($conn,$query);
      $count=mysqli_num_rows($query_run);
      if($count>=1){
        while($record=mysqli_fetch_assoc($query_run)){
          $doctor_id=$record['doc_id'];
          $query1="select first_name, last_name, speciality from doctor where doc_id='$doctor_id' ";
          $query_run1=mysqli_query($conn,$query1);
          $record1=mysqli_fetch_assoc($query_run1);
          echo "
          <div class='card text-center' style='margin: 2%;margin-left: 10%; margin-right: 10%;'>
      
          <div class='card-body'>
            <h5 class='card-title'>Name of the doctor: Dr. ".$record1['first_name']." ".$record1['last_name']."</h5>
            <h5>Date: ".$today."</h5>
            <h5>Time: ".$record['time']."</h5>
            <h5>Speciality: ".$record1['speciality']."</h5>
          </div>
          <div class='card-footer text-muted'>
            Today
          </div>
        </div>
          ";
        }
      }
      else{
        echo "<h2>No appointments today <h2>";
      }
    
    ?>
    
    


  <hr>
  <h1 style="color: whitesmoke; text-align: center;">Previous Appointments</h1>
  <hr>
    <!--card 1-->

    <?php

      $query="select * from appointment where pat_id='$patient_id' and status=1";
      $query_run=mysqli_query($conn,$query);
      $count=mysqli_num_rows($query_run);
      if($count>=1){
        while($record=mysqli_fetch_assoc($query_run)){
          $doctor_id=$record['doc_id'];
          $query1="select first_name, last_name, speciality from doctor where doc_id='$doctor_id' ";
          $query_run1=mysqli_query($conn,$query1);
          $record1=mysqli_fetch_assoc($query_run1);
          echo "
          <div class='card text-center' style='margin: 2%;margin-left: 10%; margin-right: 10%;'>
          <div class='card-body'>
            <h5 class='card-title'>Name of the doctor: Dr. ".$record1['first_name']." ".$record1['last_name']."</h5>
            <h5>Date: ".$record['date']."</h5>
            <h5>Time: ".$record['time']."</h5>
            <h5>Speciality: ".$record1['speciality']."</h5>
          </div>
        </div>
          ";
        }
            
      }
      else{
        echo "<h2 style=' color: white; text-align: center'>No previous appointments <h2>";
      }
    ?>

  <hr>
  <h1 style="color: whitesmoke; text-align: center;">Future scheduled Appointments</h1>
  <hr>

      
    <?php

      $query="select * from appointment where pat_id='$patient_id' and status=-1 and date>'$today'";
      $query_run=mysqli_query($conn,$query);
      $count=mysqli_num_rows($query_run);
      if($count>=1){
        while($record=mysqli_fetch_assoc($query_run)){
          $doctor_id=$record['doc_id'];
          $query1="select first_name, last_name, speciality from doctor where doc_id='$doctor_id' ";
          $query_run1=mysqli_query($conn,$query1);
          $record1=mysqli_fetch_assoc($query_run1);
          echo "
          <div class='card text-center' style='margin: 2%;margin-left: 10%; margin-right: 10%;'>
          <div class='card-body'>
            <h5 class='card-title'>Name of the doctor: Dr. ".$record1['first_name']." ".$record1['last_name']."</h5>
            <h5>Date: ".$record['date']."</h5>
            <h5>Time: ".$record['time']."</h5>
            <h5>Speciality: ".$record1['speciality']."</h5>
          </div>
        </div>
          ";
        }
            
      }
      else{
        echo "<h2 style=' color: white; text-align: center'>No previous appointments <h2>";
      }
    ?>


  <!--Card 1-->
  <!-- <div class="card text-center" style="margin: 2%;margin-left: 10%; margin-right: 10%;">
    <div class="card-body">
      <h5 class="card-title">Name of the doctor: Dr. Maheshvari</h5>
      <h5>Date: </h5>
      <h5>Time: </h5>
      <h5>Speciality: </h5>
      
    </div>
    
  </div> -->


  <hr>
  </div>

  

  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
    }
    
    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
  
</body>
</html>