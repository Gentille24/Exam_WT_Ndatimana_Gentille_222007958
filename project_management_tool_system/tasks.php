<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks Form</title>
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
    <h1><u>Tasks Form</u></h1>

    <form method="post" action="tasks.php" onsubmit="return confirmInsert();">
       <label for="TaskID">TaskID:</label>
        <input type="number" id="TaskID" name="TaskID"><br><br>

        <label for="ProjectID">ProjectID:</label>
        <input type="number" id="ProjectID" name="ProjectID"><br><br>

        <label for="TaskName">TaskName:</label>
        <input type="text" id="TaskName" name="TaskName" required><br><br>

        <label for="Description">Description:</label>
        <input type="text" id="Description" name="Description" required><br><br>

        <label for="AssignedTo">AssignedTo:</label>
        <input type="date" id="AssignedTo" name="AssignedTo" required><br><br>

        <label for="DueDate">DueDate:</label>
        <input type="date" id="DueDate" name="DueDate"><br><br>

        <label for="Priority">Priority:</label>
        <input type="text" id="Priority" name="Priority" required><br><br>

        <label for="Status">Status:</label>
        <input type="text" id="Status" name="Status" required><br><br>
        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('dbconnection.php'); // Include your database connection file

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters for task insertion
        $stmt = $connection->prepare("INSERT INTO tasks (TaskID, ProjectID, TaskName, Description, AssignedTo, DueDate, Priority, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissssss", $TaskID, $ProjectID, $TaskName, $Description, $AssignedTo, $DueDate, $Priority, $Status);

        // Set parameters from form data
        $TaskID = $_POST['TaskID'];
        $ProjectID = $_POST['ProjectID'];
        $TaskName = $_POST['TaskName'];
        $Description = $_POST['Description'];
        $AssignedTo = $_POST['AssignedTo'];
        $DueDate = $_POST['DueDate'];
        $Priority = $_POST['Priority'];
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

    $sql = "SELECT * FROM tasks";
    $result = $connection->query($sql);
    ?>

    <h2>Table of Tasks</h2>
    <table>
        <tr>
            <th>TaskID</th>
            <th>ProjectID</th>
            <th>TaskName</th>
            <th>Description</th>
            <th>AssignedTo</th>
            <th>DueDate</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Output data from the tasks table
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $TaskID = $row['TaskID'];
                echo "<tr>
                    <td>" . $row['TaskID'] . "</td>
                    <td>" . $row['ProjectID'] . "</td>
                    <td>" . $row['TaskName'] . "</td>
                    <td>" . $row['Description'] . "</td>
                    <td>" . $row['AssignedTo'] . "</td>
                    <td>" . $row['DueDate'] . "</td>
                    <td>" . $row['Priority'] . "</td>
                    <td>" . $row['Status'] . "</td>
                    <td><a href='delete_tasks.php?TaskID=$TaskID'>Delete</a></td>
                    <td><a href='update_tasks.php?TaskID=$TaskID'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No data found</td></tr>";
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
