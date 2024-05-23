<?php
include('database_connection.php');

// Check if course_id is set
if(isset($_REQUEST['course_id'])) {
    $cid = $_REQUEST['course_id'];
    
    $stmt = $connection->prepare("SELECT * FROM courses WHERE course_id=?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['course_id'];
        $u = $row['instructor_id'];
        $y = $row['title'];
        $z = $row['start_date'];
        $w = $row['end_date'];
        $v = $row['price'];
    } else {
        echo "Course not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Course</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update Course form -->
    <h2><u>Update Form of Course</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="iid">instructor_id:</label>
        <input type="number" name="iid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="tit">title:</label>
        <input type="text" name="tit" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=std>start_date:</label>
        <input type="date" name="std" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="end">end_date:</label>
        <input type="date" name="end" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="prc">price:</label>
        <input type="number" name="prc" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $instructor_id = $_POST['iid'];
    $title = $_POST['tit'];
    $start_date = $_POST['std'];
    $end_date = $_POST['end'];
    $price = $_POST['prc'];
    
    // Update the Courses in the database
    $stmt = $connection->prepare("UPDATE courses SET instructor_id=?, title=?, start_date=?, end_date=?, price=? WHERE course_id=?");
    $stmt->bind_param("isssdi", $instructor_id, $title, $start_date, $end_date, $price, $cid);
    $stmt->execute();
    
    // Redirect to courses.php
    header('Location: courses.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
