<?php
session_start();
require 'db.php';

$receiver_id = $_SESSION['user_id'];
$sender_id = $_GET['id'];

$stmt = $conn->prepare("UPDATE friend_requests SET status = 'accepted' 
    WHERE sender_id = ? AND receiver_id = ?");
$stmt->bind_param("ii", $sender_id, $receiver_id);
$stmt->execute();

header("Location: friend_requests.php");
?>