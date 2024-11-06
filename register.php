<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // قراءة المستخدمين الحاليين من ملف JSON
    $users = json_decode(file_get_contents('users.json'), true);
    $users[] = ['username' => $username, 'password' => $password];

    // حفظ المستخدمين مع المستخدم الجديد
    file_put_contents('users.json', json_encode($users));
    header("Location: login.html");
    exit();
}
?>