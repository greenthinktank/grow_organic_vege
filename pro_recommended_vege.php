<!-- <!DOCTYPE html>
<html lang="ja">
  <head>
    <meta name="description" content="あなたの畑に適している野菜を検索することができます。" charset="utf-8">
    <title>あなたの畑にオススメ野菜検索</title>
  </head>

  <body> -->

  <?php
require_once ('../wp-blog-header.php');
get_header();
?>


            <script>
            function check(){
            var flag = 0;
            // 設定開始（チェックする項目を設定してください）
            if(document.form1.month.options[document.form1.month.selectedIndex].value == ""){
              var month = document.getElementById('month');
              month.insertAdjacentHTML('afterend', '【！】月を選択してください');
              flag = 1; }
            if(document.form1.shun.options[document.form1.shun.selectedIndex].value == "" ){
              var shun = document.getElementById('shun');
              shun.insertAdjacentHTML('afterend', '【！】旬を選択してください');
              flag = 1; }
            
            if(document.form1.pref_name.options[document.form1.pref_name.selectedIndex].value == ""  ){
              var pref_name = document.getElementById('pref_name');
              pref_name.insertAdjacentHTML('afterend', '【！】植える場所を選択してください');
              flag = 1; }
            

            // 設定終了
            if(flag){
              //window.alert('選択されていません'); // 選択されていない場合は警告ダイアログを表示
              return false; // 送信を中止
            }
            else{
              return true; // 送信を実行
            }
            }
     </script>

        <h1>【畑に合う野菜を数値から検索】</h1>
        <p>こちらの検索は地温やPHなど測定機器をお持ちの方がより厳密な数字から今の畑に合う野菜を検索できるものです。
          <br>測定機器で様々な値を調べた後お使い下さい。</p>

         <FORM action="pro_result_recommended_vege.php" method="post" onSubmit="return check()" name="form1">

         <!-- <h2>【質問０】<br>種で植えますか？それとも苗・挿木・種芋で植えますか？</h2>
         <SELECT NAME="start" id="start" required="required">
          <OPTION SELECTED>
          <OPTION VALUE="hatsuga">種
          <OPTION VALUE="seiiku">苗・挿木・種芋
          </SELECT>

         <h2>【質問１】<br>その種（苗）をいつ植えますか？</h2>

          <SELECT NAME="month" id="month" required="required">
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

         
          <SELECT NAME="shun" id="shun" required="required">
          <OPTION SELECTED>
          <OPTION VALUE="early">上旬
          <OPTION VALUE="mid">中旬
          <OPTION VALUE="late">下旬
          </SELECT>

    <!-- （まく時から三ヶ月後の平年気温と野菜の生育適温を検索するため）
    まく月はユーザーに選んで貰ったものを出力でそのまま使えばいいがその三か月後の月は３カ月後をプログラムで自動計算して出力せねば。 -->

  <!-- <h2>【質問２】<br>あなたの畑のある場所はどこに近いですか？</h2>

          <select name="pref_name" id="pref_name" required="required">
          <option value="" selected>畑の場所</option>
          <option value="yamaguchi">山口県山口市</option>
          </select> -->

<br>
<br> -->
---------------------------------
        <h2>【質問１】<br>あなたの畑の地温は？</h2>

         <SELECT NAME="temp">
          <OPTION SELECTED>
          <?php
          for ($i=0; $i <= 35 ; $i=$i+0.5) {
            echo "<option>$i</option>";
          }
          ?>

         </SELECT>

        <h2>【質問２】<br>あなたの畑のpHは？</h2>

         <SELECT NAME="ph">
          <OPTION SELECTED>
          <?php
          for ($i=4.5; $i <= 8.5 ; $i=$i+0.1) {
            echo "<option>$i</option>";
          }
          ?>

         </SELECT>
         <br>
         <br>

    <br>
    <br>

        <INPUT type="submit" VALUE="検索">
        </FORM>

<br>
<br>

<!-- temp、pHが未選択の場合は絞り込まないようにしたい。

select id,name from vege_table; ならばすべてのレコードが出力され、絞り込まれない。
「where low_hatsuga_temp <= " . $temp . " AND high_hatsuga_temp >=" . $temp」の部分を無効化したい

ifで分岐させる？
if tempが空なら　where以下は無効
else  tempに値があれば　where 有効


＜春・秋区別やり方＞

（地温、pHを共に選択していなかった場合は「検索」ボタンを押せなくする）

地温を選ばせる（発芽適温と照合するため）
↓
pHを選ばせる
↓
どちらかだけしか選んでいなくても検索はできる
↓
「いつまくか」も選択させる（まく時から三ヶ月後の平年気温と野菜の生育適温を検索するため）
↓
「どこで」まくのか（とりあえず山口県山口市でのみとするが気象庁からデータが取れ次第選択肢を追加する）
↓
生育適温から外れる場合は　植えられないと判断し、出力しない
↓
生育適温内に三ヶ月後の平年気温が収まれば、植えられると判断し、出力
-->

