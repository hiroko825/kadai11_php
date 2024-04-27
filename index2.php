<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>登録フォーム</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
<div id="box">
        <h2>管理者用ログイン</h2>
        <form action="login.php" method="post">
            <label for="username">ユーザーネーム:</label><br>
            <input type="text" id="username" name="username"><br>
            <label for="password">パスワード:</label><br>
            <input type="password" id="password" name="password"><br><br>
            <input type="submit" value="ログイン">
        </form>
    </div>
</body>
</html>
