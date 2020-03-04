<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta name="description" content="organic_agriのアプリの旬で検索ページです。" charset="utf-8">
    <title>旬から探す</title>
  </head>
  <body>
    <h1>「旬」から探す</h1>

<h3>現代では野菜は旬の季節以外にもお店で買うことができます。
  しかし野菜は元々の旬に収穫したものの方が栄養価が高いことが知られています。
  しかも旬の野菜は価格が安いので家計にも優しいのです。
  野菜を食べるのならば旬の季節に食べる方がよいと思いませんか？</h3>

      <?php

      echo "今日は『".date('Y年m月d日 H時i分s秒')."』。";


      ?>

      <h2>旬の野菜一覧</h2>
      データベースから今が収穫時期の野菜の一覧を引っ張ってくる
      収穫月をデータベースに入れておき、月ごとにDBから出力してくる？

      <?php

      $dsn ='mysql:dbname=vegetabledb;host=localhost';
      $user = 'vegefarmer';
      $password = 'organicfarming';

      try {
        $dbh = new PDO($dsn,$user,$password);
        $sql ='select nutritional_vege from vege_table where nutritional_vege=1';
        $user = $dbh->query($sql);
        foreach ($user as $u) {
          echo $u['$ph']. "<br>";
        }
      } catch (PDOException $e) {
        echo 'Error:'.$e->getMessage();
      }

      $dbh = null;

      ?>

    <ul>
      <li><a href="" target="_blank">旬の野菜を探す</a></li>
      <li><a href="" target="_blank">旬の緑黄色野菜を探す</a></li>
      <li><a href="" target="_blank">旬の野菜レシピを探す</a></li>
    <ul>
  </body>
</html>
