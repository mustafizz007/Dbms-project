<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage information</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .not-ready-btn {
            background-color: red;
            color: white;
        }

        .ready-btn {
            background-color: green;
            color: white;
        }
    </style>

</head>
<body>
    <div class="container">
        <button class="btn btn-primary my-5"> <a href="user.php" class="text-light">Add Vehicle</a> </button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Vehicle id</th>
                    <th scope="col">Owner Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Address</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM vehicle_list";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $v_id = $row['v_id'];
                        $o_name = $row['o_name'];
                        $o_email = $row['o_email'];
                        $o_mobile = $row['o_mobile'];
                        $o_address = $row['o_address'];
                        $o_status = $row['o_status'];

                        $buttonClass = ($o_status == 0) ? 'not-ready-btn' : 'ready-btn';
                        $buttonText = ($o_status == 0) ? 'Not Ready' : 'Ready';

                        echo '<tr>
                            <th scope="row">' . $id . '</th>
                            <td><a href="details.php?v_id=' . $id . '">' . $v_id . '</a></td>
                            <td>' . $o_name . '</td>
                            <td>' . $o_email . '</td>
                            <td>' . $o_mobile . '</td>  
                            <td>' . $o_address . '</td>
                            <td><button class="btn ' . $buttonClass . '">' . $buttonText . '</button></td>
                            <td>
                                <button class="btn btn-primary"><a href="update.php?updateid=' . $id . '" class="text-light">Update</a></button>
                                <button class="btn btn-danger"><a href="delete.php?deleteid=' . $id . '" class="text-light">Delete</a></button>  
                            </td>
                        </tr>';
                    }
                } else {
                    echo "<tr><td colspan='8'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