<br>
<br>
<?php
$temp = $_POST["temp"];
echo "あなたの畑の地温は「 " .  $temp . " 」℃" ;
?>
<br>
<br>
<?php
  $ph = $_POST["ph"];
  echo "あなたの畑のpHは「 " . $ph . " 」"  ;
?>
<br>
<br>
  <?php
// 「どこ」で「いつまく」のかの入力で気象データを検索し、その月＋旬の平年値を取ってくる　→その平年気温と三か月後の平年値を出力
    $dsn ='mysql:dbname=vegetabledb;host=localhost';
    $user = 'vegefarmer';
    $password = 'organicfarming';

    $month = $_POST["month"];
    $shun = $_POST["shun"];
    $pref_name = $_POST["pref_name"];

      //ユーザーが選択した月の二ヶ月後の月を計算しその月の平年値を$month2という変数として定義する
      if($month >= 11){ $monthminus = $month - 12;}
       $month2 = $monthminus + 2;

    try {
      $dbh = new PDO($dsn,$user,$password);
      //同じテーブルなのだが、処理上は「y」「z」と記号を振り分け、別テーブル扱いし、それぞれを「その月」と「２ヶ月後の月」の平年値の値を比較し、春と秋を区別する。
      $sql =  "SELECT v.name
       FROM vege_table v,
       " . $pref_name . " y ,
       ". $pref_name . " z 
       WHERE 
       y.month = " . $month . " and y.shun = '" . $shun . "' z.month = " . $month2 . " and z.shun = '" . $shun . "' and v.low_seiiku_temp <= y.temp and v.high_seiiku_temp >= y.temp and v.low_seiiku_temp <= z.temp and v.high_seiiku_temp >= z.temp";

      //cold_resistant(耐寒性) があるものは「1」としてあるものは二ヶ月後の気温は考慮しないという風に「or」で別の検索をかけるようにする。
      // "SELECT v.name FROM vege_table v," . $pref_name . " y ,". $pref_name . " z WHERE ( cold_resistant = 0 and y.month = " . $month . " and y.shun = '" . $shun . "' z.month = " . $month2 . " and z.shun = '" . $shun . "' and v.low_seiiku_temp <= y.temp and v.high_seiiku_temp >= y.temp and v.low_seiiku_temp <= z.temp and v.high_seiiku_temp >= z.temp) or (cold_resistant = 1 and y.month = " . $month . " and y.shun = '" . $shun . "' z.month = " . $month2 . " and z.shun = '" . $shun . "' and v.low_seiiku_temp <= y.temp and v.high_seiiku_temp >= y.temp and v.low_seiiku_temp <= z.temp and v.high_seiiku_temp >= z.temp)";


      $user = $dbh->query($sql);
      foreach ($user as $u) {
        echo "<h2>". $pref_name . "で" . $month . "月の" . $shun . "に植え付けるならば</h2>";
        echo $u[0] . " <br>";
      }
    } catch (PDOException $e) {
      echo 'Error:'.$e->getMessage();
    }

    $dbh = null;

  ?>

<br>


<h2>↓あなたの畑に合う野菜↓</h2>

地温+pHで絞り込み

<br>
    <?php

    $dsn ='mysql:dbname=vegetabledb;host=localhost';
    $user = 'vegefarmer';
    $password = 'organicfarming';

    try {
      $dbh = new PDO($dsn,$user,$password);
      $sql = "select id,name from vege_table where low_hatsuga_temp <= " . $temp . " AND high_hatsuga_temp >=" . $temp . " AND low_ph <= " . $ph . " AND high_ph >=" . $ph ;
      $user = $dbh->query($sql);
      foreach ($user as $u) {
        echo "<a href='./each_vege_page.php?id=" .$u[0]. "  " . "'target='_blank'>" . $u[1] . "</a>"."<br>";
      }
    } catch (PDOException $e) {
      echo 'Error:'.$e->getMessage();
    }

    $dbh = null;

    ?>

<br>

    pHのみで絞り込み
    <br>
    <?php

    $dsn ='mysql:dbname=vegetabledb;host=localhost';
    $user = 'vegefarmer';
    $password = 'organicfarming';

    try {
      $dbh = new PDO($dsn,$user,$password);
      $sql ="select id,name from vege_table where low_ph <= " . $ph . " AND high_ph >=" . $ph;
      $user = $dbh->query($sql);
      foreach ($user as $u) {
        echo  "<a href='./each_vege_page.php?id=" .$u[0]. "  " . "'target='_blank'>" . $u[1] . "</a>"."<br>";
      }
    } catch (PDOException $e) {
      echo 'Error:'.$e->getMessage();
    }

    $dbh = null;

    ?>

<?php
get_footer();
?>
