 <?php
include('database_connection.php');

// Check if progress_id is set
if(isset($_REQUEST['progress_id'])) {
    $prid = $_REQUEST['progress_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM user_progress
     WHERE progress_id=?");
    $stmt->bind_param("i", $prid);
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
            <input type="hidden" name="prid" value="<?php echo $prid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){                 
    if ($stmt->execute()) {
        echo "Record deleted successfully.
        <a href='user_progress.php'>Yes</a>";
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
    echo "progress_id is not set.";
}

$connection->close();
?>
