<?php
session_start();
require 'db.php';

$sender_id = $_SESSION['user_id'];
$receiver_id = $_POST['to'];
$message = $_POST['message'];

$stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $sender_id, $receiver_id, $message);
$stmt->execute();

header("Location: chat.php?id=$receiver_id");
?>