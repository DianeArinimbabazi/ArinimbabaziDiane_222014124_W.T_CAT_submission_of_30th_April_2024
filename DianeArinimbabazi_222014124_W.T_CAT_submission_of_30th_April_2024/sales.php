<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sales Page</title>
  <style>
    /* Your CSS styles */
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
<body style="background-image: url('./Images/image8.png');background-repeat: no-repeat;background-size:cover;">
  <header>
    <h1>SALES</h1>
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
    <li style="display: inline; margin-right: 10px;"><a href="./Medicine.php">MEDICINE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Inventory.php">INVENTORY</a></li>
  </ul>

  <section>
    <h1>Sales Form</h1>
    <form method="post" onsubmit="return confirm('Are you sure you want to insert this record?');">
      <label for="medecine">Medicine:</label>
      <input type="number" id="medecine" name="medecine" required><br><br>

      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity" required><br><br>

      <label for="amaount">Amaount:</label>
      <input type="number" id="amount" name="amaount"><br><br>

      <label for="Date">Date:</label>
      <input type="Date" id="Date" name="Date"><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
      include('database_connection.php');

      // Check if the form is submitted
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // Prepare and bind parameters with appropriate data types
          $stmt = $connection->prepare("INSERT INTO sales (medecine, quantity, amaount, Date) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("iids", $medecine, $quantity, $amaount, $Date);

          // Set parameters from POST data with validation (optional)
          $medecine = intval($_POST['medecine']); // Ensure integer for medecine
          $quantity = intval($_POST['quantity']); // Ensure integer for quantity
          $amaount = floatval($_POST['amaount']); // Ensure float for amaount
          $date = $_POST['Date']; // Date doesn't need validation

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

    <h2>Sales Table</h2>
    <table border="2">
      <tr>
        <th>Id</th>
        <th>Medicine</th>
        <th>Quantity</th>
        <th>Amaount</th>
        <th>Date</th>
        <th>DELETE</th>
        <th>UPDATE</th>
      </tr>
      <?php
        include('database_connection.php');

        $sql = "SELECT * FROM sales";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row['id'];
                echo "<tr>
                  <td>" . $row['id'] . "</td>
                  <td>" . $row['medecine'] . "</td>
                  <td>" . $row['quantity'] . "</td>
                  <td>" . $row['amaount'] . "</td>
                  <td>" . $row['Date'] . "</td>

                  <td><a style='padding:4px' href='Delete_sales.php?id=$id'>Delete</a></td> 
                  <td><a style='padding:4px' href='update_sales.php?id=$id'>Update</a></td> 
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
