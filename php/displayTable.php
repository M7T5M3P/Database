<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './connectToDatabase.php';
require_once './fetchStyle.php'; // Include the file that fetches the styles

use Classes\FetchStyle; // Use the FetchStyle class
$styleClass = new FetchStyle(); // Create an instance of the FetchStyle class
$style = $styleClass->fetch_style_by_id("displayTable"); // Fetch the style by id (for this page it's index)
   

use Classes\Connection;

if (isset($_GET['table'])) {
    $tableName = $_GET['table'];

    // Ensure table name is valid (basic security check to avoid SQL injection)
    if (preg_match('/^[a-zA-Z0-9_ ]+$/', $tableName)) {

        // Create a new connection to fetch table data
        $connection = new Connection();
        $conn = $connection->get_connection();

        // Handle table deletion
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_table'])) {
            $deleteSql = "DROP TABLE `$tableName`";
            if ($conn->query($deleteSql) === TRUE) {
                echo "<script>alert('Table deleted successfully.'); window.location.href = '../index.php';</script>";
                exit();
            } else {
                echo "<script>alert('Error deleting table: " . $conn->error . "');</script>";
            }
        }

        // Fetch columns of the table
        function fetchTableColumns($tableName, $conn) {
            $sql = "SHOW COLUMNS FROM `$tableName`";
            $result = $conn->query($sql);
            $columns = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $columns[] = $row['Field']; // Fetch column names
                }
            }
            return $columns;
        }

        // Fetch data of the table
        function fetchTableData($tableName, $conn) {
            $sql = "SELECT * FROM `$tableName`";
            $result = $conn->query($sql);
            return ($result->num_rows > 0) ? $result : null;
        }

        // Fetch the columns and data for the selected table by default
        $columns = fetchTableColumns($tableName, $conn);

        // Default SQL Query to fetch entire table
        $defaultSql = "SELECT * FROM `$tableName`";
        $data = $conn->query($defaultSql);

    } else {
        die('Invalid table name.');
        header('Location: ../index.php');
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
    <title>Table: <?php echo htmlspecialchars($tableName); ?></title>
    <style>
        <?php echo $style["style"]; ?>
    </style>
</head>
<body>

<button class="home" onclick="window.location.href='../index.php'">
    Home
</button>

<!-- Delete Table Form -->
<form class="delete-form" method="POST">
    <button type="submit" class="delete-table" name="delete_table" onclick="return confirm('Are you sure you want to delete this table?');">
        Delete Table
    </button>
</form>

<h1>Table: <?php echo htmlspecialchars($tableName); ?></h1>

<?php if (!empty($columns)): ?>
    <!-- SQL Query Form -->
    <h2>Run SQL Query on <?php echo htmlspecialchars($tableName); ?></h2>

    <form method="POST">
        <label for="sql_query">SQL Query:</label><br>
        <textarea name="sql_query" rows="5" cols="100"><?php echo isset($_POST['sql_query']) ? htmlspecialchars($_POST['sql_query']) : ''; ?></textarea><br><br>
        <button type="submit" name="run_query">Run Query</button>
    </form>

    <!-- Query Results -->
    <?php
    // If a custom query is submitted
    if (isset($_POST['run_query']) && !empty($_POST['sql_query'])) {
        $sqlQuery = $_POST['sql_query'];

        // Run the SQL query and display the result
        if ($result = $conn->query($sqlQuery)) {
            if ($result instanceof mysqli_result && $result->num_rows > 0) {
                // Display SELECT results
                echo "<h3>Query Results:</h3>";
                echo "<table border='1'>";
                echo "<tr>";
                // Output column names
                while ($fieldInfo = $result->fetch_field()) {
                    echo "<th>" . htmlspecialchars($fieldInfo->name) . "</th>";
                }
                echo "</tr>";

                // Output rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $data) {
                        echo "<td>" . htmlspecialchars($data) . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } elseif ($result === true) {
                // For non-SELECT queries (e.g., UPDATE, DELETE)
                echo "<p>Query executed successfully.</p>";
            } else {
                echo "<p>No results returned by the query.</p>";
            }
        } else {
            echo "<p>Error executing query: " . $conn->error . "</p>";
        }
    } else {
        // Display the default table
        if ($data && $data->num_rows > 0) {
            echo "<h3>Default Table Data:</h3>";
            echo "<table border='1'>";
            echo "<tr>";
            // Output column names
            foreach ($columns as $column) {
                echo "<th>" . htmlspecialchars($column) . "</th>";
            }
            echo "</tr>";

            // Output rows
            while ($row = $data->fetch_assoc()) {
                echo "<tr>";
                foreach ($columns as $column) {
                    echo "<td>" . htmlspecialchars($row[$column]) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No data found in this table.</p>";
        }
    }
    ?>
<?php endif; ?>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
