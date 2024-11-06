<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

// قراءة التغريدات من ملف JSON
$tweets = json_decode(file_get_contents('tweets.json'), true) ?? [];

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>الصفحة الرئيسية</title>
</head>
<body>
    <h1>مرحباً، <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <a href="logout.php">تسجيل الخروج</a>

    <h2>نشر تغريدة جديدة</h2>
    <form action="post.php" method="POST">
        <textarea name="tweet" placeholder="اكتب تغريدتك هنا" required></textarea><br><br>
        <button type="submit">نشر</button>
    </form>

    <h2>التغريدات</h2>
    <?php foreach ($tweets as $tweet): ?>
        <div>
            <p><strong><?php echo htmlspecialchars($tweet['username']); ?>:</strong> <?php echo htmlspecialchars($tweet['content']); ?></p>
            <p><em><?php echo $tweet['time']; ?></em></p>
        </div>
    <?php endforeach; ?>
</body>
</html>