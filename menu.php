<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員メニュー</title>
    <link rel="stylesheet" type="text/css" href="menu.css"> 
</head>
<?php
session_start();

// セッションがセットされていない場合はログインページにリダイレクトする
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['login_message'] = "ログインが必要です。";
    header("Location: login2.php");
    exit();
}

// セッションにセットされているログインメッセージがあれば表示する
if(isset($_SESSION['login_message'])) {
    echo "<script>alert('" . $_SESSION['login_message'] . "');</script>";
    unset($_SESSION['login_message']); 
} else {
    // ログイン成功のポップアップを表示する関数
    echo "<script>alert('ログインに成功しました！');</script>";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員メニュー</title>
</head>
<body>
    <h1>会員メニュー</h1>
    <div class=box>
    <ol>
        <li><a href="research.php">KAMEとおしゃべり</a></li>
        <li><a href="API3.php">気になるCOSMEニュースを検索</a></li>
    </ol>
    </div>
</body>
</html>
