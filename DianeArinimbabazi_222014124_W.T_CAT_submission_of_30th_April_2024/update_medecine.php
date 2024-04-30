<?php
// Include database connection
include('database_connection.php');

// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select inventory data by id
    $stmt = $connection->prepare("SELECT * FROM medecine WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if inventory data is found
    if($result->num_rows > 0) {
        // Fetch inventory data
        $row = $result->fetch_assoc();
        $x = $row['id']; // Store id
        $Y = $row['name']; // Store name
        $Z = $row['manfactrure']; // Store 'manfactrure'
        $W = $row['dosage']; // Store 'dosage'
        $N = $row['price']; // Store 'price'
        $M= $row['quantity']; // Store 'quantity'

    } else {
        echo "medecine not found.";
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
        <label for="name">name:</label>
        <!-- Display medecineId from database -->
        <input type="text" name="name" value="<?php echo isset($Y) ? $Y : ''; ?>">
        <br><br>

        <label for="manfactrure">manfactrure:</label>
        <!-- Display manfactrure from database -->
        <input type="text" name="manfactrure" value="<?php echo isset($Z) ? $Z : ''; ?>">
        <br><br>
        <label for="dosage">dosage:</label>
        <!-- Display dosage from database -->
        <input type="number" name="dosage" value="<?php echo isset($Z) ? $W : ''; ?>">
        <br><br> 

        <label for="price">price:</label>
        <!-- Display price from database -->
        <input type="number" name="price" value="<?php echo isset($Z) ? $N : ''; ?>">
        <br><br>

        <label for="quantity">quantity:</label>
        <!-- Display quantity from database -->
        <input type="number" name="quantity" value="<?php echo isset($Z) ? $M : ''; ?>">
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
    // Retrieve updated values from medecine form
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $dosage = $_POST['dosage'];
    $manfactrure = $_POST['manfactrure'];
    $name = $_POST['name'];
    $id = $_POST['id']; 
    
    // Update the medecine in the database
    $stmt = $connection->prepare("UPDATE medecine SET quantity=?, price=?, dosage=?, manfactrure=?, name=? WHERE id=?");
    $stmt->bind_param("sssssi", $quantity,  $price, $dosage, $manfactrure, $name, $id  );
    $stmt->execute();
    
    // Redirect to medecine.php
    header('Location: medecine.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
