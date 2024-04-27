<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録者一覧</title>
    <link rel="stylesheet" href="delete.css">
</head>
<body>
<?php
// データベース接続
try {
    $pdo = new PDO('mysql:dbname=gsacademy_gs_kadai;charset=utf8;host=mysql647.db.sakura.ne.jp','gsacademy','xxx');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('データベース接続エラー:'.$e->getMessage());
}

// ID が指定されているか確認
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // 削除するデータのIDを取得
    $id = $_GET['id'];

    // SQLクエリの準備と実行
    $stmt = $pdo->prepare("DELETE FROM makeup_artists WHERE id = ?");
    $stmt->execute([$id]);

    // 削除成功のメッセージを表示
    echo "削除が完了しました。";

    // 2秒後にdisplay.phpにリダイレクト
    header("refresh:2; url=display.php");
} else {
    // ID が指定されていない場合のエラーメッセージ
    echo "削除するデータのIDが指定されていません。";
}

// データベース接続を閉じる
$pdo = null;
?>
</body>
</html>
