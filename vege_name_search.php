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

<h1>データを見たい野菜名を入れて下さい</h1>

<h4>入力は「カタカナ（全角）」のみ</h4>

<form action="result_typing_name_search.php" method="post">
   <!-- 任意の<input>要素＝入力欄などを用意する -->
   <input type="text" name="vege_name">
   <!-- 送信ボタンを用意する -->
   <input type="submit" name="submit" value="野菜名を検索">
</form>

<h1>野菜一覧</h1>

<?php 

if(isset($_GET["ka"])){

$ka = $_GET["ka"]; 

echo "<h2>【同じ" . $ka . "科の野菜たち】</h2>";
}

?>

<?php
require "connect db.php";
// $dsn ='mysql:dbname=vegetabledb;host=localhost';
// $user = 'vegefarmer';
// $password = 'organicfarming';


//一覧を表示するsqlとphp文
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








<!-- <h2>検索結果</h2> -->
<?php
// //postの値受け取り
// $vege_name = $_POST["vege_name"];

// //DBへの接続
// require "connect db.php";

// //検索窓で検索された野菜を表示するためのsqlとphp文
// try {
//   $dbh = new PDO($dsn,$user,$password);

//   $sql = "SELECT id,name, ka  FROM vege_table where name like '%" . $_POST["vege_name"] . "%' order by ka, name";


//   $user = $dbh->query($sql);
//   foreach ($user as $u) {
    
//     echo  $u[2] . "科 ：&nbsp; <b><a href='./each_vege_page.php?id=" . $u[0] . "'target='_blank'>  " . $u[1] . "</a></b><br>";
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
