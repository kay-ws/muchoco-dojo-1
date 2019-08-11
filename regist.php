<?php
//HTMLのエスケープ
function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

require_once('config.php');


//セッションIDの更新
session_start();
session_regenerate_id(true);

$info = '';

//画像の処理
//元ファイル名の先頭にアップロード日時を加える
$newfilename = date("YmdHis")."-".$_FILES['fileUpload']['name'];
//ファイルの保存先
$upload = './image/' . $newfilename;
//アップロードが正しく完了したかチェック
if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], $upload)){
  $info = 'アップロード完了';
}else{
  $info = 'アップロード失敗';
}

//messageが140文字より大きい時、140文字に切る
if(mb_strlen($_POST['message']) > 140) {
  $message = mb_substr($_POST['message'], 0, 140);
} else {
  $message = $_POST['message'];
}


try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $stmt = $pdo->prepare('insert into board.posts (parentId, email, imagePath, message) values(?, ?, ?, ?)');
  $stmt->execute([$_POST['parentId'], $_POST['email'], $upload, $message]);
  $info = '投稿されました。';
} catch (\Exception $e) {
  $info = '投稿が失敗しました。';
}

require_once('board_template.php');  
?>
