<?php
// Include the database connection file
include('database_connection.php');

// Check if 'id' is set in the request
if(isset($_REQUEST['id'])) {
    // Get the 'id' value from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM patients WHERE id=?");
    $stmt->bind_param("i", $id); // Bind the 'id' parameter
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            // JavaScript function to confirm deletion
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <!-- Form to confirm deletion -->
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Delete">
        </form>
        <?php
        // Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Execute the DELETE statement
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br>";
                echo "<a href='patients.php'>OK</a>"; // Link to return to patients page
            } else {
                echo "Error deleting data: " . $stmt->error; // Display error message
            }
        }
        ?>
    </body>
    </html>
    <?php
    $stmt->close(); // Close the prepared statement
} else {
    echo "id is not set."; // Display message if 'id' is not set in the request
}

$connection->close(); // Close the database connection
?>
