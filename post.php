<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tweet = $_POST['tweet'];
    $username = $_SESSION['username'];
    $time = date("Y-m-d H:i:s");

    // قراءة التغريدات الحالية
    $tweets = json_decode(file_get_contents('tweets.json'), true) ?? [];
    $tweets[] = ['username' => $username, 'content' => $tweet, 'time' => $time];

    // حفظ التغريدات مع التغريدة الجديدة
    file_put_contents('tweets.json', json_encode($tweets));
    header("Location: home.php");
    exit();
}
?>