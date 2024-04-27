<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録者用ログイン</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<?php
session_start();
// データベース接続
try {
    $pdo = new PDO('mysql:dbname=gsacademy_gs_kadai;charset=utf8;host=mysql647.db.sakura.ne.jp','gsacademy','xxx');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('データベース接続エラー:'.$e->getMessage());
}

// フォームから送信されたメールアドレスの取得
$email = $_POST['email'] ?? '';

// SQLクエリの準備と実行
$stmt = $pdo->prepare("SELECT * FROM makeup_artists WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // ログイン成功時の処理
    $_SESSION['loggedin'] = true;
    $_SESSION['login_message'] = "ログインに成功しました！";
    header("Location: menu.php");
    exit();
} else {
    // ログイン失敗時の処理
    echo "メールアドレスが間違っています。";

    // 2秒後にwelcome.phpにリダイレクト
    header("refresh:2; url=welcome.php");
}
?>
</body>
</html>
