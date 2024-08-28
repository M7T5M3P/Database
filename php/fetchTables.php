<?php

require_once __DIR__ . '/connectToDatabase.php';

use Classes\Connection;

function fetchTables() {
    $connection = new Connection();
    $conn = $connection->get_connection();

    if (!$conn) {
        // Handle connection failure
        return false;
    }

    // Fetch all tables
    $tables = [];
    $sql = "SHOW TABLES";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0]; // Collect table names
        }
    }

    // Close the connection
    $conn->close();

    // Return the list of tables
    return $tables;
}

function fetchTablesWithRelations($conn) {
    $tables = [];
    
    // Fetch all tables
    $sqlTables = "SHOW TABLES";
    $resultTables = $conn->query($sqlTables);
    
    if ($resultTables->num_rows > 0) {
        while ($row = $resultTables->fetch_assoc()) {
            $tableName = $row[array_keys($row)[0]];
            $tables[$tableName] = [
                'columns' => fetchTableColumns($tableName, $conn),
                'foreign_keys' => fetchForeignKeys($tableName, $conn)
            ];
        }
    }
    
    return $tables;
}

function fetchForeignKeys($tableName, $conn) {
    $sql = "SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME 
            FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE TABLE_NAME = '$tableName' AND REFERENCED_TABLE_NAME IS NOT NULL";
    
    $result = $conn->query($sql);
    $foreignKeys = [];
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $foreignKeys[] = [
                'column' => $row['COLUMN_NAME'],
                'referenced_table' => $row['REFERENCED_TABLE_NAME'],
                'referenced_column' => $row['REFERENCED_COLUMN_NAME']
            ];
        }
    }
    
    return $foreignKeys;
}

function fetchTableColumns($tableName, $conn) {
    $sql = "SHOW COLUMNS FROM `$tableName`";
    $result = $conn->query($sql);
    $columns = [];
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $columns[] = [
                'Field' => $row['Field'],
                'Key' => $row['Key']
            ];
        }
    }
    
    return $columns;
}
?>
