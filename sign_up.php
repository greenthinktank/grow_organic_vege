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
$name = "";
$nickname = "";
$prefecture = "";
$town = "";
$password = "";
$email = "";

//セキュリティのためのエスケープ処理
// function h($s) {
//     return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
// }

if(isset($_POST['send']) === true){
    $name = $_POST["name"];
    $nickname = $_POST["nickname"];
    $prefecture = $_POST["prefecture"];
    $town = $_POST["town"];
    $password = $_POST["password"];
    $email = $_POST["email"];

   #テキストファイルに$name,$messageを書き込む処理
   //もしもmessageが空でない場合に以下の処理をしなさい。空の場合はしない
   if($name !== '' && $nickname !== '' && $prefecture !== '' && $town !== '' && $password !== '' && $email !== ''){
    
    // //nameが空の場合は「名無しさん」と勝手に名前をつける
    // $name = ($name === '') ? 'no name' : $name;

    //各項目に投稿で「\t」が入力された時に「空白」で置き換えるように
    $name = str_replace("\t", ' ', $name);
    $nickname = str_replace("\t", ' ', $nickname);
    $prefecture = str_replace("\t", ' ', $prefecture);
    $town = str_replace("\t", ' ', $town);
    $password = str_replace("\t", ' ', $password);
    $email = str_replace("\t", ' ', $email);

    //登録時刻日付も自動でつける
    $postedAt = date('Y-m-d H:i:s');


    //--------------------------------------
    //DBにinsertするためのコード
    // INSERT文を変数に格納
    $sql = "INSERT INTO bbs ( name, nickname, prefecture, town, password, email, postedAt) VALUES (:name, :nickname, :prefecture, :town, :password, :email, :postedAt)";
    
    // 挿入する値は空のまま、SQL実行の準備をする
    $stmt = $dbh->prepare($sql);
    
    // 挿入する値を配列に格納する
    $params = array(':name' => $name, ':nickname' => $nickname, ':prefecture' => $prefecture, ':town' => $town, ':password' => $password, ':email' => $email, ':postedAt' => $postedAt);
    
    // 挿入する値が入った変数をexecuteにセットしてSQLを実行
    $stmt->execute($params);
    
    // 登録完了のメッセージ
    echo '会員登録完了しました';
    //----------------------------------
    }

}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
</head>
<body>
  <h1>新規登録</h1>
    <form action="" method="post">
        <div>
            <label for="name">名前</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="nickname">ニックネーム</label>
            <input type="text" id="nickname" name="nickname">
        </div>
        <div>
            <label for="prefecture">住んでいる県</label>
            <input type="text" id="prefecture" name="prefecture">
        </div>
        <div>
            <label for="town">住んでいる市町村</label>
            <input type="text" id="town" name="town">
        </div>
        <div>
            <label for="password">パスワード</label>
            <input type="text" id="password" name="password">
        </div>
        <div>
            <label for="email">e-mailアドレス</label>
            <input type="text" id="email" name="email">
        </div>
        <br>
        <br>
        <input type="submit" name="send" value="登録確認">
    </form>

</body>
</html>
