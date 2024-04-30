<?php
// Include database connection
include('database_connection.php');

// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select inventory data by id
    $stmt = $connection->prepare("SELECT * FROM inventory WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if inventory data is found
    if($result->num_rows > 0) {
        // Fetch inventory data
        $row = $result->fetch_assoc();
        $x = $row['id']; // Store id
        $Y = $row['medecineId']; // Store medecineId
        $Z = $row['quantiyAvaliable']; // Store quantityAvaliable

    } else {
        echo "Inventory not found.";
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
    <!-- Update inventory form -->
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="medecineId">medecineId:</label>
        <!-- Display medecineId from database -->
        <input type="number" name="medecineId" value="<?php echo isset($Y) ? $Y : ''; ?>">
        <br><br>

        <label for="quantityAvaliable">quantityAvaliable:</label>
        <!-- Display quantityAvaliable from database -->
        <input type="number" name="quantityAvaliable" value="<?php echo isset($Z) ? $Z : ''; ?>">
        <br><br>

        <!-- Hidden input field to store id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <!-- Submit button to update inventory -->
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from inventory form
    $quantityAvaliable = $_POST['quantityAvaliable'];
    $medecineId = $_POST['medecineId'];
    $id = $_POST['id'];
    
    // Update the inventory in the database
    $stmt = $connection->prepare("UPDATE inventory SET quantiyAvaliable=?, medecineId=? WHERE id=?");
    $stmt->bind_param("ssi", $quantityAvaliable, $medecineId, $id);
    $stmt->execute();
    
    // Redirect to inventory.php
    header('Location: inventory.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
