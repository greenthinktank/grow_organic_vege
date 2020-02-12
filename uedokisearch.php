<!-- uedokisearch.php -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta name="description" content="how_to_organic_agriの野菜ページです。" charset="utf-8">
    <title>野菜植え時検索</title>


    <link rel="stylesheet" href="">
  </head>
  <body>

        <h1>【植えどき検索】</h1>

        <h1>植え時の野菜を探そう</h1>

        <h2>あなたの畑の地温は？</h2>
        <h3>「」℃</h3>

        <h2>１．いつ植える？</h2>

    <FORM action="uedokisearch.php" method="post">
    <SELECT NAME="month">
    <OPTION SELECTED>
    <OPTION VALUE="1">１月
    <OPTION VALUE="2">２月
    <OPTION VALUE="3">３月
    <OPTION VALUE="4">４月
    <OPTION VALUE="5">５月
    <OPTION VALUE="6">６月
    <OPTION VALUE="7">７月
    <OPTION VALUE="8">８月
    <OPTION VALUE="9">９月
    <OPTION VALUE="10">１０月
    <OPTION VALUE="11">１１月
    <OPTION VALUE="12">１２月
    </SELECT>

    <FORM action="uedokisearch.php" method="post">
    <SELECT NAME="shun">
    <OPTION SELECTED>
    <OPTION VALUE="early">上旬
    <OPTION VALUE="mid">中旬
    <OPTION VALUE="late">下旬
    </SELECT>

        <h2>２．どこの畑に植える？</h2>

    <!-- <SELECT NAME="place">
    <OPTION SELECTED>
    <OPTION VALUE="cool">寒冷地
    <OPTION VALUE="warm">温暖地
    <OPTION VALUE="warmer">暖地
    <OPTION VALUE="hot">亜熱帯
    </SELECT> -->
    <FORM action="uedokisearch.php" method="post">
    <select name="pref_name">
    <option value="" selected>都道府県</option>
    <option value="北海道">北海道</option>
    <option value="青森県">青森県</option>
    <option value="岩手県">岩手県</option>
    <option value="宮城県">宮城県</option>
    <option value="秋田県">秋田県</option>
    <option value="山形県">山形県</option>
    <option value="福島県">福島県</option>
    <option value="茨城県">茨城県</option>
    <option value="栃木県">栃木県</option>
    <option value="群馬県">群馬県</option>
    <option value="埼玉県">埼玉県</option>
    <option value="千葉県">千葉県</option>
    <option value="東京都">東京都</option>
    <option value="神奈川県">神奈川県</option>
    <option value="新潟県">新潟県</option>
    <option value="富山県">富山県</option>
    <option value="石川県">石川県</option>
    <option value="福井県">福井県</option>
    <option value="山梨県">山梨県</option>
    <option value="長野県">長野県</option>
    <option value="岐阜県">岐阜県</option>
    <option value="静岡県">静岡県</option>
    <option value="愛知県">愛知県</option>
    <option value="三重県">三重県</option>
    <option value="滋賀県">滋賀県</option>
    <option value="京都府">京都府</option>
    <option value="大阪府">大阪府</option>
    <option value="兵庫県">兵庫県</option>
    <option value="奈良県">奈良県</option>
    <option value="和歌山県">和歌山県</option>
    <option value="鳥取県">鳥取県</option>
    <option value="島根県">島根県</option>
    <option value="岡山県">岡山県</option>
    <option value="広島県">広島県</option>
    <option value="山口県">山口県</option>
    <option value="徳島県">徳島県</option>
    <option value="香川県">香川県</option>
    <option value="愛媛県">愛媛県</option>
    <option value="高知県">高知県</option>
    <option value="福岡県">福岡県</option>
    <option value="佐賀県">佐賀県</option>
    <option value="長崎県">長崎県</option>
    <option value="熊本県">熊本県</option>
    <option value="大分県">大分県</option>
    <option value="宮崎県">宮崎県</option>
    <option value="鹿児島県">鹿児島県</option>
    <option value="沖縄県">沖縄県</option>
    </select>

    <h2>３．何から育てる？</h2>

<FORM action="uedokisearch.php" method="post">
<SELECT SIZE="2"  NAME="seeding">
<OPTION VALUE="seed">種
<OPTION VALUE="other">苗、種芋、挿し木
</SELECT>
<br>
//種からだと発芽適温を考慮しなくてはならないけれど、それ以外は生育適温だけ考慮でいい



    <br>
    <br>
    <INPUT type="submit" VALUE="探す">
    </FORM>

<h2>【あなたの選んだ選択肢】</h2>
    <?php

    $when = $_POST["month"];
    echo $when;

    $shun = $_POST["shun"];
    echo $shun;

    $pref_name = $_POST["pref_name"];
    echo $pref_name;

    $seeding = $_POST["seeding"];
    echo $seeding;

    ?>


<!--
利用者に選んでもらうのは

１いつ植えるか「月」と「上・中・下旬」を選ぶ

