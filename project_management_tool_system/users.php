<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Form</title>
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
        <h1><u>Users Form</u></h1>

        <form method="post" action="users.php" onsubmit="return confirmInsert();">
            <label for="UserID">UserID:</label>
            <input type="number" id="UserID" name="UserID"><br><br>

            <label for="Username">Username:</label>
            <input type="text" id="Username" name="Username"><br><br>

            <label for="Password">Password:</label>
            <input type="Password" id="Password" name="Password" required><br><br>

            <label for="Email">Email:</label>
            <input type="Email" id="Email" name="Email" required><br><br>

            <label for="Role">Role:</label>
            <input type="text" id="Role" name="Role" required><br><br>
            <input type="submit" name="add" value="Insert">
        </form>

        <?php
        include('dbconnection.php'); // Include your database connection file

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if UserID is set and is unique
            $UserID = $_POST['UserID'];
            $checkQuery = "SELECT UserID FROM users WHERE UserID = ?";
            $checkStmt = $connection->prepare($checkQuery);
            $checkStmt->bind_param("i", $UserID);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                echo "Error: UserID already exists.";
            } else {
                // Prepare and bind parameters for users insertion
                $stmt = $connection->prepare("INSERT INTO users (UserID, Username, Password, Email, Role) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("issss", $UserID, $Username, $Password, $Email, $Role);

                // Set parameters from form data
                $Username = $_POST['Username'];
                $Password = $_POST['Password'];
                $Email = $_POST['Email'];
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
            $checkStmt->close();
        }

        $sql = "SELECT * FROM users";
        $result = $connection->query($sql);
        ?>

        <h2>Table of Users</h2>
        <table>
            <tr>
                <th>UserID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Role</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Output data from the users table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $UserID = $row['UserID'];
                    echo "<tr>
                            <td>" . $row['UserID'] . "</td>
                            <td>" . $row['Username'] . "</td>
                            <td>" . $row['Password'] . "</td>
                            <td>" . $row['Email'] . "</td>
                            <td>" . $row['Role'] . "</td>
                            <td><a href='delete_users.php?UserID=$UserID'>Delete</a></td>
                            <td><a href='update_users.php?UserID=$UserID'>Update</a></td>
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
