<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments Form</title>
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
        
    <h1><u>Assignments Form</u></h1>

    <form method="post" action="assignments.php" onsubmit="return confirmInsert();">
       <!-- Include AssignmentID field in the form -->
        <label for="AssignmentID">AssignmentID:</label>
        <input type="number" id="AssignmentID" name="AssignmentID"><br><br>
        
        <label for="TaskID">TaskID:</label>
        <input type="number" id="TaskID" name="TaskID"><br><br>

        <label for="UserID">UserID:</label>
        <input type="number" id="UserID" name="UserID" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('dbconnection.php'); // Include your database connection file

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Set parameters from form data
        $AssignmentID = $_POST['AssignmentID']; // Assuming AssignmentID is auto-incremented in the database
        $TaskID = $_POST['TaskID'];
        $UserID = $_POST['UserID'];

        // Check if TaskID exists in the tasks table
        $task_check_query = "SELECT TaskID FROM tasks WHERE TaskID=?";
        $stmt_task_check = $connection->prepare($task_check_query);
        $stmt_task_check->bind_param("i", $TaskID);
        $stmt_task_check->execute();
        $result_task_check = $stmt_task_check->get_result();

        if ($result_task_check->num_rows == 0) {
            echo "Error: TaskID does not exist.";
        } else {
            // Prepare and bind parameters for assignments insertion
            $stmt = $connection->prepare("INSERT INTO assignments (AssignmentID, TaskID, UserID) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $AssignmentID, $TaskID, $UserID);

            // Execute the statement
            if ($stmt->execute() === TRUE) {
                echo "New record has been added successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }
    }

    $sql = "SELECT * FROM assignments";
    $result = $connection->query($sql);
    ?>

    <h2>Table of Assignments</h2>
    <table>
        <tr>
            <th>AssignmentID</th>
            <th>TaskID</th>
            <th>UserID</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Output data from the assignments table
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $AssignmentID = $row['AssignmentID'];
                echo "<tr>
                    <td>" . $row['AssignmentID'] . "</td>
                    <td>" . $row['TaskID'] . "</td>
                    <td>" . $row['UserID'] . "</td>
                    <td><a href='delete_assignments.php?AssignmentID=$AssignmentID'>Delete</a></td>
                    <td><a href='update_assignments.php?AssignmentID=$AssignmentID'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
    <center><button><a href="home.html">Back Home</a></button></center>
</section>
</header>
<footer>
    <b>UR CBE BIT &copy; 2024 &reg;, Designed by: @NDATIMANA Gentille</b>
</footer>
</body>
</html>
