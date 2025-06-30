<?php
session_start();
require 'db.php';

$sender_id = $_SESSION['user_id'];
$receiver_id = $_GET['id'];

$stmt = $conn->prepare("INSERT INTO friend_requests (sender_id, receiver_id) VALUES (?, ?)");
$stmt->bind_param("ii", $sender_id, $receiver_id);
$stmt->execute();

header("Location: home.php");
?>