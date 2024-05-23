<?php
include('database_connection.php');

// Check if payment_id is set
if(isset($_REQUEST['payment_id'])) {
    $paid = $_REQUEST['payment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM user_payments WHERE payment_id=?");
    $stmt->bind_param("i", $paid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();     
        $x = $row['payment_id'];
        $u = $row['id'];
        $y = $row['course_id'];                
        $z = $row['amount'];
        $w = $row['payment_date'];
    } else {
        echo "Payment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in Payment table</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>                                  
<body>
    <!-- Update user_payments form -->
    <h2><u>Update Form of user_payments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="cid">course_id:</label>
        <input type="number" name="cid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=amnt>amount:</label>
        <input type="text" name="amnt" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="pdt">payment_date:</label>
        <input type="date" name="pdt" value="<?php echo isset($w) ? $w : ''; ?>">
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
    $amount = $_POST['amnt'];         
    $payment_date = $_POST['pdt'];
    
    // Update the user_payments in the database
    $stmt = $connection->prepare("UPDATE user_payments SET id=?, course_id=?, amount=?, payment_date=? WHERE payment_id=?");
    $stmt->bind_param("iissi", $id, $course_id, $amount, $payment_date, $paid);
    $stmt->execute();
    
    // Redirect to user_payments.php
    header('Location: user_payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
