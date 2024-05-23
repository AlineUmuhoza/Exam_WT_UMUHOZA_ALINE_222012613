<?php
include('database_connection.php');

// Check if certificate_id is set
if(isset($_REQUEST['certificate_id'])) {
    $ceid = $_REQUEST['certificate_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM user_certificates WHERE certificate_id=?");
    $stmt->bind_param("i", $ceid);
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
            <input type="hidden" name="ceid" value="<?php echo $ceid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($stmt->execute()) {
        echo "Record deleted successfully.;
        <a href='user_certificates.php'>Yes</a>";
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
    echo "certificate_id is not set.";
}

$connection->close();
?>
