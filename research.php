<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>おしゃべり</title>
    <link rel="stylesheet" type="text/css" href="research.css"> 
</head>
<body>
    <div class="container">
        <h1>KAMEとおしゃべり</h1>
        <div class="h2">
        <h2>ド天然なKAMEちゃんとおしゃべりしてみましょう</h2></div>
        <form id="messageForm">
            <label for="message">メッセージを入力：</label><br>
            <input type="text" id="message" name="message"><br>
            <button type="submit">送信</button>
        </form>

        <div id="conversation" class="conversation"></div>
    </div>

    <script>
        document.getElementById("messageForm").addEventListener("submit", function(event) {
            event.preventDefault(); // フォームのデフォルトの送信を無効化

            let message = document.getElementById("message").value; // フォームからメッセージを取得

            let data = {
                apikey: 'xxx',
                query: message
            };

            let httpClient = new XMLHttpRequest();
            httpClient.open("POST", "https://api.a3rt.recruit.co.jp/talk/v1/smalltalk", true);
            httpClient.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // レスポンスを受け取った時の処理
            httpClient.onreadystatechange = function() {
                if (httpClient.readyState === XMLHttpRequest.DONE) {
                    if (httpClient.status === 200) {
                        let response = JSON.parse(httpClient.responseText);
                        let reply = response.results[0].reply;
                        document.getElementById("conversation").innerHTML += "<p><strong>あなた：</strong>" + message + "</p>";
                        document.getElementById("conversation").innerHTML += "<p><strong>KAME：</strong>" + reply + "</p>";
                    } else {
                        console.log('Error: (' + httpClient.status + ') ' + httpClient.responseText);
                    }
                }
            };

            // データをURLエンコードして送信
            let encodedData = Object.keys(data).map(function(key) {
                return encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
            }).join('&');

            httpClient.send(encodedData);
        });
    </script>
</body>
</html>
