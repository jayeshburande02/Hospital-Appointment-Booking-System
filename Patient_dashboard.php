<?php

try{
  require "con-folder/dbconfig.php";
}catch(Exception $e){
  die("Database Handler Not Found : ". $e->getMessage());
}

session_start();
  $email_id=$_SESSION['email_id'];
  $query="select * from patient where email_id='$email_id'";
  $query_run = mysqli_query($conn,$query);
  if(!$query_run){
    echo "failed to execute query".mysqli_error($conn);
  }
  else{
    $record=mysqli_fetch_assoc($query_run);
    $patient_id= $record["pat_id"];
    $first_name = $record["first_name"]; 
    $last_name= $record["last_name"];
    $email_id= $record["email_id"];
    $_SESSION['pat_id']=$patient_id;
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
    <title>Patient Dashboard</title>

    <script 
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" 
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" 
        crossorigin="anonymous"></script>
    <script 
        src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" 
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" 
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
    
 
  </head>
  <body style="background-color: rgb(255, 241, 241) ;">
    
    
    <!--Navigation bar -->

    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
        <ul class="nav">
          <li class="nav-item"><a style="color: white;" class="navbar-brand" href="Doctor_dashboard.php">Patient Dashboard</a> </li>
          <li class="nav-item"><a style="color: white;" class="navbar-brand" href="practice.php">See all Appointments</a></li> 
        </ul> 
          <form action="Index.php" method="post">
            <button class="btn btn-danger" type="submit" name="pat_logout">
               Log-Out
            </button>
            </form>   
            <?php
            if(isset($_POST["pat_logout"])){
              session_destroy();
              header("Location: ../Index.php"); 
            }
            ?>

        </div>
      </nav>
    <!--Navigation ends-->

    <!-- cards -->
    
    <div class="card mb-3 bg-success" style="max-width: 540px; height: 300px; margin: 0 auto; margin-top: 20px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="Images/patient_image.jpg" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body" style="color: white;">
              <h4>Name: <?php echo "".$first_name." ".$last_name?></h4>
              <h6>Email: <?php echo $email_id?></h6>
              
            </div>
          </div>
        </div>
      </div>
<!--breaking the page-->
    
<div style="padding: 50px;margin: 50px;" >
    <hr style="color: rgb(0, 0, 0); height: 5px; ">
      <h1 style="text-align: center;">Books Appointments</h1>
    <hr style="color: rgb(0, 0, 0); height: 5px; ">


    <?php
    
    // $book_form = "
		// 					<form>
		// 						<div class='form-row'>
		// 							<div class='col' id='dateInput'>
		// 								<label class='h6' for='dob'>Appointment Date</label>
    //                 <input type='date' id='app-date' name='app_date'><span class='input-group-addon'></span>
		// 								<small class='error-text' id='app-date-error' ></small>
		// 							</div>
									
		// 							<div class='col' id='timeInput'>
		// 								<label class='h6' for='time'>Appointment Time</label>
		// 								<!--input type='text' class='form-control border-prop' name='app-time' id='app-time' placeholder='Select Time' required autocomplete='off'/>
		// 								<span class='input-group-addon'></span-->
									
		// 								<select id='time' class='custom-select border-prop' name='time' required>
		// 									<option value='' disabled selected>Click this to Select</option>
		// 									<option value='10'>10:00am</option>
		// 									<option value='11'>11:00am</option>
		// 									<option value='12'>12:00pm</option>
		// 									<option value='13'>1:00pm</option>
		// 									<option value='14'>2:00pm</option>
		// 									<option value='15'>3:00pm</option>
		// 									<option value='16'>4:00pm</option>
		// 									<option value='17'>5:00pm</option>
		// 									<option value='18'>6:00pm</option>
		// 									<option value='19'>7:00pm</option>
		// 									<option value='20'>8:00pm</option>
		// 								</select>
		// 								<small class='error-text' id='dob-time-error' ></small>
		// 							</div> 
		// 						</div>			 
		// 					</form>
		// 				";
    //         echo($book_form);
    ?>
    <!--table-->
    
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Sr. Number</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Specialization</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $query="select doc_id,first_name,last_name,email_id,speciality  from doctor";
        $query_run = mysqli_query($conn,$query);
        if(!$query_run){
          echo "failed to execute query".mysqli_error($conn);
        }
        else{
          while($record=mysqli_fetch_assoc($query_run)){
            echo "<tr><td>" .$record['doc_id']. "</td>
            <td>".$record['first_name']."</td>
            <td>".$record['last_name']."</td>
            <td>".$record['speciality']."</td>
            
            <td><form action='con-folder/book-app.php' method='post' id='book-form'>
            <input type='hidden' name='doc-id' value=".$record['doc_id']."></input>
            <button type='submit' id='book' name='book' class='btn btn-primary'>
             Book 
             </button>
             </form></td> 
            </tr>";
          }
          
        }
        ?>
      </tbody>
    </table>
  </div>


    <!--Modal-->
<!-- 
    <div class="modal fade" id="bookapp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Select date and time</h5>
          </div>
          <div class="modal-body">
            <form action="" method="post">
            <input type="hidden" id="custId" name="custId" value="3487">
            <p>
            <label for="date">Enter date</label>
            <input type="date" id="date">
            </p>
            <p>
              <label for="time">Enter time</label>
              <input type="time" id="time">
            </p>
          </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Book</button>
          </div>
        </div>
      </div>
    </div> -->


  
      
    <script> 

      $("#book").click(function(e){
      $("#app-date-val").val($("#app-date").val());
      $("#app-time-val").val($("#time").val());

      console.log("hellosdfjlk");
      console.log("hellosdfjlk");
      console.log($("#app-time-val").val());
      console.log($("#app-date-val").val());

      });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
    
  </body>
</html>
<!-- 
// while($record=mysqli_fetch_assoc($query_run){
            
            //   // echo "<tr><th scope='row'>".$record['doc_id']."</th>
            //   // <td>".$record['first_name']."</td>
            //   // <td>".$record['last_name']."</td>
            //   // <td>".$record['speciality']."</td>
            //   // <td> <button type='button' id=".$record['doc_id']." class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'> Book </button>
            //   // </tr>";
  
            // } -->