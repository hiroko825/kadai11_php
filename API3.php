<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cosmetics News</title>
  <link rel="stylesheet" type="text/css" href="style10.css"> 
</head>
<body>
  <img src="header.jpg" alt="ロゴ" class="logo"> 

  <!-- 検索ボックス -->
  <div id="search-container">
    <input type="text" id="search-input" placeholder="気になるワードでNEWSを検索">
    <button onclick="searchNews()">検索</button>
  </div>

  <!-- キーワードに該当するNEWSボックス -->
  <div id="related-news-box" style="display: none;"> 
  </div>

  <!-- 検索結果の見出し -->
  <div id="search-results-header" style="display: none;">
    <h2>↓ 該当するNEWSはこちら ↓</h2>
  </div>

  <!-- 検索結果のコンテナー -->
  <div id="search-results" class="news-container">
  </div>

  <div class="NEWS">NEWS一覧</div> <!-- 修正：この行を追加 -->

  <div class="container">
    <div id="skincare-news" class="news-container">
    </div>
    <div id="makeup-news" class="news-container">
    </div>
  </div>

  <script>
     // API
    const apiKey = "xxxxx"; 

    // キーワード検索時のニュース取得関数
    function searchNews() {
      const keyword = document.getElementById('search-input').value.trim();
      if (!keyword) {
        alert('キーワードを入力してください');
        return;
      }
      const searchUrl = `https://newsapi.org/v2/everything?q=${encodeURIComponent(keyword)}&apiKey=${apiKey}`;
      fetchNews(searchUrl, 'search-results');
    }

    function fetchNews(url, containerId) {
      console.log(url);
      fetch(url, {
      method: 'GET', 
      headers: {
        'Content-Type': 'application/json'
      },
    })
    .then(response => response.json())
    .then(data => displayNews(data.articles, containerId)) // 修正：データの articles プロパティを渡す
    .catch(error => console.error('Error:', error));
    }

    function displayNews(articles, containerId) {
      const newsContainer = document.getElementById(containerId);
      newsContainer.innerHTML = ''; // 結果をリセット

      // 検索結果の見出しを表示
      document.getElementById('search-results-header').style.display = 'block';

      articles.forEach(article => {
        const articleBox = document.createElement("div");
        articleBox.classList.add("article");
        articleBox.innerHTML = `
          <h3>${article.title}</h3>
          <a href="${article.url}" class="article-source">${article.url}</a>
          <p>Published At: ${article.publishedAt}</p>
          <p>${article.description}</p>
        `;
        newsContainer.appendChild(articleBox);
      });
    }

    // 初期のニュースを表示
    const skincareUrl = `https://newsapi.org/v2/everything?q=${encodeURIComponent('スキンケア')}&apiKey=${apiKey}`;
    const makeupUrl = `https://newsapi.org/v2/everything?q=${encodeURIComponent('メイクアップ')}&apiKey=${apiKey}`;

    fetchNews(skincareUrl, 'skincare-news');
    fetchNews(makeupUrl, 'makeup-news');
  </script>
</body>
</html>
