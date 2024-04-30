<?php
// Include database connection
include('database_connection.php');

// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select sales data by id
    $stmt = $connection->prepare("SELECT * FROM sales WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if sales data is found
    if($result->num_rows > 0) {
        // Fetch sales data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store id
        $names = $row['medecine']; // Store 'medecine'
        $address = $row['quantity']; // Store 'quantity'
        $contact = $row['amaount']; // Store 'amaount'
        $insurance = $row['Date']; // Store 'Date'

    } else {
        echo "sales not found.";
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
    <!-- Update sales form -->
    <form method="POST">
        <label for="medecine">medecine:</label>
        <!-- Display medecine from database -->
        <input type="number" name="medecine" value="<?php echo isset($names) ? $names : ''; ?>">
        <br><br>
        <label for="quantity">quantity:</label>
        <!-- Display quantity from database -->
        <input type="number" name="quantity" value="<?php echo isset($address) ? $address : ''; ?>">
        <br><br> 

        <label for="amaount">amaount:</label>
        <!-- Display amaount from database -->
        <input type="number" name="amaount" value="<?php echo isset($contact) ? $contact : ''; ?>">
        <br><br>

        <label for="Date">Date:</label>
        <!-- Display Datefrom database -->
        <input type="Date" name="Date" value="<?php echo isset($insurance) ? $insurance : ''; ?>">
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
    // Retrieve updated values from patients form
    $Date = $_POST['Date'];
    $amaount = $_POST['amaount'];
    $quantity = $_POST['quantity'];
    $medecine = $_POST['medecine'];
    $id = $_POST['id']; 
    
    // Update the sales in the database
    $stmt = $connection->prepare("UPDATE sales SET Date=?, amaount=?, quantity=?, medecine=? WHERE id=?");
    $stmt->bind_param("ssssi", $Date, $amaount, $quantity, $medecine, $id);
    $stmt->execute();
    
    // Redirect to sales.php
    header('Location: sales.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>

