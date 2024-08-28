<?php
require_once './connectToDatabase.php';

use Classes\Connection;

$connection = new Connection();
$conn = $connection->get_connection();

// Get the table name from the form
$tableName = $_POST['tableName'];
$columns = $_POST['columns'];
$dataTypes = $_POST['dataTypes'];
$primaryKeys = isset($_POST['primaryKey']) ? $_POST['primaryKey'] : [];
$autoIncrements = isset($_POST['autoIncrement']) ? $_POST['autoIncrement'] : [];
$nullables = isset($_POST['nullable']) ? $_POST['nullable'] : [];
$uniques = isset($_POST['unique']) ? $_POST['unique'] : [];

// Start building the SQL query
$query = "CREATE TABLE `$tableName` (";
$primaryKey = null;

// Iterate through columns and build column definitions
for ($i = 0; $i < count($columns); $i++) {
    $column = $columns[$i];
    $dataType = $dataTypes[$i];

    // Add column name and data type to the query
    $query .= "`$column` $dataType";

    // Handle additional options
    if (in_array($i, $primaryKeys)) {
        $primaryKey = $column; // Set primary key
    }

    if (in_array($i, $autoIncrements)) {
        $query .= " AUTO_INCREMENT";
    }

    if (in_array($i, $nullables)) {
        $query .= " NULL";
    } else {
        $query .= " NOT NULL";
    }

    if (in_array($i, $uniques)) {
        $query .= " UNIQUE";
    }

    // Add a comma between column definitions
    if ($i < count($columns) - 1) {
        $query .= ", ";
    }
}

// Add primary key if it exists
if ($primaryKey !== null) {
    $query .= ", PRIMARY KEY (`$primaryKey`)";
}

$query .= ");"; // Close the query

// Execute the query
if ($conn->query($query) === TRUE) {
    echo "Table '$tableName' created successfully!";
    header("Location: displayTable.php?table=$tableName");
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
