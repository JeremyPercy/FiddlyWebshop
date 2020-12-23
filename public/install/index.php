<?php
/**
 * Copyright (c) 2018.
 * Created by Jeremy-Percy Batten
 * Project Fiddly 2018
 */

?>
<html>
<head>
    <style>
        body {
            width:600px;
            text-align:center;
        }
        a {
            color: #fff;
            font-weight: 600;
            text-transform: none;
        }
        .sql-import-response {
            padding: 10px;
        }
        .success-response {
            background-color: #a8ebc4;
            border-color: #1b7943;
            color: #1b7943;
        }
        .error-response {
            border-color: #d96557;
            background: #f0c4bf;
            color: #d96557;
        }
        button {
            background-color: #2AB5CA; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 20px;
        }
    </style>
</head>
<body>
<?php
require_once '../../app/config/config.php';

$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$dbname = DB_NAME;

$url = URLROOT;

$conn =new mysqli($host, $user, $pass, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query= "DROP DATABASE IF EXISTS `$dbname`;";
if (mysqli_query($conn, $query)) {
    echo "Drop database " . $dbname . " succesfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

$query= "CREATE DATABASE `$dbname`;";
if (mysqli_query($conn, $query)) {
    echo "<br>Create database " . $dbname . " succesfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

$query= "USE `$dbname`;";
if (mysqli_query($conn, $query)) {
    echo "<br>Use database " . $dbname;
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

$query = '';
$sqlScript = file('fiddly_database.sql');
foreach ($sqlScript as $line)	{

    $startWith = substr(trim($line), 0 ,2);
    $endWith = substr(trim($line), -1 ,1);

    if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
        continue;
    }

    $query = $query . $line;
    if ($endWith == ';') {
        mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
        $query= '';
    }
}
echo '<div class="success-response sql-import-response">SQL file imported successfully because Jeremy is awesome!</div>';
echo '<button><a href="' . $url . '">Continue to fiddly website</button>';
?>
</body>
</html>
