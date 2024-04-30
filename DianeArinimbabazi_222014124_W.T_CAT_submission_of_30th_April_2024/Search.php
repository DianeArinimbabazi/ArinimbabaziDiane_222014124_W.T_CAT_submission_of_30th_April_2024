<?php
include('database_connection.php');

// Check if the query parameter is set
if (isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'supprier' => "SELECT names FROM supprier WHERE names LIKE '%$searchTerm%'",
        'sales' => "SELECT medecine FROM sales WHERE medecine LIKE '%$searchTerm%'",
        'patients' => "SELECT names FROM patients WHERE names LIKE '%$searchTerm%'",
        'medecine' => "SELECT manfactrure FROM medecine WHERE manfactrure LIKE '%$searchTerm%'",
        'inventory' => "SELECT id FROM inventory WHERE id LIKE '%$searchTerm%'",
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


