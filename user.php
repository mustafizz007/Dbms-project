<?php

include 'connect.php';

if (isset($_POST['submit']))
{
    $v_id = $_POST ['v_id'];
    $o_name = $_POST ['o_name'];
    $o_email = $_POST ['o_email'];
    $o_mobile = $_POST ['o_mobile'];
    $o_address = $_POST ['o_address'];
    $o_status = $_POST ['o_status'];

    $sql = "insert into vehicle_list (v_id, o_name, o_email, o_mobile,  o_address , o_status) values('$v_id ', ' $o_name' , ' $o_email' , '$o_mobile', '$o_address', '$o_status')";
    $result = mysqli_query($con, $sql);

    if ($result){
        // echo "Data inserted successfully";
        header('location:display.php');
    }
    else {
        die(mysqli_error($con));
    }

}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Garage Information</title>
  </head>
  <body>
    <!-- <h1>Hello, world!</h1> -->

    <div class="container my-5">

    <form method = "post">

    <div class="form-group">
    <label>vehicle id</label>
    <input type="text" class="form-control" 
    placeholder = "vehicle's number plate" name = "v_id" > 
</div>
<div class="form-group">
    <label>Owner Name</label>
    <input type="text" class="form-control" 
    placeholder = "Enter name" name = "o_name" > 
</div>
<div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" 
    placeholder = "Enter email" name = "o_email" > 
</div>
<div class="form-group">
    <label>Mobile</label>
    <input type="text" class="form-control" 
    placeholder = "Enter mobile number" name = "o_mobile" > 
</div>
<div class="form-group">
    <label>Address</label>
    <input type="text" class="form-control" 
    placeholder = "Enter address" name = "o_address" > 
</div>
<div class="form-group">
    <label>Status</label>
    <select class="form-control" name="o_status">
        <option value="1">Ready to Deliver</option>
        <option value="0">Not Ready</option>
    </select>
</div>
     <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
  <!-- </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary" name = "submit">Submit</button>
</form>



    </div>


    
  </body>
</html>