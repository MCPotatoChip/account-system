<?php
$conn = new mysqli('localhost', 'root', '', 'account system');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>