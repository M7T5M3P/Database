<?php
require_once './fetchStyle.php'; // Include the file that fetches the styles

use Classes\FetchStyle; // Use the FetchStyle class
$styleClass = new FetchStyle(); // Create an instance of the FetchStyle class
$style = $styleClass->fetch_style_by_id("createTable"); // Fetch the style by id (for this page it's index)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Table</title>
    <style>
        <?php echo $style["style"]; ?>
    </style>
</head>
<body>

<button class="home" onclick="window.location.href='../index.php'">
    Home
</button>

<div class="container">
    <h1>Create New Table</h1>
    
    <form id="createTableForm" action="createTableLogic.php" method="POST">
        <!-- Table Name -->
        <div class="input-group">
            <label for="tableName">Table Name:</label>
            <input type="text" id="tableName" name="tableName" required>
        </div>

        <!-- Column Inputs -->
        <div id="columnsSection">
            <div class="input-group">
                <label for="column1">Column 1:</label>
                <input type="text" id="column1" name="columns[]" placeholder="Column Name" required>

                <select name="dataTypes[]" required>
                    <option value="INT">INT</option>
                    <option value="VARCHAR(255)">VARCHAR(255)</option>
                    <option value="TEXT">TEXT</option>
                    <option value="DATE">DATE</option>
                    <option value="TIMESTAMP">TIMESTAMP</option>
                </select>

                <!-- Additional Column Options -->
                <div class="column-options">
                    <div>
                        <label>Primary Key: <input type="checkbox" class="primaryKey" name="primaryKey[]" value="1"></label>
                    </div>
                    <div>
                        <label>Auto Increment: <input type="checkbox" class="autoIncrement" name="autoIncrement[]" value="1" disabled></label>
                    </div>
                    <div>
                        <label>Nullable: <input type="checkbox" name="nullable[]" value="1"></label>
                    </div>
                    <div>
                        <label>Unique: <input type="checkbox" name="unique[]" value="1"></label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Column Button -->
        <button type="button" class="add-column-btn" onclick="addColumn()">Add Column</button>

        <!-- Error Message -->
        <div id="errorMessage" class="error" style="display: none;">
            Only one primary key can be selected!
        </div>

        <!-- Submit Button -->
        <button type="submit" class="submit-btn" onclick="return validateForm()">Create Table</button>
    </form>
</div>

<script>
    let columnCount = 1;
    let primaryKeySelected = false;

    function addColumn() {
        columnCount++;
        const columnsSection = document.getElementById('columnsSection');

        const newInputGroup = document.createElement('div');
        newInputGroup.classList.add('input-group');

        const label = document.createElement('label');
        label.setAttribute('for', `column${columnCount}`);
        label.textContent = `Column ${columnCount}:`;

        const input = document.createElement('input');
        input.type = 'text';
        input.id = `column${columnCount}`;
        input.name = 'columns[]';
        input.placeholder = 'Column Name';
        input.required = true;

        const select = document.createElement('select');
        select.name = 'dataTypes[]';
        select.required = true;
        select.innerHTML = `
            <option value="INT">INT</option>
            <option value="VARCHAR(255)">VARCHAR(255)</option>
            <option value="TEXT">TEXT</option>
            <option value="DATE">DATE</option>
            <option value="TIMESTAMP">TIMESTAMP</option>
        `;

        const columnOptions = document.createElement('div');
        columnOptions.classList.add('column-options');
        columnOptions.innerHTML = `
            <div>
                <label>Primary Key: <input type="checkbox" class="primaryKey" name="primaryKey[]" value="1"></label>
            </div>
            <div>
                <label>Auto Increment: <input type="checkbox" class="autoIncrement" name="autoIncrement[]" value="1" disabled></label>
            </div>
            <div>
                <label>Nullable: <input type="checkbox" name="nullable[]" value="1"></label>
            </div>
            <div>
                <label>Unique: <input type="checkbox" name="unique[]" value="1"></label>
            </div>
        `;

        newInputGroup.appendChild(label);
        newInputGroup.appendChild(input);
        newInputGroup.appendChild(select);
        newInputGroup.appendChild(columnOptions);

        columnsSection.appendChild(newInputGroup);

        addPrimaryKeyLogic();
    }

    function addPrimaryKeyLogic() {
        const primaryKeyCheckboxes = document.querySelectorAll('.primaryKey');
        const autoIncrementCheckboxes = document.querySelectorAll('.autoIncrement');

        primaryKeyCheckboxes.forEach((checkbox, index) => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    if (primaryKeySelected) {
                        this.checked = false;
                        document.getElementById('errorMessage').style.display = 'block';
                    } else {
                        primaryKeySelected = true;
                        autoIncrementCheckboxes[index].disabled = false;
                        document.getElementById('errorMessage').style.display = 'none';
                    }
                } else {
                    primaryKeySelected = false;
                    autoIncrementCheckboxes[index].disabled = true;
                    autoIncrementCheckboxes[index].checked = false;
                }
            });
        });
    }

    function validateForm() {
        const primaryKeyCheckboxes = document.querySelectorAll('.primaryKey');
        let primaryKeyCheckedCount = 0;

        primaryKeyCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                primaryKeyCheckedCount++;
            }
        });

        if (primaryKeyCheckedCount > 1) {
            document.getElementById('errorMessage').style.display = 'block';
            return false;
        }

        return true;
    }

    // Initialize logic for the first column
    addPrimaryKeyLogic();
</script>

</body>
</html>
