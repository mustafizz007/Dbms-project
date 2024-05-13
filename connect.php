<?php

$con = new mysqli('127.0.0.1:4306' , 'root' ,  '' , 'db_uni');

if ($con){
    // echo "Connection successful";
}

else{
    die(mysqli_error($con));
}


?>