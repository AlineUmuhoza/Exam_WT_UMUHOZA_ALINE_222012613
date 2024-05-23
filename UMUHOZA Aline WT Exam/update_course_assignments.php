<?php
include('database_connection.php');

// Check if assignment_id is set
if(isset($_REQUEST['assignment_id'])) {
    $aid = $_REQUEST['assignment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM course_assignments WHERE assignment_id=?");
    $stmt->bind_param("i", $aid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();     
        $x = $row['assignment_id'];
        $u = $row['id'];
        $y = $row['course_id'];                
        $z = $row['assignment_title'];
        $w = $row['assignment_marks'];
    } else {
        echo "Assignment not found.";
    }
}
?>
                             
<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Assignment table</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>                                  
<body>
    <!-- Update course_assignments form -->
    <h2><u>Update Form of course_assignments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="cid">course_id:</label>
        <input type="number" name="cid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=ast>assignment_title:</label>
        <input type="text" name="ast" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="asm">assignment_marks:</label>
        <input type="text" name="asm" value="<?php echo isset($w) ? $w : ''; ?>">
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
    $assignment_title = $_POST['ast'];         
    $assignment_marks = $_POST['asm'];
    
    // Update the course_assignments in the database
    $stmt = $connection->prepare("UPDATE course_assignments SET id=?, course_id=?, assignment_title=?, assignment_marks=? WHERE assignment_id=?");
    $stmt->bind_param("iissi", $id, $course_id, $assignment_title, $assignment_marks, $aid);
    $stmt->execute();
    
    // Redirect to course_assignments.php
    header('Location: course_assignments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
