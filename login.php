<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者用ログイン</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<?php
session_start();
// ユーザーネームとパスワードの設定
$correct_username = "hhirosawa";
$correct_password = "Hiroko1825";

// フォームから送信されたユーザーネームとパスワードの取得
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// ログイン情報の検証
if ($username === $correct_username && $password === $correct_password) {
    // ログイン成功時の処理
    $_SESSION['loggedin'] = true;
    $_SESSION['login_message'] = "ログインに成功しました！";
    header("Location: display.php");
    exit();
} else {
    // ログイン失敗時の処理
    echo "ユーザーネームまたはパスワードが間違っています。";

    // 2秒後にlogin.phpにリダイレクト
    header("refresh:2; url=welcome.php");
}
?>
</body>
</html>