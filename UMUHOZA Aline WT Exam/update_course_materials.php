<?php
include('database_connection.php');

// Check if material_id is set
if (isset($_REQUEST['material_id'])) {
    $mid = $_REQUEST['material_id'];
    
    $stmt = $connection->prepare("SELECT * FROM course_materials WHERE material_id = ?");
    $stmt->bind_param("i", $mid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cid = $row['course_id'];
        $mtype = $row['material_type'];
        $mtitle = $row['material_title'];
    } else {
        echo "Material not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course Material</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update Course Material form -->
    <h2><u>Update Course Material Form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="cid">Course ID:</label>
        <input type="number" id="cid" name="cid" value="<?php echo isset($cid) ? $cid : ''; ?>" required>
        <br><br>

        <label for="mtype">Material Type:</label>
        <input type="text" id="mtype" name="mtype" value="<?php echo isset($mtype) ? $mtype : ''; ?>" required>
        <br><br>

        <label for="mtitle">Material Title:</label>
        <input type="text" id="mtitle" name="mtitle" value="<?php echo isset($mtitle) ? $mtitle : ''; ?>" required>
        <br><br>

        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $course_id = $_POST['cid'];
    $material_type = $_POST['mtype'];
    $material_title = $_POST['mtitle'];
    
    // Update the course materials in the database
    $stmt = $connection->prepare("UPDATE course_materials SET course_id = ?, material_type = ?, material_title = ? WHERE material_id = ?");
    $stmt->bind_param("issi", $course_id, $material_type, $material_title, $mid);
    $stmt->execute();
    
    // Redirect to course_materials.php
    header('Location: course_materials.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