２どこで植えるか（都道府県）「山口」県「山口」市

３「タネで植える」か「苗、種芋、挿し木などで植える」か



・タネを植えるのは「９月１７日」を予定しているとする。

・住んでいる場所で選択「山口県」「山口市」が選択される。
↓
DBアクセス
（気象庁のサイトからDLして作ったテーブル「場所」「旬」ごとの３つの平年値「平均気温」「最高気温」「最低気温」）
このDBを自動で作るシステム作りたい
「山口県山口市」の「９月」の「中旬」の「平均気温・平年値」を取ってくる

例：
「９月中旬」の
平均気温平年値（過去３０年）は「23.6」℃で
（最高気温平年値は「28.6」℃、最低気温平年値は「19.4」℃。）

ということは


１。

まずは「生育適温条件を診断」
野菜のDBからそれぞれの野菜の「最低生育温度」と「最高生育温度」を引っ張ってきて


植える月も入れて後の２ヶ月（合計３ヶ月、旬で言えば９つ）の平均気温平年値（９旬分）と比べる

「最低生育温度＜＝平均気温平年値」
かつ
「平均気温平年値＜＝最高生育温度」 -->


<?php
//
// $dsn ='mysql:dbname=vegetabledb;host=localhost';
// $user = 'vegefarmer';
// $password = 'organicfarming';
//
// try {
//   $dbh = new PDO($dsn,$user,$password);
//   $sql =
//   "select id,name from vege_table
//   where low_seiiku_temp <= " . [旬の平均気温平年値] . " AND high_seiiku_temp >=" .[旬の平均気温平年値]
//   and low_seiiku_temp <= " . [旬の平均気温平年値] . " AND high_seiiku_temp >=" .[旬の平均気温平年値]
//   and low_seiiku_temp <= " . [旬の平均気温平年値] . " AND high_seiiku_temp >=" .[旬の平均気温平年値]
//   and low_seiiku_temp <= " . [旬の平均気温平年値] . " AND high_seiiku_temp >=" .[旬の平均気温平年値]
//   and low_seiiku_temp <= " . [旬の平均気温平年値] . " AND high_seiiku_temp >=" .[旬の平均気温平年値]
//   and low_seiiku_temp <= " . [旬の平均気温平年値] . " AND high_seiiku_temp >=" .[旬の平均気温平年値]
//   and low_seiiku_temp <= " . [旬の平均気温平年値] . " AND high_seiiku_temp >=" .[旬の平均気温平年値]
//   and low_seiiku_temp <= " . [旬の平均気温平年値] . " AND high_seiiku_temp >=" .[旬の平均気温平年値]
//   where low_seiiku_temp <= " . [旬の平均気温平年値] . " AND high_seiiku_temp >=" .[旬の平均気温平年値] ;
//   $user = $dbh->query($sql);
//   foreach ($user as $u) {
//     echo $u[0] . "," . $u[1] . "<br>";
//   }
// } catch (PDOException $e) {
//   echo 'Error:'.$e->getMessage();
// }
//
// $dbh = null;

?>

<!--
２。（「苗、種芋、挿し木で植える」を選んだ場合はこの処理は飛ばす）

まずは「発芽適温条件を診断」
野菜のDBからそれぞれの野菜の「最低発芽気温」と「最高発芽気温」を引っ張ってきて


「最低発芽適温＜＝平均気温平年値」
かつ
「平均気温平年値＜＝最高発芽適温」 -->

<?php
//
// $dsn ='mysql:dbname=vegetabledb;host=localhost';
// $user = 'vegefarmer';
// $password = 'organicfarming';
//
// try {
//   $dbh = new PDO($dsn,$user,$password);
//   $sql ="select id,name from vege_table where low_hatsuga_temp <= " . [旬の平均気温平年値] . " AND high_hatsuga_temp >=" . [旬の平均気温平年値];
//   $user = $dbh->query($sql);
//   foreach ($user as $u) {
//     echo $u[0] . "," . $u[1] . "<br>";
//   }
// } catch (PDOException $e) {
//   echo 'Error:'.$e->getMessage();
// }
//
// $dbh = null;

?>

<!--
１と２に両方が「真」の野菜だけをsqlで一覧に出力する。 -->


 <?php

// $最低発芽適温＝野菜データベースの「最低発芽適温」のカラムから引っ張る
// $最高発芽適温＝野菜データベースの「最高発芽適温」のカラムから引っ張る
//
//
// $植える予定日＝サイト利用者に選択してもらう
//
// $予想平均気温＝気象庁の過去データから「$植える予定日」の平均気温を引っ張ってくる
//
//   $最低発芽適温 = 15;
//   $予想平均気温 = 23.6;
//   $最高発芽適温 = 30;
//
//     if (最低発芽適温<=予想平均気温 and 予想平均気温<=最高発芽適温) {
//       echo "植えどきです。";
//     } else {
//       echo "植える時期ではありません。";
//     }

?>


  </body>
</html>
