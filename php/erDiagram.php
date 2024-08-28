<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './connectToDatabase.php';
require_once './fetchStyle.php'; // Include the file that fetches the styles

use Classes\FetchStyle; // Use the FetchStyle class
$styleClass = new FetchStyle(); // Create an instance of the FetchStyle class
$style = $styleClass->fetch_style_by_id("erDiagram"); // Fetch the style by id (for this page it's index)
    

use Classes\Connection;

if (isset($_GET['table'])) {
    $tableName = $_GET['table'];

    // Ensure table name is valid (basic security check to avoid SQL injection)
    if (preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {

        // Create a new connection to fetch table data
        $connection = new Connection();
        $conn = $connection->get_connection();

        // Fetch table columns
        function fetchTableColumns($tableName, $conn) {
            $sql = "SHOW COLUMNS FROM `$tableName`";
            $result = $conn->query($sql);
            $columns = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $columns[] = [
                        'Field' => $row['Field'],
                        'Key' => $row['Key']
                    ]; // Fetch column names and keys
                }
            }
            return $columns;
        }

        // Fetch foreign keys
        function fetchForeignKeys($tableName, $conn) {
            $sql = "SELECT
                        COLUMN_NAME, 
                        REFERENCED_TABLE_NAME, 
                        REFERENCED_COLUMN_NAME 
                    FROM
                        INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                    WHERE
                        TABLE_NAME = '$tableName'
                        AND REFERENCED_TABLE_NAME IS NOT NULL";
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

        // Get columns and foreign keys for the selected table
        $columns = fetchTableColumns($tableName, $conn);
        $foreignKeys = fetchForeignKeys($tableName, $conn);

    } else {
        die('Invalid table name.');
    }
} else {
    die('No table specified.');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ER Diagram: <?php echo htmlspecialchars($tableName); ?></title>
    <style>
        <?php echo $style["style"]; ?>
    </style>
</head>
<body>

<button class="home" onclick="window.location.href='../index.php'">
    Home
</button>

<div class="er-container">
    <h1>ER Diagram: <?php echo htmlspecialchars($tableName); ?></h1>

    <div class="table-box">
        <h2><?php echo htmlspecialchars($tableName); ?></h2>
        <ul class="columns">
            <?php foreach ($columns as $column): ?>
                <li>
                    <?php echo htmlspecialchars($column['Field']); ?>
                    <?php if ($column['Key'] === 'PRI'): ?>
                        <strong>(PK)</strong>
                    <?php elseif ($column['Key'] === 'MUL'): ?>
                        <strong>(FK)</strong>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if (!empty($foreignKeys)): ?>
            <div class="foreign-keys">
                <h3>Foreign Keys</h3>
                <ul class="columns">
                    <?php foreach ($foreignKeys as $foreignKey): ?>
                        <li>
                            <?php echo htmlspecialchars($foreignKey['column']); ?>
                            &rarr;
                            <?php echo htmlspecialchars($foreignKey['referenced_table']); ?> (<?php echo htmlspecialchars($foreignKey['referenced_column']); ?>)
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
