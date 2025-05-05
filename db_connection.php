<?php
$host = "dedi332.cpt3.host-h.net";
$username = "scbpoahnxj_1"; // Change as needed
$password = "jHLwh4hxcUi8b3wqCSS8"; // Change as needed
$database = "scbpoahnxj_db1";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
