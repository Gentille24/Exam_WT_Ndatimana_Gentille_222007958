<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teammembers Form</title>
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
        <h1><u>teammembers Form</u></h1>

        <form method="post" action="TeamMembers.php" onsubmit="return confirmInsert();">
            <label for="TeamMemberID">TeamMemberID:</label>
            <input type="number" id="TeamMemberID" name="TeamMemberID"><br><br>

            <label for="TeamID">TeamID:</label>
            <input type="number" id="TeamID" name="TeamID"><br><br>

            <label for="UserID">UserID:</label>
            <input type="number" id="UserID" name="UserID" required><br><br>

            <label for="Role">Role:</label>
            <input type="text" id="Role" name="Role" required><br><br>
            <input type="submit" name="add" value="Insert">
        </form>

        <?php
        include('dbconnection.php'); // Include your database connection file

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Prepare and bind parameters for teammembers insertion
            $stmt = $connection->prepare("INSERT INTO teammembers (TeamMemberID, TeamID, UserID, Role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiis", $TeamMemberID, $TeamID, $UserID, $Role);

            // Set parameters from form data
            $TeamMemberID = $_POST['TeamMemberID'];
            $TeamID = $_POST['TeamID'];
            $UserID = $_POST['UserID'];
            $Role = $_POST['Role'];

            // Execute the statement
            if ($stmt->execute() === TRUE) {
                echo "New record has been added successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        $sql = "SELECT * FROM teammembers";
        $result = $connection->query($sql);
        ?>

        <h2>Table of teammembers</h2>
        <table>
            <tr>
                <th>TeamMemberID</th>
                <th>TeamID</th>
                <th>UserID</th>
                <th>Role</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Output data from the teammembers table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $TeamMemberID= $row['TeamMemberID'];
                    echo "<tr>
                            <td>" . $row['TeamMemberID'] . "</td>
                            <td>" . $row['TeamID'] . "</td>
                            <td>" . $row['UserID'] . "</td>
                            <td>" . $row['Role'] . "</td>
                            <td><a href='delete_teammembers.php?TeamMemberID=$TeamMemberID'>Delete</a></td>
                            <td><a href='update_teammembers.php?TeamMemberID=$TeamMemberID'>Update</a></td>
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
