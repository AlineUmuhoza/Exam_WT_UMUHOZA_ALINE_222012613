 <?php
include('database_connection.php');

// Check if assignment_id is set
if(isset($_REQUEST['assignment_id'])) {
    $aid = $_REQUEST['assignment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM course_assignments
     WHERE assignment_id=?");
    $stmt->bind_param("i", $aid);
    ?>
    <!DOCTYPE html>
    <html>                                            
    <head>                                      
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="aid" value="<?php echo $aid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){                 
    if ($stmt->execute()) {
        echo "Record deleted successfully.
        <a href='course_assignments.php'>Yes</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "assignment_id is not set.";
}

$connection->close();
?>
