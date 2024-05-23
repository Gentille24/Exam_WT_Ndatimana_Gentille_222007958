<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Add CSS for table styling */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        footer {
            background-color: teal;
            text-align: center;
            width: 100%;
            color: white;
            font-size: 25px;
            position: fixed;
            bottom: 0;
            padding: 10px 0;
        }
        button a {
            color: white;
            text-decoration: none;
        }
    </style>
     <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body>
<header>
<section>
    <form class="forms" role="search" action="search.php">
      <input  type="text" placeholder="Search" aria-label="Search"name="query">
      <button  type="submit">Search</button>
    </form>
     <body bgcolor="darkgray">
    <h1><u>Projects Form</u></h1>

    <form method="post" action="projects.php" onsubmit="return confirmInsert();">
       <label for="ProjectID">ProjectID :</label>
        <input type="number" id="ProjectID" name="ProjectID"><br><br>

        <label for="ProjectName">ProjectName:</label>
        <input type="text" id="ProjectName" name="ProjectName"><br><br>

        <label for="Description">Description:</label>
        <input type="text" id="Description" name="Description" required><br><br>

        <label for="StartDate">StartDate:</label>
        <input type="date" id="StartDate" name="StartDate" required><br><br>

        <label for="EndDate">EndDate:</label>
        <input type="date" id="EndDate" name="EndDate" required><br><br>

        <label for="Status">Status:</label>
        <input type="text" id="Status" name="Status" required><br><br>
        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('dbconnection.php'); // Include your database connection file

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters for payment insertion
        $stmt = $connection->prepare("INSERT INTO projects (ProjectID, ProjectName, Description, StartDate, EndDate, Status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $ProjectID, $ProjectName, $Description, $StartDate, $EndDate, $Status);

        // Set parameters from form data
        $ProjectID = $_POST['ProjectID'];
        $ProjectName = $_POST['ProjectName'];
        $Description = $_POST['Description'];
        $StartDate = $_POST['StartDate'];
        $EndDate = $_POST['EndDate'];
        $Status = $_POST['Status'];

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    $sql = "SELECT * FROM projects";
    $result = $connection->query($sql);
    ?>

    <h2>Table of Projects</h2>
    <table>
        <tr>
            <th>ProjectID</th>
            <th>ProjectName</th>
            <th>Description</th>
            <th>StartDate</th>
            <th>EndDate</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Output data from the projects table
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ProjectID = $row['ProjectID'];
                echo "<tr>
                    <td>" . $row['ProjectID'] . "</td>
                    <td>" . $row['ProjectName'] . "</td>
                    <td>" . $row['Description'] . "</td>
                    <td>" . $row['StartDate'] . "</td>
                    <td>" . $row['EndDate'] . "</td>
                    <td>" . $row['Status'] . "</td>
                    <td><a href='delete_projects.php?ProjectID=$ProjectID'>Delete</a></td>
                    <td><a href='update_projects.php?ProjectID=$ProjectID'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
    <center><button><a href="home.html">Back Home</a></button></center>
</section>
</header>

    <b>UR CBE BIT &copy; 2024 &reg;, Designed by: @Ndatimana Gentille</b>

</body>
</html>
