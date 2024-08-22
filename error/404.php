<?php 
    // Load the login.ini file, where all the paths, passwords, and usernames are stored (secret file)
    $path = parse_ini_file("../login.ini");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='<?php echo $path["base_url"]; ?>css/error.css'>
    <title>403 Forbidden</title>
</head>
<body>

    <h1>404 Forbidden</h1>
    <p>You don't have permission to access this resource.</p>
    <p><a href="../index.php">Go back to the homepage</a></p>

</body>
</html>
