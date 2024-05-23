<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>user_progress</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: skyblue;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
      
    }
    header{
    background-color:orange;
}
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:orange;
    }

  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  </head>

  <header>

<body bgcolor="pink">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./images/LOGO.png" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>   
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Service.html">SERVICE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./instructors.php">INSTRUCTORS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./courses.php">COURSES</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./enrollments.php">ENROLLMENTS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./product_management_resources.php">PRODUCT_MANAGEMENT_RESOURCES</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./user_progress.php">USER PROGRESS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./course_materials.php">COURSE_MATERIALS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./user_certificates.php">USER_CERTIFICATE</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./user_payments.php">USER_PAYMENTS</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./course_assignments.php">COURSES_ASSIGNMENTS</a>
  </li>
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Other Account</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>

    <h1><u> user_progress Form </u></h1>
    <form method="post" onsubmit="return confirmInsert();">
            
        <label for="prid">progress_id:</label>
        <input type="number" id="prid" name="prid"><br><br>

        <label for="uid">id:</label>
        <input type="number" id="uid" name="uid"><br><br>

        <label for="cid">course_id:</label>
        <input type="number" id="cid" name="cid" required><br><br>

        <label for=cst>completion_status:</label>
        <input type="text" id="cst" name="cst" required><br><br>

        <label for="cdt">completion_date:</label>
        <input type="date" id="cdt" name="cdt" required><br><br>

        <input type="submit" name="add" value="Insert">
      

    </form>


<?php
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO user_progress(progress_id, id, course_id , completion_status, completion_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiss", $prid, $uid, $cid, $cst, $cdt);
    // Set parameters and execute
    $prid = $_POST['prid'];
    $uid = $_POST['uid'];
    $cid = $_POST['cid'];
    $cst = $_POST['cst'];
    $cdt = $_POST['cdt'];
    
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<?php
include('database_connection.php');

// SQL query to fetch data from the user_progress table
$sql = "SELECT * FROM user_progress";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of USER PROGRESS</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of user_progress</h2></center>
    <table border="5">
        <tr>
            <th>progress_id</th>
            <th>user_id</th>
            <th>course_id</th>
            <th>completion_status</th>
            <th>completion_date</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
     include('database_connection.php');

        // Prepare SQL query to retrieve all user_progress
        $sql = "SELECT * FROM user_progress";
        $result = $connection->query($sql);

        // Check if there are any user_progress
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $prid = $row['progress_id']; // Fetch the progress_id
                echo "<tr>
                    <td>" . $row['progress_id'] . "</td>
                    <td>" . $row['id'] . "</td>    
                    <td>" . $row['course_id'] . "</td>
                    <td>" . $row['completion_status'] . "</td>
                    <td>" . $row['completion_date'] . "</td>
                    <td><a style='padding:4px' href='delete_user_progress.php?progress_id=$prid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_user_progress.php?progress_id=$prid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <marquee behavior='alternate'>
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Aline UMUHOZA</h2></b>
  </marquee>
  </center>
</footer>
</body>
</html>