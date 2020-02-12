<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" name="description" content="今の畑のpHに合う野菜を探そう。">
    <title>pHに合う野菜を探す</title>
  </head>
  <body>
    <h1>野菜が好む土のpH</h1>
    <h3>野菜には生育に適したpHがあり、土がそのpHから大きく外れてしまうとうまく育たなかったり病気になりやすい、虫に食べられやすいような弱い野菜に育ってしまうことがあります。
      今のあなたの畑のpHを知り、そのphに合った野菜を植えることでうまく育てましょう！</h3>

      <h2>あなたの畑のpHは？</h2>

  <FORM action="ph_search.php" method="post">
  <SELECT NAME="ph">
    <OPTION SELECTED>
    <?php
    for ($i=4.5; $i <= 8.5 ; $i=$i+0.1) {
      echo "<option>$i</option>";
    }
    ?>

   <!-- <OPTION SELECTED>
   <OPTION VALUE="4.5〜5.0">4.5〜5.0
   <OPTION VALUE="5.0〜5.5">5.0〜5.5
   <OPTION VALUE="5.5〜6.0">5.5〜6.0
   <OPTION VALUE="6.0〜6.5">6.0〜6.5
   <OPTION VALUE="6.5〜7.0">6.5〜7.0
   <OPTION VALUE="7.0〜7.5">7.0〜7.5
   <OPTION VALUE="7.5〜8.0">7.5〜8.0
   <OPTION VALUE="8.0〜8.5">8.0〜8.5 -->

   </SELECT>

  <INPUT type="submit" VALUE="検索">
  </FORM>

  <?php

  $ph = $_POST["ph"];
  echo $ph;

  ?>

<h2>↓あなたの畑のpHに合う野菜↓</h2>

  <?php

  $dsn ='mysql:dbname=vegetabledb;host=localhost';
  $user = 'vegefarmer';
  $password = 'organicfarming';

  try {
    $dbh = new PDO($dsn,$user,$password);
    $sql ="select id,name from vege_table where low_ph <= " . $ph . " AND high_ph >=" . $ph;
    $user = $dbh->query($sql);
    foreach ($user as $u) {
      echo $u[0] . "," . $u[1] . "<br>";
    }
  } catch (PDOException $e) {
    echo 'Error:'.$e->getMessage();
  }

  $dbh = null;

  ?>

  </body>
</html>
