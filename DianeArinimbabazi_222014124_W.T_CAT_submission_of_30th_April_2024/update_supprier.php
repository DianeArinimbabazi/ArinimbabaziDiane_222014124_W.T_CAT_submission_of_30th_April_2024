<?php
// Include database connection
include('database_connection.php');

// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select supprier data by id
    $stmt = $connection->prepare("SELECT * FROM supprier WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if supprier data is found
    if($result->num_rows > 0) {
        // Fetch supprier data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store 'id'
        $names = $row['names']; // Store 'names'
        $contact = $row['contact']; // Store 'contact'
        $supplied = $row['supplied']; // Store 'supplied'

    } else {
        echo "supprier not found.";
    }
}
?>

<html>
<head>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update supprier form -->
    <form method="POST">
        <label for="names">names:</label>
        <!-- Display names from database -->
        <input type="text" name="names" value="<?php echo isset($names) ? $names : ''; ?>">
        <br><br>

        <label for="contact">contact:</label>
        <!-- Display contact from database -->
        <input type="number" name="contact" value="<?php echo isset($contact) ? $contact : ''; ?>">
        <br><br>

        <label for="supplied">supplied:</label>
        <!-- Display supplied from database -->
        <input type="number" name="supplied" value="<?php echo isset($supplied) ? $supplied : ''; ?>">
        <br><br>

        <!-- Hidden input field to store id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <!-- Submit button to update inventory -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from supprier form
    $supplied = $_POST['supplied'];
    $contact = $_POST['contact'];
    $names = $_POST['names'];
    $id = $_POST['id']; 
    
    // Update the supprier in the database
    $stmt = $connection->prepare("UPDATE supprier SET supplied=?, contact=?, names=? WHERE id=?");
    $stmt->bind_param("sssi", $supplied, $contact, $names, $id);
    $stmt->execute();
    
    // Redirect to supprier.php
    header('Location: supprier.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
