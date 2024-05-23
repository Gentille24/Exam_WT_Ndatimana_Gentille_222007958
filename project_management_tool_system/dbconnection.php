<?php
// Connection details
$host = "localhost";
$user = "Gentille";
$pass = "222007958";
$database = "project_management_tool_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>