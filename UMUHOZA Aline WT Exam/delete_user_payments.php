 <?php
include('database_connection.php');

// Check if payment_id is set
if(isset($_REQUEST['payment_id'])) {
    $paid = $_REQUEST['payment_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM user_payments
     WHERE payment_id=?");
    $stmt->bind_param("i", $paid);
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
            <input type="hidden" name="paid" value="<?php echo $paid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){                 
    if ($stmt->execute()) {
        echo "Record deleted successfully.
        <a href='user_payments.php'>Yes</a>";
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
    echo "payment_id is not set.";
}

$connection->close();
?>
