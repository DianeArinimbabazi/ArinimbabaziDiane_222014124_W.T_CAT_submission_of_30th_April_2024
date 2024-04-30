<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Medicine Page</title>
  <style>
    /* Styles for links */
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

    /* Hover effect for links */
    a:hover {
      background-color: beige;
    }

    /* Active link */
    a:active {
      background-color: burlywood;
    }

    /* Styles for buttons */
    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px;
      margin-top: 4px;
    }

    /* Styles for form inputs */
    input.form-control {
      margin-left: 500px;
      padding: 8px;
    }

    /* Styles for table */
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
<body style="background-image: url('./Images/image15.png');background-repeat: no-repeat;background-size:cover;">
  <!-- Header -->
  <header>
    <h1>MEDECINE</h1>
  </header>
  <!-- Search Form -->
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <!-- Navigation -->
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

  <!-- Medecine Form -->
  <section>
    <h1>Medicine Form</h1>
    <form method="post" onsubmit="return confirm('Are you sure you want to insert this record?');">
      <label for="id">id:</label>
      <input type="number" id="id" name="id"><br><br>

      <label for="name">name:</label>
      <input type="text" id="name" name="name" required><br><br>

      <label for="manfactrure">manfactrure:</label>
      <input type="text" id="manfactrure" name="manfactrure" required><br><br>

      <label for="dosage">dosage:</label>
      <input type="number" id="dosage" name="dosage"><br><br>

      <label for="price">price:</label>
      <input type="number" id="price" name="price"><br><br>

      <label for="quantity">quantity:</label>
      <input type="number" id="quantity" name="quantity"><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>

    <!-- PHP Code for Inserting Data into Database -->
    <?php
      include('database_connection.php');

      // Check if the form is submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Prepare and bind parameters with appropriate data types
          $stmt = $connection->prepare("INSERT INTO medecine (id, name, manfactrure, dosage, price, quantity) VALUES (?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("isssss", $id, $name , $manfactrure, $dosage, $price, $quantity);

          // Set parameters from POST data with validation (optional)
          $id = intval($_POST['id']); // Ensure integer for id
          $name= htmlspecialchars($_POST['name']); // Prevent XSS
          $manfactrure= htmlspecialchars($_POST['manfactrure']); // Prevent XSS
          $dosage= htmlspecialchars($_POST['dosage']); // Prevent XSS
          $price= htmlspecialchars($_POST['price']); // Prevent XSS
          $quantity= htmlspecialchars($_POST['quantity']); // Prevent XSS

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

    <!-- Medecine Table -->
    <h2>Medicine Table</h2>
    <table border="2">
      <tr>
        <th>id</th>
        <th>name</th>
        <th>manfactrure</th>
        <th>dosage</th>
        <th>price</th>
        <th>quantity</th>
        <th>DELETE</th>
        <th>UPDATE</th>
      </tr>
      <?php
        include('database_connection.php');

        $sql = "SELECT * FROM medecine";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                echo "<tr>
                  <td>" . $row['id'] . "</td>
                  <td>" . $row['name'] . "</td>
                  <td>" . $row['manfactrure'] . "</td>
                  <td>" . $row['dosage'] . "</td>
                  <td>" . $row['price'] . "</td>
                  <td>" . $row['quantity'] . "</td>

                  <td><a style='padding:4px' href='Delete_medecine.php?id=$id'>Delete</a></td> 
                  <td><a style='padding:4px' href='update_medecine.php?id=$id'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }

        $connection->close();
      ?>
    </table>
  </section>
  <!-- Footer -->
  <footer>
    <center> 
      <b><h2>UR CBE BIT &copy 2024 Designed by: @Diane ARINIMBABAZI</h2></b>
    </center>
  </footer>
</body>
</html>
