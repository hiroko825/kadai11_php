<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録者一覧</title>
    <link rel="stylesheet" href="update.css">
</head>
<body>
<?php
// データベースに接続
try {
    $pdo = new PDO('mysql:dbname=gsacademy_gs_kadai;charset=utf8;host=mysql647.db.sakura.ne.jp', 'gsacademy', 'xxx');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('データベース接続エラー:' . $e->getMessage());
}

// POSTデータが空でないかチェック
if (!empty($_POST)) {
    // POSTデータを取得
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // データを更新するSQLクエリ
    $sql = "UPDATE makeup_artists SET name = :name, email = :email, address = :address WHERE id = :id";

    // プリペアドステートメントを作成
    $stmt = $pdo->prepare($sql);

    // パラメータをバインドしてクエリを実行
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);

    // クエリを実行
    $stmt->execute();

    // 完了メッセージを表示
    echo "データの更新が完了しました！";

    // 2秒後にwelcome.phpにリダイレクト
    header("refresh:2; url=display.php");
} elseif (isset($_GET['id']) && !empty($_GET['id'])) { 
    $id = $_GET['id'];

    // 指定されたIDのデータを取得するSQLクエリ
    $sql = "SELECT * FROM makeup_artists WHERE id = :id";

    // プリペアドステートメントを作成
    $stmt = $pdo->prepare($sql);

    // パラメータをバインドしてクエリを実行
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // クエリを実行
    $stmt->execute();

    // データを取得
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // データが見つかった場合、修正フォームを表示
?>
        <!DOCTYPE html>
        <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>データ修正フォーム</title>
            <link rel="stylesheet" href="update.css">
        </head>
        <body>
            <div class="update-container">
            <h2>データ修正フォーム</h2>
            <form class="update-form" form action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="name">名前：</label>
                <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>"><br>
                <label for="email">Email：</label>
                <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>"><br>
                <label for="address">住所：</label>
                <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>"><br>
                <input type="submit" value="修正">
            </form>
            </div>
        </body>
        </html>
<?php
    } else {
        // データが見つからない場合はエラーメッセージを表示
        echo "データが見つかりませんでした。";
    }
} else {
    // IDが指定されていない場合はエラーメッセージを表示
    echo "エラー: IDが指定されていません。";
}
?>
</body>
</html>