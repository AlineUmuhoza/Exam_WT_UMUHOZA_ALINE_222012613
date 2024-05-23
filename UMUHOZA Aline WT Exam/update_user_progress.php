<?php
include('database_connection.php');

// Check if progress_id is set
if(isset($_REQUEST['progress_id'])) {
    $prid = $_REQUEST['progress_id'];
    
    $stmt = $connection->prepare("SELECT * FROM user_progress WHERE progress_id=?");
    $stmt->bind_param("i", $prid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['progress_id'];
        $u = $row['id'];
        $y = $row['course_id'];                
        $z = $row['completion_status'];
        $w = $row['completion_date'];
    } else {
        echo "Progress not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Progress table</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>                                  
<body>
    <!-- Update customer form -->
    <h2><u>Update Form of Customer</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="cid">course_id:</label>
        <input type="number" name="cid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=cst>completion_status:</label>
        <input type="text" name="cst" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="cdt">completion_date:</label>
        <input type="date" name="cdt" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['uid'];
    $course_id = $_POST['cid'];
    $completion_status = $_POST['cst'];         
    $completion_date = $_POST['cdt'];
    
    // Update the user_progress in the database
    $stmt = $connection->prepare("UPDATE user_progress SET id=?, course_id=?, completion_status=?, completion_date=? WHERE progress_id=?");
    $stmt->bind_param("iissi", $id, $course_id, $completion_status, $completion_date, $prid);
    $stmt->execute();
    
    // Redirect to user_progress.php
    header('Location: user_progress.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
