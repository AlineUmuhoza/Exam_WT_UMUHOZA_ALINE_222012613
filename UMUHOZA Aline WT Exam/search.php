<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
    include('database_connection.php');

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'instructors' => "SELECT expertise_area FROM instructors WHERE expertise_area LIKE '%$searchTerm%'",
        'courses' => "SELECT title FROM courses WHERE title LIKE '%$searchTerm%'",
        'enrollments' => "SELECT enrollment_date FROM enrollments WHERE enrollment_date LIKE '%$searchTerm%'",
        'product_management_resources' => "SELECT description FROM product_management_resources WHERE description LIKE '%$searchTerm%'",
        'user_progress' => "SELECT completion_status FROM user_progress WHERE completion_status LIKE '%$searchTerm%'",
        'course_materials' => "SELECT material_type FROM course_materials WHERE material_type LIKE '%$searchTerm%'",
        'user_certificates' => "SELECT issue_date FROM user_certificates WHERE issue_date LIKE '%$searchTerm%'",
        'user_payments' => "SELECT amount FROM user_payments WHERE amount LIKE '%$searchTerm%'",
        'course_assignments' => "SELECT assignment_title FROM course_assignments WHERE assignment_title LIKE '%$searchTerm%'"
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
