<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>meetings Form</title>
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
    <h1><u>meetings Form</u></h1>

    <form method="post" action="meetings.php" onsubmit="return confirmInsert();">
       <label for="MeetingID">MeetingID:</label>
        <input type="number" id="MeetingID" name="MeetingID"><br><br>

        <label for="ProjectID">ProjectID:</label>
        <input type="number" id="ProjectID" name="ProjectID"><br><br>

        <label for="MeetingName">MeetingName:</label>
        <input type="text" id="MeetingName" name="MeetingName" required><br><br>

        <label for="Description">Description:</label>
        <input type="text" id="Description" name="Description" required><br><br>

        <label for="StartTime">StartTime:</label>
        <input type="Time" id="StartTime" name="StartTime" required><br><br>

         <label for="EndTime">EndTime:</label>
         <input type="Time" id="EndTime" name="EndTime"><br><br>

        <label for="Location">Location  :</label>
        <input type="text" id="Location" name="Location" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('dbconnection.php'); // Include your database connection file

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters for meetings insertion
        $stmt = $connection->prepare("INSERT INTO meetings (MeetingID, ProjectID, MeetingName, Description, StartTime, EndTime, Location) VALUES (?, ?, ?, ?, ?, ?, ?)"); 
        $stmt->bind_param("iisssss", $MeetingID, $ProjectID, $MeetingName, $Description,  $StartTime, $EndTime, $Location);

        // Set parameters from form data
      
        $MeetingID= $_POST['MeetingID'];
        $ProjectID = $_POST['ProjectID'];
        $MeetingName = $_POST['MeetingName'];
        $Description = $_POST['Description'];
        $StartTime= $_POST['StartTime'];
        $EndTime = $_POST['EndTime'];
        $Location = $_POST['Location'];
       

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    $sql = "SELECT * FROM meetings";
    $result = $connection->query($sql);
    ?>

    <h2>Table of meetings</h2>
    <table>
        <tr>
            <th>MeetingID</th>
            <th>ProjectID</th>
            <th>MeetingName</th>
            <th>Description</th>
            <th>EndTime</th>
            <th>StartTime</th>
            <th>Location</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Output data from the meetings table
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $MeetingID = $row['MeetingID'];
                echo "<tr>
                    <td>" . $row['MeetingID'] . "</td>
                    <td>" . $row['ProjectID'] . "</td>
                    <td>" . $row['MeetingName'] . "</td>
                    <td>" . $row['Description'] . "</td>
                    <td>" . $row['StartTime'] . "</td>
                    <td>" . $row['EndTime'] . "</td>
                    <td>" . $row['Location'] . "</td>
                    <td><a href='delete_meetings.php?MeetingID=$MeetingID'>Delete</a></td>
                    <td><a href='update_meetings.php?MeetingID=$MeetingID'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No data found</td></tr>";
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
