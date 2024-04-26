<?php

$host = "localhost";
$user = "root";
$pass = "";
$database = "forum";

try {
    $conn = mysqli_connect($host, $user, $pass, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        echo "Connected successfully";
        // Additional configuration if needed
        mysqli_set_charset($conn, "utf8"); // Set character set
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
