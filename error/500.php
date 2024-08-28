<?php 
    // Load the login.ini file, where all the paths, passwords, and usernames are stored (secret file)
    $path = parse_ini_file("../login.ini");
?>
<!-- The 500 Internal Server Error page -->
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

    <h1>500 Forbidden</h1> 
    <p>Something went wrong on the server.</p>
    <p><a href="../index.php">Go back to the homepage</a></p>
</body>
</html>
