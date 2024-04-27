<?php
session_start();

// セッションがセットされていない場合はログインページにリダイレクトする
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['login_message'] = "ログインが必要です。";
    header("Location: login.php");
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
    <title>登録者一覧</title>
    <link rel="stylesheet" href="display.css">
</head>
<body>
<?php
try {
    // データベースに接続
    $pdo = new PDO('mysql:dbname=gsacademy_gs_kadai;charset=utf8;host=mysql647.db.sakura.ne.jp','gsacademy','xxx');
    // エラーレポート設定を追加
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('データベース接続エラー:'.$e->getMessage());
}

// テーブルから「メイク施術経験あり」のデータを取得するSQLクエリ
$sql = "SELECT * FROM makeup_artists WHERE experience = 'yes'";

// クエリを実行し、結果を取得
$stmt = $pdo->query($sql);

// 結果を表示
echo "<h2>メイク施術経験ありの登録者一覧</h2>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>名前</th>
<th>Email</th>
<th>住所</th>
<th>修正</th>
<th>削除</th>
</tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . (isset($row['id']) ? $row['id'] : '') . "</td>"; 
    echo "<td>" . (isset($row['name']) ? $row['name'] : '') . "</td>";
    echo "<td>" . (isset($row['email']) ? $row['email'] : '') . "</td>";
    echo "<td>" . (isset($row['address']) ? $row['address'] : '') . "</td>";
    echo "<td><a href='update.php?id=" . $row['id'] . "'>修正</a></td>";
    echo "<td><a href='delete.php?id=" . $row['id'] . "'>削除</a></td>"; 
    echo "</tr>";
}

echo "</table>";

// データベース接続を閉じる
$pdo = null;
?>
</body>
</html>
