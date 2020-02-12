<?php 
// データベースに接続するために必要なデータソースを変数に格納
// mysql:host=ホスト名;dbname=データベース名;charset=文字エンコード
$dsn = 'mysql:host=localhost;dbname=vegetabledb;charset=utf8';
  // データベースのユーザー名
$user = 'vegefarmer';
  // データベースのパスワード
$password = 'organicfarming';
// tryにPDOの処理を記述

  try {
    // PDOインスタンスを生成
    $dbh = new PDO($dsn, $user, $password);
  
  // エラー（例外）が発生した時の処理を記述
  } catch (PDOException $e) {
   
    // エラーメッセージを表示させる
    echo 'データベースにアクセスできません！' . $e->getMessage();
   
    // 強制終了
    exit; 
  }

  $id = $_POST["id"];

  $sql = "delete from bbs  where id = :id";

  // 挿入する値は空のまま、SQL実行の準備をする
  $stmt = $dbh->prepare($sql);
  
  // 挿入する値を配列に格納する
  $params = array(':id' => $id);

  // 挿入する値が入った変数をexecuteにセットしてSQLを実行
  $stmt->execute($params);
  
  // 登録完了のメッセージ
  echo '投稿を削除しました';

?>