<?php
$connect = mysqli_connect("localhost", "root", "", "madiba");
// $conn = mysqli_connect("localhost", "Toussaint", "digitaloceaN@00d", "duhure");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>