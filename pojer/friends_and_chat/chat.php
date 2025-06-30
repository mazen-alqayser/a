<?php
session_start();
require 'db.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = $_SESSION['user_id'];
$friend_id = $_GET['id'];

$result = $conn->query("SELECT * FROM messages WHERE 
    (sender_id = $user_id AND receiver_id = $friend_id) OR 
    (sender_id = $friend_id AND receiver_id = $user_id) 
    ORDER BY created_at");

while ($row = $result->fetch_assoc()) {
    echo "<p><b>" . ($row['sender_id'] == $user_id ? 'أنا' : 'هو') . ":</b> {$row['message']}</p>";
}
?>

<form method="post" action="send_message.php">
    <input type="hidden" name="to" value="<?= $friend_id ?>">
    <textarea name="message"></textarea>
    <button type="submit">إرسال</button>
</form>