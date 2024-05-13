
<?php

include 'connect.php';

$id = $_GET['updateid'];
$sql = "select * from vehicle_list where id=$id";

$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);

$v_id = $row['v_id'];
$o_name = $row ['o_name'];
$o_email = $row ['o_email'];
$o_mobile = $row ['o_mobile'];
$o_address = $row ['o_address'];
$o_status = $row ['o_status'];
// $status = $_POST['status']; // New status value
// die(mysqli_error($con));

if (isset($_POST['update']))
{
    $v_id = $_POST ['v_id'];
    $o_name = $_POST ['o_name'];
    $o_email = $_POST ['o_email'];
    $o_mobile = $_POST ['o_mobile'];
    $o_address = $_POST ['o_address'];
    $o_status = $_POST ['o_status'];

   
    $sql = "update  vehicle_list set v_id='$v_id',o_name='$o_name', o_email='$o_email', o_mobile='$o_mobile', o_address='$o_address', o_status='$o_status' where id = $id";
    
    $result = mysqli_query($con, $sql);

    if ($result){
        // echo "updated successfully";
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
    <label>Vehicle id</label>
    <input type="text" class="form-control" 
    placeholder = "vehicle's number plate" name = "v_id" value = "<?php echo $v_id; ?>" > 
</div>
<div class="form-group">
    <label>Owner Name</label>
    <input type="text" class="form-control" 
    placeholder = "Enter name" name = "o_name" value = "<?php echo $o_name; ?>">
</div>
<div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" 
    placeholder = "Enter email" name = "o_email" value =  "<?php echo $o_email; ?>"> 
</div>
<div class="form-group">
    <label>Mobile</label>
    <input type="text" class="form-control" 
    placeholder = "Enter mobile number" name = "o_mobile"value = "<?php echo $o_mobile; ?>" > 
</div>
<div class="form-group">
    <label>Address</label>
    <input type="text" class="form-control" 
    placeholder = "Enter address" name = "o_address" value = "<?php echo $o_address; ?>"> 
</div>


<div class="form-group">
    <label>Status</label>
    <select class="form-control" name="o_status">
        <option value="0" <?php if ($o_status == 0) echo 'selected'; ?>>Not Ready</option>
        <option value="1" <?php if ($o_status == 1) echo 'selected'; ?>>Ready</option>
    </select>
</div>

  <button type="update" class="btn btn-primary" name = "update">update</button>

</form>



    </div>


    
  </body>
</html>