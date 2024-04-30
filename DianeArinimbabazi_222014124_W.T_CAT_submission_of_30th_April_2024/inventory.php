<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inventory Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color:black;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: beige;
    }

    /* Unvisited link */
    a:link {
      color: beige;
    }

    /* Hover effect */
    a:hover {
      background-color: beige;
    }

    /* Active link */
    a:active {
      background-color: burlywood;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px;
      margin-top: 4px;
    }

    input.form-control {
      margin-left: 500px;
      padding: 8px;
    }

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

    /* Header style */
    header {
      background-color: beige;
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body style="background-image: url('./Images/image10.png');background-repeat: no-repeat;background-size:cover;">
  <header>
    <h1>INVENTORY</h1>
  </header>
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./Images/image12.png" width="90" height="60" alt="Logo">
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./Supprier.php">SUPPRIER</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./Sales.php">SALES</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./Patients.php">PATIENTS</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./Medecine.php">MEDECINE</a></li>
      <li style="display: inline; margin-right: 10px;"><a href="./Inventory.php">INVENTORY</a></li>
  </li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color:darkgreen; background-color: beige; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Change Acount</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>
  <h1>Inventory Form</h1>
  <form method="post" onsubmit="return confirm('Are you sure you want to insert this record?');">
    <label for="id">Id:</label>
    <input type="number" id="id" name="id"><br><br>

    <label for="medicineId">medicineId:</label>
    <input type="number" id="medicineId" name="medicineId" required><br><br>

    <label for="quantityAvaliable">quantityAvaliable:</label>
    <input type="number" id="quantityAvaliable" name="quantityAvaliable" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br>

    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
    include('database_connection.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters with appropriate data types
        $stmt = $connection->prepare("INSERT INTO Inventory (id, medecineId, quantiyAvaliable) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id, $MedicineID , $QuantityAvaliable);

        // Set parameters from POST data with validation (optional)
        $id = intval($_POST['id']); // Ensure integer for id
        $MedicineID= htmlspecialchars($_POST['medicineId']); // Prevent XSS
        $QuantityAvaliable= htmlspecialchars($_POST['quantityAvaliable']); // Prevent XSS

        // Execute prepared statement with error handling
        if ($stmt->execute()) {
            echo "New record has been added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $connection->close();
  ?>

  <h2>Inventory Table</h2>
  <table border="2">
    <tr>
      <th>Id</th>
      <th>MedicineId</th>
      <th>quantityAvaliable</th>
      <th>DELETE</th>
      <th>UPDATE</th>
    </tr>
    <?php
      include('database_connection.php');

      $sql = "SELECT * FROM Inventory";
      $result = $connection->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $invid = $row['id'];
              echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['medecineId'] . "</td>
                <td>" . $row['quantiyAvaliable'] . "</td>

                <td><a style='padding:4px' href='Delete_inventory.php?id=$invid'>Delete</a></td> 
                <td><a style='padding:4px' href='update_Inventory.php?id=$invid'>Update</a></td> 
              </tr>";
          }
      } else {
          echo "<tr><td colspan='7'>No data found</td></tr>";
      }

      $connection->close();
    ?>
  </table>
</section>
<footer>
    <center> 
      <b><h2>UR CBE BIT &copy 2024 Designed by: @Diane ARINIMBABAZI</h2></b>
    </center>
  </footer>

</body>
</html>
