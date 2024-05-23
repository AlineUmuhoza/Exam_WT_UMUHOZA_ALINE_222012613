<?php
include('database_connection.php');

// Check if Account_Id is set
if(isset($_REQUEST['instructor_id'])) {
    $iid = $_REQUEST['instructor_id'];
    
    $stmt = $connection->prepare("SELECT * FROM instructors WHERE instructor_id=?");
    $stmt->bind_param("i", $iid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['instructor_id'];
        $u = $row['id'];                                               
        $y = $row['bio'];
        $z = $row['expertise_area'];
    } else {
        echo "instructor not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Instructors</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update Instructors form -->
    <h2><u>Update Form of Instructors</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="bi">bio:</label>
        <input type="text" name="bi" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="exp">expertise_area:</label>
        <input type="text" name="exp" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['uid'];
    $bio = $_POST['bi'];
    $expertise_area = $_POST['exp'];
    
    // Update the Instructors in the database
    $stmt = $connection->prepare("UPDATE instructors SET id=?, bio=?, expertise_area=? WHERE instructor_id=?");
    $stmt->bind_param("issi", $id, $bio, $expertise_area, $iid);
    $stmt->execute();
    
    // Redirect to instructors.php
    header('Location: instructors.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
