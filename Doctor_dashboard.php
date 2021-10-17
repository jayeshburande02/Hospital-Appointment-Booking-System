<?php
 session_start();
 if(!isset($_SESSION['doc_logged_in'])|| $_SESSION['doc_logged_in']!=true){
   header("Location: Index.php");
 }

try{
  require "con-folder/dbconfig.php";
}catch(Exception $e){
  die("Database Handler Not Found : ". $e->getMessage());
}
 
  $email_id=$_SESSION['email_id'];
  $query="select * from doctor where email_id='$email_id'";
  $query_run = mysqli_query($conn,$query);
  if(!$query_run){
    echo "failed to execute query".mysqli_error($conn);
  }
  else{
    $record=mysqli_fetch_assoc($query_run);
    $doc_id=$record["doc_id"];
    $first_name = $record["first_name"]; 
    $last_name= $record["last_name"];
    $email_id= $record["email_id"];
    $speciality= $record["speciality"];
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <title>Doctor Dashboard</title>

    
  </head>
  <body style="background-color: rgb(255, 241, 241) ;">
    
    
    <!--Navigation bar -->

    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
          <a style="color: white;" class="navbar-brand" href="Doctor_dashboard.php">Doctor Dashboard</a>
            
            <form action="Index.php" method="post">
            <button class="btn btn-danger" type="submit" name="logout_doc">Log-Out</button>
            </form>
            <?php
            if(isset($_POST["logout_doc"])){
              session_unset();
              session_destroy();
              header("Location: Index.php");
              exit; 
            }
            ?> 
          
        </div>
      </nav>
    <!--Navigation ends-->

    <!-- cards -->
    
    <div class="card mb-3 bg-success" style="max-width: 540px; height: 300px; margin: 0 auto; margin-top: 20px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="Images/docotr_image.png" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body" style="color: white;">
              
              <h4>Name: <?php echo "Dr.".$first_name." ".$last_name?></h4>
              <h6>Email: <?php echo $email_id?></h6>
              <h6>Specialization: <?php echo $speciality?></h6>
            </div>
          </div>
        </div>
      </div>
<!--breaking the page-->

<!-- using php for retiving appointment details -->


<!--todays appointmnet div-->   
<div style="padding: 50px;">
    <hr style="color: rgb(0, 0, 0); height: 5px; ">
      <h1 style="text-align: center;">Appointment</h1>
    <hr style="color: rgb(0, 0, 0); height: 5px; ">


    <div style="margin-left: 10%; margin-right: 10%; background-color: azure;">
    <hr style="color: rgb(0, 0, 0); height: 5px; ">
    <h2 style="text-align: center;">Todays Appointment</h2>
    <hr style="color: rgb(0, 0, 0); height: 5px; ">

      
      <?php
          $today = date("Y-m-d");

          $query="select * from appointment where doc_id='$doc_id' and date='$today' and status=-1";
          $query_run=mysqli_query($conn,$query);
          $count = mysqli_num_rows($query_run);
          if($count>=1){
            while($record=mysqli_fetch_assoc($query_run)){
              $patient_id2=$record['pat_id'];
              $query2="select first_name, last_name from patient where pat_id='$patient_id2'";
              $query_run2=mysqli_query($conn,$query2);
              $record2=mysqli_fetch_assoc($query_run2);
              echo "
      
              <div class='card-group' style='margin: 5%; margin-left: 10%; margin-right: 10%;'>
             <div class='card hov' style='margin: 20px; background-color: rgb(55, 242, 248);'>
      
              <div class='card-body'>
                <h5 class='card-title'>Patient id: ".$record['pat_id']."</h5>
                <h5 class='card-title'>Patient name:".$record2['first_name']." ".$record2['last_name']."</h5>
                <h5 class='card-title'>Date: ".$today."</h5>
                <h5 class='card-title'>Time: ".$record['time']."</h5>
              </div>
              <div class='card-footer'>
              <form action='Doctor_dashboard.php' method='post'>
                <input type='hidden' name='app_id' value='$record[app_id]'>
                <button class='btn btn-danger' type='submit' name='examine'>Examine</button>
               </form> 
              </div>
            </div> 
            </div>
            ";
            }
          } 
          else{
          echo "<h2> No appointments today </h2>";
          }

      ?>
     </div>
          <?php
          
            if(isset($_POST['examine'])){
              $appointment_id = $_POST['app_id'];
              $query="update appointment set status=1 where app_id='$appointment_id' ";
              $query_run=mysqli_query($conn,$query);
              if($query_run)
              { 
                  header("Refresh:0");
                  echo '<script type="text/javascript">alert("appointment examined successfully")</script>';
                 
              }	
              else
              {
                echo '<script type="text/javascript">alert("Error")</script>';
              }
            }
          ?>

     <!-- Future appointment div-->
  <div style="margin-left: 10%; margin-right: 10%; background-color: azure;">
    <hr style="color: rgb(0, 0, 0); height: 5px; ">
    <h2 style="text-align: center;">Upcoming Scheduled Appointment</h2>
    <hr style="color: rgb(0, 0, 0); height: 5px; ">

    <?php
      $query="select * from appointment where date>'$today'";
      $query_run=mysqli_query($conn,$query);
      $count = mysqli_num_rows($query_run);
      if($count>=1){
        while($record=mysqli_fetch_assoc($query_run)){
          $patient_id2=$record['pat_id'];
              $query2="select first_name, last_name from patient where pat_id='$patient_id2'";
              $query_run2=mysqli_query($conn,$query2);
              $record2=mysqli_fetch_assoc($query_run2);
              echo "
              <div class='card-group' style='margin: 5%; margin-left: 10%; margin-right: 10%;'>
             <div class='card hov' style='margin: 20px; background-color: rgb(55, 242, 248);'>
      
              <div class='card-body'>
                <h5 class='card-title'>Patient id: ".$record['pat_id']."</h5>
                <h5 class='card-title'>Patient name:".$record2['first_name']." ".$record2['last_name']."</h5>
                <h5 class='card-title'>Date: ".$record['date']."</h5>
                <h5 class='card-title'>Time: ".$record['time']."</h5>
              </div>
            </div> 
            </div>
            ";
        }
      }
      else
      {
        echo "<h2>No upcoming appointments";
      }
     ?>

    
  </div>


</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
    
  </body>
</html>