<?php
include('database_connection.php');

// Check if resource_id is set
if(isset($_REQUEST['resource_id'])) {
    $rid = $_REQUEST['resource_id'];
    
    $stmt = $connection->prepare("SELECT * FROM product_management_resources WHERE resource_id=?");
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['resource_id'];
        $u = $row['id'];
        $y = $row['title'];
        $z = $row['description'];
        $w = $row['created_date'];
    } else {
        echo "Resource not found.";   
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Product_Management_Resources</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update Product_Management_Resources form -->
    <h2><u>Update Form of Product_Management_Resources</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="TIT">title:</label>
        <input type="text" name="TIT" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=decrp>description:</label>
        <input type="text" name="decrp" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="crd">created_date:</label>
        <input type="date" name="crd" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>                                                   

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from Product_Management_Resources form
    $id = $_POST['uid'];
    $title = $_POST['TIT'];
    $description = $_POST['decrp'];
    $created_date = $_POST['crd'];
    
    // Update the Product_Management_Resources in the database
    $stmt = $connection->prepare("UPDATE product_management_resources SET id=?, title=?, description=?, created_date=?  WHERE resource_id=?");
    $stmt->bind_param("isssi", $id, $title, $description, $created_date, $rid);
    $stmt->execute();
    
    // Redirect to Product_Management_Resources.php
    header('Location: product_management_resources.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
