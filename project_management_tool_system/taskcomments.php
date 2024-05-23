<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>taskcomments Form</title>
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
        <h1><u>taskcomments Form</u></h1>

        <form method="post" action="taskcomments.php" onsubmit="return confirmInsert();">
            <label for="CommentID">CommentID:</label>
            <input type="number" id="CommentID" name="CommentID"><br><br>

            <label for="TaskID">TaskID:</label>
            <input type="number" id="TaskID" name="TaskID"><br><br>

            <label for="UserID">UserID:</label>
            <input type="number" id="UserID" name="UserID" required><br><br>

            <label for="CommentText">CommentText:</label>
            <input type="text" id="CommentText" name="CommentText" required><br><br>
            <input type="submit" name="add" value="Insert">
        </form>

        <?php
        include('dbconnection.php'); // Include your database connection file

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Prepare and bind parameters for taskcomments insertion
            $stmt = $connection->prepare("INSERT INTO taskcomments (CommentID, TaskID, UserID, CommentText) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiis", $CommentID, $TaskID, $UserID, $CommentText);

            // Set parameters from form data
            $CommentID = $_POST['CommentID'];
            $TaskID = $_POST['TaskID'];
            $UserID = $_POST['UserID']; // Fixed variable name
            $CommentText = $_POST['CommentText'];

            // Execute the statement
            if ($stmt->execute() === TRUE) {
                echo "New record has been added successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        $sql = "SELECT * FROM taskcomments";
        $result = $connection->query($sql);
        ?>

        <h2>Table of taskcomments</h2>
        <table>
            <tr>
                <th>CommentID</th>
                <th>TaskID</th>
                <th>UserID</th>
                <th>CommentText</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Output data from the taskcomments table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $CommentID = $row['CommentID'];
                    echo "<tr>
                            <td>" . $row['CommentID'] . "</td>
                            <td>" . $row['TaskID'] . "</td>
                            <td>" . $row['UserID'] . "</td>
                            <td>" . $row['CommentText'] . "</td>
                            <td><a href='delete_taskcomments.php?CommentID=$CommentID'>Delete</a></td>
                            <td><a href='update_taskcomments.php?CommentID=$CommentID'>Update</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
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
