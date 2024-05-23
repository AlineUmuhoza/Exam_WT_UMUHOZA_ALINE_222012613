<?php
include('database_connection.php');

// Check if enrollment_id is set
if(isset($_REQUEST['enrollment_id'])) {
    $eid = $_REQUEST['enrollment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM enrollments WHERE enrollment_id=?");
    $stmt->bind_param("i", $eid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['enrollment_id'];
        $u = $row['id'];
        $y = $row['course_id'];        
        $z = $row['enrollment_date'];
    } else {
        echo "enrollment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Enrollments</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update Enrollments form -->
    <h2><u>Update Form of Enrollments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="cid">course_id:</label>
        <input type="number" name="cid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=enrd>enrollment_date:</label>
        <input type="date" name="enrd" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from Enrollments form
    $id = $_POST['uid'];
    $course_id = $_POST['cid'];
    $enrollment_date = $_POST['enrd'];
    
    // Update the Enrollments in the database
    $stmt = $connection->prepare("UPDATE enrollments SET id=?, course_id=?, enrollment_date=? WHERE enrollment_id=?");
    $stmt->bind_param("iisi", $id, $course_id, $enrollment_date, $eid);
    $stmt->execute();
    
    // Redirect to enrollments.php
    header('Location: enrollments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
