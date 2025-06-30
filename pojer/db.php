<?php
$conn = new mysqli("localhost", "root", "", "social_app");
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>