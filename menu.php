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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会員メニュー</title>
    <link rel="stylesheet" href="menu.css"> 
</head>
<body>
    <div class="box">
    <h1>メニュー</h1>
    <h2>今後も続々追加予定！</h2>
    <ol>
        <li><h3>はたらく</h3></li>
        <li><a href="xxxxx">■ 顧客管理<br></a></li>
        <li><a href="xxxxx">■ タスク管理<br></a></li>
    </ol>
    <ol>
        <li><h3>あそぶ</h3></li>
        <li><a href="research.php">■ KAMEとおしゃべり</a></li>
        <li><a href="API3.php">■ ※工事中※ NEWS検索</a></li>
        <li><a href="xxxxx">・・・<br></a></li>
        <li><a href="xxxxx">・・・<br></a></li>
        <li><a href="xxxxx">・・・<br></a></li>
        <li><a href="xxxxx">・・・<br></a></li>
        <li><a href="xxxxx">・・・<br></a></li>
    </ol>
    </div>

    <div class="contents">
        <h3>contents</h3>
    </div>
</body>
</html>
