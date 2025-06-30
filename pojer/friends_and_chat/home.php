<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// عرض جميع المستخدمين مع خيارات الصداقة والدردشة
$users = $conn->query("SELECT id, name FROM users WHERE id != $user_id");

echo "<h2>مرحبًا بك في شبكتي!</h2>";
echo "<a href='friend_requests.php'>طلبات الصداقة</a> | <a href='logout.php'>تسجيل الخروج</a><br><br>";

while ($row = $users->fetch_assoc()) {
    $friend_id = $row['id'];
    $name = $row['name'];

    // فحص حالة الصداقة
    $check = $conn->query("SELECT * FROM friend_requests 
        WHERE ((sender_id = $user_id AND receiver_id = $friend_id) OR 
               (sender_id = $friend_id AND receiver_id = $user_id)) AND status = 'accepted'");

    echo "<div>";
    echo "<b>$name</b> ";
    if ($check->num_rows > 0) {
        echo " | <a href='chat.php?id=$friend_id'>مراسلة</a>";
    } else {
        echo " | <a href='send_friend_request.php?id=$friend_id'>إرسال طلب صداقة</a>";
    }
    echo "</div><hr>";
}
?>