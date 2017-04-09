<!--config file defines the connection. just say "include('config.php')" 
in the other pages, and this will be included
-->

<?php
$servername = "localhost";
$username = "projbsn_root";
$password = "brentseannick471";
$db = "projbsn_musicsharing";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}
?>