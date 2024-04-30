<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patients Page</title>
  <style>
    /* CSS styles for the page */
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
<body style="background-image: url('./Images/image20.png');background-repeat: no-repeat;background-size:cover;">
  <!-- Header section -->
  <header>
    <h1>PATIENTS</h1>
  </header>
  <!-- Search form -->
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <!-- Navigation menu -->
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./Images/image12.png" width="90" height="60" alt="Logo">
    </li>
    <!-- Navigation links -->
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Supprier.php">SUPPRIER</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Sales.php">SALES</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Patients.php">PATIENTS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Medecine.php">MEDECINE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Inventory.php">INVENTORY</a></li>
  </ul>

  <!-- Main content section -->
  <section>
    <!-- Patients Form -->
    <h1>Patients Form</h1>
    <form method="post" onsubmit="return confirm('Are you sure you want to insert this record?');">
      <label for="id">id:</label>
      <input type="number" id="id" name="id"><br><br>

      <label for="names">names:</label>
      <input type="text" id="names" name="names" required><br><br>

      <label for="address">address:</label>
      <input type="text" id="address" name="address" required><br><br>

      <label for="contact">contact:</label>
      <input type="number" id="contact" name="contact"><br><br>

      <label for="insurance">insurance:</label>
      <input type="text" id="insurance" name="insurance"><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>

    <!-- PHP code to insert data into database -->
    <?php
      include('database_connection.php');

      // Check if the form is submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Prepare and bind parameters with appropriate data types
          $stmt = $connection->prepare("INSERT INTO patients (id, names, address, contact, insurance) VALUES (?, ?, ?, ?, ?)");
          $stmt->bind_param("issss", $id, $names , $address, $contact, $insurance);

          // Set parameters from POST data with validation (optional)
          $id = intval($_POST['id']); // Ensure integer for id
          $names= htmlspecialchars($_POST['names']); // Prevent XSS
          $address= htmlspecialchars($_POST['address']); // Prevent XSS
          $contact= htmlspecialchars($_POST['contact']); // Prevent XSS
          $insurance= htmlspecialchars($_POST['insurance']); // Prevent XSS

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

    <!-- Patients Table -->
    <h2>Patients Table</h2>
    <table border="2">
      <tr>
        <th>id</th>
        <th>names</th>
        <th>address</th>
        <th>contact</th>
        <th>insurance</th>
        <th>DELETE</th>
        <th>UPDATE</th>
      </tr>
      <?php
        include('database_connection.php');

        $sql = "SELECT * FROM patients";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                echo "<tr>
                  <td>" . $row['id'] . "</td>
                  <td>" . $row['names'] . "</td>
                  <td>" . $row['address'] . "</td>
                  <td>" . $row['contact'] . "</td>
                  <td>" . $row['insurance'] . "</td>

                  <td><a style='padding:4px' href='Delete_patients.php?id=$id'>Delete</a></td> 
                  <td><a style='padding:4px' href='update_patients.php?id=$id'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }

        $connection->close();
      ?>
    </table>
  </section>
  <!-- Footer section -->
  <footer>
    <center> 
      <b><h2>UR CBE BIT &copy 2024 Designed by: @Diane ARINIMBABAZI</h2></b>
    </center>
  </footer>
</body>
</html>
