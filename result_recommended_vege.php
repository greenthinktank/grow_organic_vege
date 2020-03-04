<!-- <!DOCTYPE html>
<html lang="ja">
  <head>
    <meta name="description" content="あなたの畑に適している野菜を検索することができます。" charset="utf-8">
    <title>あなたの畑にオススメ野菜一覧・検索結果</title>

  </head>

  <body> -->

  <?php
require_once ('../wp-blog-header.php');
get_header();
?>

   <h1>【あなたの畑に合う野菜オススメ一覧・検索結果】</h1>


    <?php
        $month = $_POST["month"];
        $month_b = $month;
        $shun = $_POST["shun"];
        $pref_name = $_POST["pref_name"];


        //$shunを日本語に書き換える
        if($shun == 'early'){
           $shunname = '上旬';
        }elseif($shun == 'mid'){
          $shunname = '中旬';
        }else{
          $shunname = '下旬';
        }

        //ユーザーが選択した月の二ヶ月後の月を計算しその月の平年値を$month2という変数として定義する
        if($month >= 11){ $month_b = $month - 12;}
        $month2 = $month_b + 2;



      // ここにpref name  のsql分をいれる
      require "connect db.php";
      try {
        $dbh = new PDO($dsn,$user,$password);
  
        $sql = 'SELECT japanese_name FROM pref_name where value = "' . $_POST["pref_name"] . '"';
  
        $user = $dbh->query($sql);
        foreach ($user as $u) {
          $j_name = $u[0];
        }
      } catch (PDOException $e) {
        echo 'Error:'.$e->getMessage();
      }
      $dbh = null;



      echo "<h2>". $j_name . "で" . $month . "月" . $shunname . "の植え付けに適した野菜は</h2>";

    // 「どこ」で「いつまく」のかの入力で気象データを検索し、その月＋旬の平年値を取ってくる　→その平年気温と三か月後の平年値を出力

    //接続するデータベースの指示
    require "connect db.php";

    try {
      $dbh = new PDO($dsn,$user,$password);

        //同じテーブルなのだが、処理上は「y」「z」と記号を振り、別テーブル扱いし、それぞれを「その月」と「２ヶ月後の月」の平年値の値を比較し、春と秋を区別する。
        // cold_resistant(耐寒性) があるものは「1」としてあるものは二ヶ月後の気温は考慮しないという風に「or」で別の検索をかけるようにする。
        $sql =
        "SELECT v.id,v.name 
        FROM 
        vege_table v ,
        " . $pref_name . " y ,
        ". $pref_name . " z 
        WHERE
         (v.cold_resistant = 0 
         and 
         y.month = " . $month . " and
          y.shun = '" . $shun . "' and 
          z.month = " . $month2 . " and 
          z.shun = '" . $shun . "' and 
         v.low_limit_temp <= y.temp and 
         v.high_limit_temp >= y.temp and 
         v.low_limit_temp <= z.temp and 
         v.high_limit_temp >= z.temp) 
         or
         (v.cold_resistant = 1 
         and
         y.month = " . $month . " and 
         y.shun = '" . $shun . "' and 
         z.month = " . $month2 . " and 
         z.shun = '" . $shun . "' and 
         v.low_limit_temp <= y.temp and 
         v.high_limit_temp >= y.temp and 
         v.high_limit_temp >= z.temp)";

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


<h2>↓地温 と pH でさらに詳しく絞り込み↓</h2>
<?php
$temp = $_POST["temp"];
echo "あなたの畑の地温は「 " .  $temp . " 」℃で、" ;

  $ph = $_POST["ph"];
  echo "pHは「 " . $ph . " 」なので、植え付けに適している野菜は"  ;
?>
<br>
<br>
    <?php

    //接続するデータベースの指示
    require "connect db.php";

    try {
      $dbh = new PDO($dsn,$user,$password);
      $sql = 
      "SELECT v.id,v.name 
      FROM 
      vege_table v ,
      " . $pref_name . " y ,
      ". $pref_name . " z 
      WHERE
       (v.cold_resistant = 0 
       and 
       y.month = " . $month . " and
        y.shun = '" . $shun . "' and 
        z.month = " . $month2 . " and 
        z.shun = '" . $shun . "' and 
       v.low_limit_temp <= y.temp and 
       v.high_limit_temp >= y.temp and 
       v.low_limit_temp <= z.temp and 
       v.high_limit_temp >= z.temp and
       v.low_limit_temp <= " . $temp . " AND 
       v.high_limit_temp >= " . $temp . " AND 
       v.low_ph <= " . $ph . " AND 
       v.high_ph >=" . $ph . ") 
       or
       (v.cold_resistant = 1 
       and
       y.month = " . $month . " and 
       y.shun = '" . $shun . "' and 
       z.month = " . $month2 . " and 
       z.shun = '" . $shun . "' and 
       v.low_limit_temp <= y.temp and 
       v.high_limit_temp >= y.temp and 
       v.high_limit_temp >= z.temp and 
       v.low_limit_temp <= " . $temp . " AND 
       v.high_limit_temp >=" . $temp . " AND 
       v.low_ph <= " . $ph . " AND 
       v.high_ph >=" . $ph . ")";


      $user = $dbh->query($sql);
      foreach ($user as $u) {
        echo "<a href='./each_vege_page.php?id=" .$u[0]. "  " . "'target='_blank'>" . $u[1] . "</a>"."<br>";
      }
    } catch (PDOException $e) {
      echo 'Error:'.$e->getMessage();
    }

    $dbh = null;

    ?>
    <?php
    get_footer();
    ?>
