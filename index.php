<?php 
    // Load the login.ini file, where all the paths, passwords, and usernames are stored (secret file)
    $path = parse_ini_file("./login.ini");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='<?php echo $path["base_url"]; ?>css/index.css'>
    <title>Hello World in PHP</title>
</head>
<body>

    <h1><?php echo "Hello, World!"; ?></h1>

    <p>This is a simple example of a PHP script embedded in HTML.</p>

</body>
</html>
