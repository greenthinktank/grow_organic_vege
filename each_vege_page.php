<!-- <!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>野菜詳細ページ</title>
    <meta name="description" content="それぞれの野菜の詳細を紹介するページです">
  </head>
  <body> -->

<!-- ここから上を消して　header 挿入 -->



<?php
require_once ('../wp-blog-header.php');
get_header();
?>


    <?php
    require "connect db.php";

    // $dsn ='mysql:dbname=vegetabledb;host=localhost';
    // $user = 'vegefarmer';
    // $password = 'organicfarming';

    $id = $_GET['id'];
  

    try {
      $dbh = new PDO($dsn,$user,$password);
      $sql ='select * from vege_table v where v.id = ' . $_GET['id'];
      $sql2 ='select * from companion c where c.vege_id = ' . $_GET['id'];
      // 'select * from vege_table where id = ' . $_GET['id'];
// 'select * from vege_table v inner join companion c on v.id = c.vege_id where v.id = ' . $id;
      $user = $dbh->query($sql);
      $user2 = $dbh->query($sql2);
      foreach ($user as $u) {
        echo "<h1>" . $u['name'] ."</h1>" ."<br>";
        echo "<img src='vegephoto/" . $id . ".jpg' alt='' width='100px'><br>";
        echo "科：<a href='vege_name_search.php?ka=" . $u['ka'] . "' target='_blank'>".$u['ka'] ."</a><br>";
        echo "<br>発芽時に種に光が必要か：".$u['photoblastic'] ."<br>";
        echo "発芽に適した温度：".$u['low_hatsuga_temp'] . "℃" . "〜".$u['high_hatsuga_temp'] . "℃" ."<br>";
        echo "発芽する限界の温度：".$u['low_limit_hatsuga_temp'] . "℃" . "〜".$u['high_limit_hatsuga_temp'] . "℃" ."<br>";
        echo "<br>生育に適した温度：".$u['low_seiiku_temp'] . "℃" . "〜".$u['high_seiiku_temp'] . "℃" ."<br>";
        echo "生育できる限界温度：".$u['low_limit_temp'] . "℃" . "〜".$u['high_limit_temp'] . "℃" ."<br>";
        echo "<br>生育適性pH：".$u['low_ph'] ."〜".$u['high_ph'] ."<br>";

        echo "<br>コンパニオンプランツ：<br>";
        foreach ($user2 as $u2) {
          echo $u2['comp_name'] . "、";
        }

        echo   "<br><a href=  'fail_bbs.php?id=" . $id ." ' target='_blank'>" . $u['name'] ."の栽培失敗共有掲示板へ</a>"."<br>";

        echo "<br>栄養素：<br>".$u['nutritional_vege']  ."<br>";
        
        echo "原産地：".$u['origin']  ."<br>";
        echo "<br>メモ：<br>".$u['memo']  ."<br>";
        


      }
    } catch (PDOException $e) {
      echo 'Error:'.$e->getMessage();
    }

    $dbh = null;

     ?>

<?php
//コンパニオンプランツも出力するためのコード書いてみた

// $sql ='select * from vege_table v inner join companion c on v.id = c.vege_id where v.id = ' . $_GET['id'];

?>


<!-- ここから下をfooterのを入れてみる -->
<?php
get_footer();
?>


  <!-- </body>

</html> -->
