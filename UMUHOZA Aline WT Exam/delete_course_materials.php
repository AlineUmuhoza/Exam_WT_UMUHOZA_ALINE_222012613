<?php
include('database_connection.php');

// Check if material_id is set
if(isset($_REQUEST['material_id'])) {
    $mid = $_REQUEST['material_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM course_materials WHERE material_id=?");
    $stmt->bind_param("i", $mid);
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
            <input type="hidden" name="Pid" value="<?php echo $mid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($stmt->execute()) {
        echo "Record deleted successfully.;
        <a href='course_materials.php'>Yes</a>";
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
    echo "material_id is not set.";
}

$connection->close();
?>
