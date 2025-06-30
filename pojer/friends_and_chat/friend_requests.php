<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT users.id, users.name FROM friend_requests 
    JOIN users ON users.id = friend_requests.sender_id 
    WHERE receiver_id = $user_id AND status = 'pending'");
echo "<h3>طلبات الصداقة</h3>";
while ($row = $result->fetch_assoc()) {
    echo "{$row['name']} - <a href='accept_request.php?id={$row['id']}'>قبول</a><br>";
}
?>