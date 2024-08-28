<?php 
    // Load the login.ini file, where all the paths, passwords, and usernames are stored (secret file)
    $path = parse_ini_file("./login.ini");

    require_once './php/fetchStyle.php'; // Include the file that fetches the styles
    require_once './php/fetchTables.php'; // Include the file that fetches the tables

    use Classes\FetchStyle; // Use the FetchStyle class
    $styleClass = new FetchStyle(); // Create an instance of the FetchStyle class
    $style = $styleClass->fetch_style_by_id("index"); // Fetch the style by id (for this page it's index)
    
    $tables = fetchTables(); // Fetch the tables from the database
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
    <style>
        <?php echo $style["style"]; ?>
    </style>
</head>
<body>
    <div class="container">
        <button class="createTable" onclick="window.location.href='php/createTable.php'">
            Create Table
        </button>
        <button class="all-diagrams-button" onclick="window.location.href='php/allDiagram.php'">
            Show All Diagrams
        </button>
        <table class="tables">
            <thead>
                <tr>
                    <th>Table Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tables)): ?>
                    <?php foreach ($tables as $table): ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($table); ?>
                            </td>
                            <td>
                                <button class="custom-button" onclick="window.location.href='php/displayTable.php?table=<?php echo urlencode($table); ?>';">
                                    View Data
                                </button>
                                <button class="er-button" onclick="window.location.href='php/erDiagram.php?table=<?php echo urlencode($table); ?>';">
                                    ER Diagram
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No tables found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
<footer>
    <p>Created by: <a href="">Mathys Thévenot (6722878283)</a>, <a href="">Best</a></p>
</footer>
</html>
