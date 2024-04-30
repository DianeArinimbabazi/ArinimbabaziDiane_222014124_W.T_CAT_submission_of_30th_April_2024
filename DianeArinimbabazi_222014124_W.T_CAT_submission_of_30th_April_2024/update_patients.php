<?php
// Include database connection
include('database_connection.php');

// Check if id is set in the request
if(isset($_REQUEST['id'])) {
    // Get id from the request
    $id = $_REQUEST['id'];
    
    // Prepare and execute SQL query to select patients data by id
    $stmt = $connection->prepare("SELECT * FROM patients WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if patients data is found
    if($result->num_rows > 0) {
        // Fetch patients data
        $row = $result->fetch_assoc();
        $id = $row['id']; // Store id
        $names = $row['names']; // Store 'names'
        $address = $row['address']; // Store 'address'
        $contact = $row['contact']; // Store 'contact'
        $insurance = $row['insurance']; // Store 'insurance'

    } else {
        echo "patients not found.";
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
    <!-- Update patients form -->
    <form method="POST">
        <label for="names">names:</label>
        <!-- Display names from database -->
        <input type="text" name="names" value="<?php echo isset($names) ? $names : ''; ?>">
        <br><br>
        <label for="address">address:</label>
        <!-- Display address from database -->
        <input type="text" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
        <br><br> 

        <label for="contact">contact:</label>
        <!-- Display contact from database -->
        <input type="number" name="contact" value="<?php echo isset($contact) ? $contact : ''; ?>">
        <br><br>

        <label for="insurance">insurance:</label>
        <!-- Display insurance from database -->
        <input type="text" name="insurance" value="<?php echo isset($insurance) ? $insurance : ''; ?>">
        <br><br>

        <!-- Hidden input field to store id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
        <!-- Submit button to update patients -->
        <input type="submit" name="up" value="Update" onclick="return confirmUpdate();">
    </form>
</body>
</html>

<?php
// Check if update button is clicked
if(isset($_POST['up'])) {
    // Retrieve updated values from patients form
    $insurance = $_POST['insurance'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $names = $_POST['names'];
    $id = $_POST['id']; 
    
    // Update the patients in the database
    $stmt = $connection->prepare("UPDATE patients SET insurance=?, contact=?, address=?, names=? WHERE id=?");
    $stmt->bind_param("ssssi", $insurance, $contact, $address, $names, $id);
    $stmt->execute();
    
    // Redirect to patients.php
    header('Location: patients.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>


