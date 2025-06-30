<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) exit();

$user_id = $_SESSION['user_id'];
$content = $_POST['content'];
$image = '';

if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
    $image = time() . "_" . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
}

$stmt = $conn->prepare("INSERT INTO posts (user_id, content, image) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $content, $image);
$stmt->execute();

header("Location: home.php");
exit();
?>