<!-- function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
} -->
<?php

include 'connect.php';

// function debug_to_console($data) {
//     $output = $data;
//     if (is_array($output))
//         $output = implode(',', $output);

//     echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
// }





    //     $id = (int)$_GET['deleteid'];
       


    //   $query = "delete from tbl_student where id = $id";

    

    // // $sql = " delete from `tbl_student` where id=$id ";
    // // debug_to_console($sql)
    // $result = mysqli_query($con,$query);

    // if($result){
    //     echo "deleted successfully";
    // }
    // else{
    //     die(mysqli_error($con));
    // }




if(isset($_GET['deleteid'])){

    $id = $_GET['deleteid'];



    $sql = "delete from vehicle_list where id=$id";

    $result = mysqli_query($con,$sql);

    if($result){
        // echo "deleted successfully";
        header('location: display.php');
    }
    else{
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
    <!-- <h1>Testing...</h1> -->
</body>
</html>