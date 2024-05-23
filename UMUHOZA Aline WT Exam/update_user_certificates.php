<?php
include('database_connection.php');

// Check if certificate_id is set
if(isset($_REQUEST['certificate_id'])) {
    $ceid = $_REQUEST['certificate_id'];
    
    $stmt = $connection->prepare("SELECT * FROM user_certificates WHERE certificate_id=?");
    $stmt->bind_param("i", $ceid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['certificate_id'];
        $u = $row['id'];                               
        $y = $row['course_id'];
        $z = $row['issue_date'];
    } else {
        echo "Certificate not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in user_certificates</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update user_certificates form -->
    <h2><u>Update Form of user_certificates</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="cid">course_id:</label>
        <input type="number" name="cid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=isd>issue_date:</label>
        <input type="text" name="isd" value="<?php echo isset($z) ? $z : ''; ?>">
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
    $issue_date = $_POST['isd'];
    
    // Update the user_certificates in the database
    $stmt = $connection->prepare("UPDATE user_certificates SET id=?, course_id=?, issue_date=? WHERE certificate_id=?");
    $stmt->bind_param("iisi", $id, $course_id, $issue_date, $ceid);
    $stmt->execute();
    
    // Redirect to user_certificates.php
    header('Location: user_certificates.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
