<?php
include('database_connection.php');

// Check if enrollment_id is set
if(isset($_REQUEST['enrollment_id'])) {
    $eid = $_REQUEST['enrollment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM enrollments WHERE enrollment_id=?");
    $stmt->bind_param("i", $eid);
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
            <input type="hidden" name="eid" value="<?php echo $eid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($stmt->execute()) {
        echo "Record deleted successfully.
        <a href='enrollments.php'>Yes</a>";         
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
    echo "enrollment_id is not set.";
}

$connection->close();
?>
