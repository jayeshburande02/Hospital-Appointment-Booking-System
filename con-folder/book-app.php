<?php

session_start();

try{
    require "dbconfig.php";
  }catch(Exception $e){
    die("Database Handler Not Found : ". $e->getMessage());
  }
  
  
  
  if(isset($_POST['book-btn'])){
    $app_date=$_POST['date'];
    //echo($app_date);
    $app_time=$_POST['time'];
    //echo($app_time);
    $doctor_id=$_POST['doc_id'];
    echo($doctor_id);
    $patient_id=$_SESSION['pat_id'];
    
    $query="insert into appointment (date, time , pat_id, doc_id) values ('$app_date', '$app_time',' $patient_id','$doctor_id')";
    $query_run=mysqli_query($conn,$query);
    if($query_run)
    {
        echo '<script type="text/javascript">alert("appointment booked successfully")</script>';
        header("Location: ../Patient_dashboard.php");
    }	
    else
    {
      echo '<script type="text/javascript">alert("Error")</script>';
    }
    
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book your appointment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>
<body style="background-color: rgb(91, 91, 91);">

<div class="card" style="margin: 10%;">
  <h5 class="card-header">Book Date and Time</h5>
  <div class="card-body">
    <form action="book-app.php" method="post">
            
            <p>
            <label for="date">Enter date</label>
            <input type="date" id="date" name="date">
            </p>
            <p>
              <label for="time">Enter time</label>
              <input type="time" id="time" name="time">
            </p>
          <?php echo "<input type='hidden' id='doc_id' name='doc_id' value='".$_POST['doc-id']."'>";
          ?>
          <button type="submit" name="book-btn" class="btn btn-success">Book</button>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</body>
</html>
