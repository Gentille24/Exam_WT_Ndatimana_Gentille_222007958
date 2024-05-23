<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>budgets Form</title>
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
    <h1><u>budgets Form</u></h1>

    <form method="post" action="budgets.php" onsubmit="return confirmInsert();">
       <label for="BudgetID">  BudgetID:</label>
        <input type="number" id="BudgetID" name="BudgetID"><br><br>

        <label for="ProjectID">ProjectID:</label>
        <input type="number" id="ProjectID" name="ProjectID"><br><br>

        <label for="BudgetName">BudgetName:</label>
        <input type="text" id="BudgetName" name="BudgetName" required><br><br>

        <label for="Amount">Amount:</label>
        <input type="number" id="Amount" name="Amount" required><br><br>

        <label for="StartDate">StartDate:</label>
        <input type="date" id="StartDate" name="StartDate" required><br><br>

        <label for="EndDate">EndDate:</label>
        <input type="date" id="EndDate" name="EndDate" required><br><br>
        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('dbconnection.php'); // Include your database connection file

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters for budgets insertion
        $stmt = $connection->prepare("INSERT INTO budgets (BudgetID, ProjectID, BudgetName, Amount, StartDate, EndDate) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissss", $BudgetID, $ProjectID, $BudgetName, $Amount, $StartDate, $EndDate);

        // Set parameters from form data
        $BudgetID = $_POST['BudgetID'];
        $ProjectID = $_POST['ProjectID'];
        $BudgetName = $_POST['BudgetName'];
        $Amount = $_POST['Amount'];
        $StartDate = $_POST['StartDate'];
        $EndDate = $_POST['EndDate'];

        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    $sql = "SELECT * FROM budgets ";
    $result = $connection->query($sql);
    ?>

    <h2>Table of budgets </h2>
    <table>
        <tr>
            <th>BudgetID</th>
            <th>ProjectID</th>
            <th>BudgetName</th>
            <th>Amount</th>
            <th>StartDate</th>
            <th>EndDate</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Output data from the budgets table
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $BudgetID = $row['BudgetID'];
                echo "<tr>
                    <td>" . $row['BudgetID'] . "</td>
                    <td>" . $row['ProjectID'] . "</td>
                    <td>" . $row['BudgetName'] . "</td>
                    <td>" . $row['Amount'] . "</td>
                    <td>" . $row['StartDate'] . "</td>
                    <td>" . $row['EndDate'] . "</td>
                    <td><a href='delete_budgets.php?BudgetID=$BudgetID'>Delete</a></td>
                    <td><a href='update_budgets.php?BudgetID=$BudgetID'>Update</a></td>
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
<footer>
    <b>UR CBE BIT &copy; 2024 &reg;, Designed by:Ndatimana Gentille</b>
</footer>
</body>
</html>
