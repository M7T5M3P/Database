<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './connectToDatabase.php';
require_once './fetchTables.php';
require_once './fetchStyle.php'; // Include the file that fetches the styles

use Classes\FetchStyle; // Use the FetchStyle class
$styleClass = new FetchStyle(); // Create an instance of the FetchStyle class
$style = $styleClass->fetch_style_by_id("allDiagram"); // Fetch the style by id (for this page it's index)
use Classes\Connection;

$connection = new Connection();
$conn = $connection->get_connection();

// Fetch all tables and their relationships
$tablesWithRelations = fetchTablesWithRelations($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Table Diagrams</title>
    <style>
        <?php echo $style["style"]; ?>
    </style>
</head>
<body>
    <button class="home" onclick="window.location.href='../index.php'">
        Home
    </button>
    <h1>All Table Diagrams</h1>
    
    <div class="all-diagrams-container">
        <?php foreach ($tablesWithRelations as $tableName => $tableInfo): ?>
            <div class="table-diagram">
                <h2><?php echo htmlspecialchars($tableName); ?></h2>
                
                <h3>Columns:</h3>
                <ul class="columns">
                    <?php foreach ($tableInfo['columns'] as $column): ?>
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
                
                <h3>Foreign Keys:</h3>
                <ul class="foreign-keys">
                    <?php if (!empty($tableInfo['foreign_keys'])): ?>
                        <?php foreach ($tableInfo['foreign_keys'] as $foreignKey): ?>
                            <li>
                                <?php echo htmlspecialchars($foreignKey['column']); ?>
                                &rarr;
                                <?php echo htmlspecialchars($foreignKey['referenced_table']); ?> 
                                (<?php echo htmlspecialchars($foreignKey['referenced_column']); ?>)
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No foreign keys</li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
