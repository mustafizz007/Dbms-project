<?php
include 'connect.php';

// Function to check if all issues for a vehicle are fixed
function areAllIssuesFixed($con, $vehicle_id) {
    $sql_issues = "SELECT * FROM issues WHERE vehicle_id = $vehicle_id AND status = 0";
    $result_issues = mysqli_query($con, $sql_issues);
    return mysqli_num_rows($result_issues) === 0;
}

// Get the vehicle ID from the URL parameter
$vehicle_id = isset($_GET['v_id']) ? intval($_GET['v_id']) : 0;

// Retrieve the vehicle details
$sql_vehicle = "SELECT * FROM vehicle_list WHERE id = $vehicle_id";
$result_vehicle = mysqli_query($con, $sql_vehicle);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .text-success { color: green; }
        .text-danger { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Vehicle Details</h2>
        <a href="display.php" class="btn btn-primary">Home</a>
        <?php
        if ($result_vehicle && mysqli_num_rows($result_vehicle) > 0) {
            $vehicle = mysqli_fetch_assoc($result_vehicle);
        ?>
            <table class="table table-bordered">
                <tr>
                    <th>Vehicle ID</th>
                    <td><?php echo $vehicle['id']; ?></td>
                </tr>
                <tr>
                    <th>Owner Name</th>
                    <td><?php echo $vehicle['o_name']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $vehicle['o_email']; ?></td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td><?php echo $vehicle['o_mobile']; ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo $vehicle['o_address']; ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <?php if ($vehicle['o_status'] == 1): ?>
                            <span class="text-success">Ready</span>
                        <?php else: ?>
                            <span class="text-danger">Not Ready</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <h2>Add Issue</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="issue_description" class="form-label">Issue Description</label>
                    <textarea class="form-control" id="issue_description" name="issue_description" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Issue</button>
            </form>

            <?php
            // Retrieve the issues related to the vehicle
            $sql_issues = "SELECT * FROM issues WHERE vehicle_id = $vehicle_id";
            $result_issues = mysqli_query($con, $sql_issues);

            if ($result_issues && mysqli_num_rows($result_issues) > 0) {
            ?>
                <h2>Issues</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Issue Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($issue = mysqli_fetch_assoc($result_issues)) {
                            echo "<tr>";
                            echo "<td>{$issue['issue_description']}</td>";
                            echo "<td>";
                            echo $issue['status'] == 1 ? '<span class="text-success">✓</span>' : '<span class="text-danger">✗</span>';
                            echo "</td>";
                            echo "<td>";
                            echo "<form action='' method='POST' style='display: inline;'>";
                            echo "<input type='hidden' name='issue_id' value='{$issue['issue_id']}' />";
                            echo "<button type='submit' name='delete_issue' class='btn btn-sm btn-danger'>Delete</button>";
                            echo "</form>";
                            // Add Mark as Fixed button
                            if ($issue['status'] == 0) {
                                echo "<form action='' method='POST' style='display: inline;'>";
                                echo "<input type='hidden' name='issue_id' value='{$issue['issue_id']}' />";
                                echo "<button type='submit' name='mark_fixed' class='btn btn-sm btn-primary'>Mark as Fixed</button>";
                                echo "</form>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "<p>No issues found for this vehicle.</p>";
            }
            ?>
        <?php
        } else {
            echo "<p>No vehicle found with the specified ID.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
// Handle form submission to add issues
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["issue_description"])) {
    $issue_description = mysqli_real_escape_string($con, $_POST["issue_description"]);
    $sql_insert_issue = "INSERT INTO issues (vehicle_id, issue_description, status) VALUES ($vehicle_id, '$issue_description', 0)";
    $result_insert_issue = mysqli_query($con, $sql_insert_issue);
    if ($result_insert_issue) {
        echo "<p>Issue added successfully!</p>";
    } else {
        echo "<p>Failed to add issue. Please try again: " . mysqli_error($con) . "</p>";
    }
}

?>

<?php
// Handle form submission to delete an issue
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_issue"])) {
    $issue_id = intval($_POST["issue_id"]);
    $sql_delete_issue = "DELETE FROM issues WHERE issue_id = $issue_id";
    $result_delete_issue = mysqli_query($con, $sql_delete_issue);
    if ($result_delete_issue) {
        // Issue deleted successfully
    } else {
        echo "<p>Failed to delete issue. Please try again: " . mysqli_error($con) . "</p>";
    }
}
?>

<?php
// Handle form submission to mark an issue as fixed
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mark_fixed"])) {
    $issue_id = intval($_POST["issue_id"]);
    $sql_mark_fixed = "UPDATE issues SET status = 1 WHERE issue_id = $issue_id";
    $result_mark_fixed = mysqli_query($con, $sql_mark_fixed);
    if ($result_mark_fixed) {
        if (areAllIssuesFixed($con, $vehicle_id)) {
            $sql_update_status = "UPDATE vehicle_list SET o_status = 1 WHERE id = $vehicle_id";
            $result_update_status = mysqli_query($con, $sql_update_status);
            if (!$result_update_status) {
                echo "<p>Failed to update vehicle status. Please try again: " . mysqli_error($con) . "</p>";
            }
        }
    } else {
        echo "<p>Failed to mark issue as fixed. Please try again: " . mysqli_error($con) . "</p>";
    }
}
?>
