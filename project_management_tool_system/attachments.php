

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attachments Form</title>
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
        <h1><u>Attachments Form</u></h1>

        <form method="post" action="attachments.php" onsubmit="return confirmInsert();">
            <label for="AttachmentID">AttachmentID:</label>
            <input type="number" id="AttachmentID" name="AttachmentID"><br><br>

            <label for="TaskID">TaskID:</label>
            <input type="number" id="TaskID" name="TaskID"><br><br>

            <label for="FileName">FileName:</label>
            <input type="text" id="FileName" name="FileName" required><br><br>

            <label for="FilePath">FilePath:</label>
            <input type="text" id="FilePath" name="FilePath" required><br><br>

            <label for="UploadDate">UploadDate:</label>
            <input type="date" id="UploadDate" name="UploadDate" required><br><br>
            <input type="submit" name="add" value="Insert">
        </form>

        <?php
        include('dbconnection.php'); // Include your database connection file

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Set parameters from form data
            $AttachmentID = $_POST['AttachmentID'];
            $TaskID = $_POST['TaskID'];
            $FileName = $_POST['FileName'];
            $FilePath = $_POST['FilePath'];
            $UploadDate = $_POST['UploadDate'];

            // Check if TaskID exists in the tasks table
            $task_check_query = "SELECT TaskID FROM tasks WHERE TaskID=?";
            $stmt_task_check = $connection->prepare($task_check_query);
            $stmt_task_check->bind_param("i", $TaskID);
            $stmt_task_check->execute();
            $result_task_check = $stmt_task_check->get_result();

            if ($result_task_check->num_rows == 0) {
                echo "Error: TaskID does not exist.";
            } else {
                // Prepare and bind parameters for attachments insertion
                $stmt = $connection->prepare("INSERT INTO attachments (AttachmentID, TaskID, FileName, FilePath, UploadDate) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("iisss", $AttachmentID, $TaskID, $FileName, $FilePath, $UploadDate);

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

        $sql = "SELECT * FROM attachments";
        $result = $connection->query($sql);
        ?>

        <h2>Table of Attachments</h2>
        <table>
            <tr>
                <th>AttachmentID</th>
                <th>TaskID</th>
                <th>FileName</th>
                <th>FilePath</th>
                <th>UploadDate</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Output data from the attachments table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $AttachmentID = $row['AttachmentID'];
                    echo "<tr>
                            <td>" . $row['AttachmentID'] . "</td>
                            <td>" . $row['TaskID'] . "</td>
                            <td>" . $row['FileName'] . "</td>
                            <td>" . $row['FilePath'] . "</td>
                            <td>" . $row['UploadDate'] . "</td>
                            <td><a href='delete_attachments.php?AttachmentID=$AttachmentID'>Delete</a></td>
                            <td><a href='update_attachments.php?AttachmentID=$AttachmentID'>Update</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No data found</td></tr>";
            }
            // Close the database connection
            $connection->close();
            ?>
        </table>
        <center><button><a href="home.html">Back Home</a></button></center>
    </section>
</header>

<footer>
    <b>UR CBE BIT &copy; 2024 &reg;, Designed by: @Ndatimana Gentille</b>
</footer>

</body>
</html>
