<!-- <!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" name="description" content="野菜を名前から探そう。">
    <title>野菜名から探す</title>
  </head>
  <body> -->

  <?php
require_once ('../wp-blog-header.php');
get_header();
?>

    <h1>野菜一覧</h1>

<h2><?php $ka = $_GET['ka']; echo "【同じ" . $ka . "科の野菜たち】"?></h2>

<?php
require "connect db.php";

// $dsn ='mysql:dbname=vegetabledb;host=localhost';
// $user = 'vegefarmer';
// $password = 'organicfarming';


try {
  $dbh = new PDO($dsn,$user,$password);

  $sql = "SELECT id,name, ka  FROM vege_table";
        
  if(isset($_GET["ka"])){
    $sql .= " where ka = '" . $ka . "'";
  }else{
    $sql .= " order by ka, name";
  }

  $user = $dbh->query($sql);
  foreach ($user as $u) {
    
    echo  $u[2] . "科 ：&nbsp; <b><a href='./each_vege_page.php?id=" . $u[0] . "'target='_blank'>  " . $u[1] . "</a></b><br>";
  }
} catch (PDOException $e) {
  echo 'Error:'.$e->getMessage();
}

$dbh = null;

?>



<?php

// if ( $beforeka != $u[2]){
// echo <h3>$u[2]</h3>
// }



// こんな感じでしょうか？
// if(科がgetされていたら){
// その科と同じ科(where ka = $ka)の野菜を出力する
// }
// else{
// 野菜を全て科ごとに分類し、一覧にする
// }

    // if(isset($_GET["ka"])){
    //   try{$sql = "SELECT id,name, ka  FROM vege_table where ka =" . '$ka';}
    // }
    // else{
    //   try{$sql = "SELECT id,name, ka  FROM vege_table;}

  //野菜全てを科ごとに出力する
  //select id,name,ka from vege_table;
?>








<!-- <h3>マメ科</h3> -->
<?php

// $dsn ='mysql:dbname=vegetabledb;host=localhost';
// $user = 'vegefarmer';
// $password = 'organicfarming';

// try {
//   $dbh = new PDO($dsn,$user,$password);
//   $sql ="select id,name, ka from vege_table where ka = 'マメ'";
//   $user = $dbh->query($sql);
//   foreach ($user as $u) {
//     echo "<a href='./each_vege_page.php?id=" . $u[0] . "'target='_blank'>" . $u[1] . "</a>". "：" . $u[2] . "科"."<br>";
//   }
// } catch (PDOException $e) {
//   echo 'Error:'.$e->getMessage();
// }

// $dbh = null;

?>

<?php
get_footer();
?>


  <!-- </body>
</html> -->
