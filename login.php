<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // قراءة بيانات المستخدمين
    $users = json_decode(file_get_contents('users.json'), true);

    foreach ($users as $user) {
        if ($user['username'] === $username && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit();
        }
    }

    // في حال فشل تسجيل الدخول
    header("Location: login.html?error=خطأ في اسم المستخدم أو كلمة المرور");
    exit();
}
?>