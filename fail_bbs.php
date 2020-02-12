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
?>

<?php
$title = "";
$name = "";
$vege = "";
$message = "";

//セキュリティのためのエスケープ処理
// function h($s) {
//     return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
// }

if(isset($_POST['send']) === true){
    $title = $_POST["title"];
    $name = $_POST["name"];
    $vege = $_POST["vege"];
    $vege_value = preg_split("/[:]/", $vege);
    $message = $_POST["message"];
   #テキストファイルに$name,$messageを書き込む処理
   //もしもmessageが空でない場合に以下の処理をしなさい。空の場合はしない
   if($message !== ''){
    //nameが空の場合は「名無しさん」と勝手に名前をつける
    $name = ($name === '') ? 'no name' : $name;

    //nameやmessageに投稿で「\t」が入力された時に「空白」で置き換えるように
    $title = str_replace("\t", ' ', $title);
    $neme = str_replace("\t", ' ', $name);
    $message = str_replace("\t", ' ', $message);

    //投稿時刻日付も自動でつける
    $postedAt = date('Y-m-d H:i:s');


    //--------------------------------------
    //DBにinsertするためのコード
    // INSERT文を変数に格納
    $sql = "INSERT INTO bbs ( title, name, vege_id, vege, message, postedAt) VALUES (:title, :name, :vege_id, :vege, :message, :postedAt)";
    
    // 挿入する値は空のまま、SQL実行の準備をする
    $stmt = $dbh->prepare($sql);
    
    // 挿入する値を配列に格納する
    $params = array(':title' => $title,':name' => $name, ':vege_id' => $vege_value[0],  ':vege' => $vege_value[1], ':message' => $message, ':postedAt' => $postedAt);
    
    // 挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params);
    
    // 登録完了のメッセージ
    echo '登録完了しました';
    //----------------------------------
    }
}

?>

<?php
//添付ファイルのアップロード

define( "FILE_DIR", "./upfiles/");

	// ファイルのアップロード
	if( !empty($_FILES['attachment_file']['tmp_name']) ) {

		$upload_res = move_uploaded_file( $_FILES['attachment_file']['tmp_name'], FILE_DIR.$_FILES['attachment_file']['name']);

		if( $upload_res !== true ) {
			$error[] = 'ファイルのアップロードに失敗しました。';
		} else {
			$clean['attachment_file'] = $_FILES['attachment_file']['name'];
		}
	}


?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>失敗共有掲示板</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


</head>
<body>
  <h1>失敗共有掲示板</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="element_wrap">
        <label>写真投稿</label>
        <input type="file" name="attachment_file">
        </div>
        <div>
            <label for="title">題名</label>
            <input type="text" id="title" name="title" required="required">
        </div>
        <div>
            <label for="name">名前</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="name">野菜名</label>
        <SELECT id="vege" NAME="vege" required="required">
          <OPTION SELECTED>
          <?php
            // SELECT文を変数に格納
            $sql = "SELECT id, name FROM vege_table order by id desc";
            
            // SQLステートメントを実行し、結果を変数に格納
            $stmt = $dbh->query($sql);
            
            // foreach文で配列の中身を一行ずつ出力
            foreach ($stmt as $row) {
            
              // データベースのフィールド名で出力
              echo  "<option value='" . $row['id'] . ":" . $row['name']. "'>". $row['name']. "</option>";
            
              // 改行を入れる
              echo '<br>';
            }
          ?>
        </SELECT>
        </div>

        <div>
            <label for="message">内容</label>
            <input type="text" id="message" name="message" size="70" required="required">
        </div>
        <br>
        <input type="submit" name="send" value="投稿">
    </form>


      <h2>表示欄</h2>
      <?php
        // SELECT文を変数に格納
        $sql = "SELECT * FROM bbs";
        
        if(isset($_GET["id"])){
          $sql .= " where vege_id = " . $_GET["id"];
        }

        $sql .=  " order by id desc";

        // SQLステートメントを実行し、結果を変数に格納
        $stmt = $dbh->query($sql);
        
        // foreach文で配列の中身を一行ずつ出力
        foreach ($stmt as $row) {
        
          // データベースのフィールド名で出力
          echo  '【題】 '. $row['title'].'<br>【名前】 '.$row['name'].' 【野菜名】 <a href=" fail_bbs.php?id='. $row['vege_id'] .'" target="_blank">'.$row['vege'].'</a><br>'.$row['message'].'<br>【投稿日】'.$row['postedAt'] . '<br> 
           <form><input type="button" value="削除する" onClick="deletePost(' . $row['id'] . ');"></form><br>';
        
          // 改行を入れる
          echo '<br>';
        }
      ?>


 <script>

function deletePost($id){
		if(window.confirm("本当に削除しますか？")){
		$.ajax({
			type:"POST",
			url:"deletepost.php",
			data:{"id":$id,
				 },
			success: function(data){}
		});
		}
	}
 </script>


</body>
</html>
