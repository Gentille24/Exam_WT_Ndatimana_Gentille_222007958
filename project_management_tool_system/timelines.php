<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>timelines Form</title>
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
        <h1><u>timelines Form</u></h1>

        <form method="post" action="timelines.php" onsubmit="return confirmInsert();">
            <label for="TimelineID">TimelineID:</label>
            <input type="number" id="TimelineID" name="TimelineID"><br><br>

            <label for="ProjectID">ProjectID:</label>
            <input type="number" id="ProjectID" name="ProjectID"><br><br>

            <label for="EventName">EventName:</label>
            <input type="text" id="EventName" name="EventName" required><br><br>

            <label for="EventDate">EventDate:</label>
            <input type="date" id="EventDate" name="EventDate" required><br><br>
            <input type="submit" name="add" value="Insert">
        </form>

        <?php
        include('dbconnection.php'); // Include your database connection file

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Prepare and bind parameters for timelines insertion
            $stmt = $connection->prepare("INSERT INTO timelines (TimelineID, ProjectID, EventName, EventDate) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $TimelineID, $ProjectID, $EventName, $EventDate);

            // Set parameters from form data
            $TimelineID = $_POST['TimelineID'];
            $ProjectID = $_POST['ProjectID'];
            $EventName = $_POST['EventName'];
            $EventDate = $_POST['EventDate'];

            // Execute the statement
            if ($stmt->execute() === TRUE) {
                echo "New record has been added successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        $sql = "SELECT * FROM timelines";
        $result = $connection->query($sql);
        ?>

        <h2>Table of timelines</h2>
        <table>
            <tr>
                <th>TimelineID</th>
                <th>ProjectID</th>
                <th>EventName</th>
                <th>EventDate</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Output data from the timelines table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $TimelineID = $row['TimelineID'];
                    echo "<tr>
                            <td>" . $row['TimelineID'] . "</td>
                            <td>" . $row['ProjectID'] . "</td>
                            <td>" . $row['EventName'] . "</td>
                            <td>" . $row['EventDate'] . "</td>
                            <td><a href='delete_timelines.php?TimelineID=$TimelineID'>Delete</a></td>
                            <td><a href='update_timelines.php?TimelineID=$TimelineID'>Update</a></td>
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
