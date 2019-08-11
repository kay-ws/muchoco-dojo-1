<?php
//HTMLのエスケープ
function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

//セッション開始とid再割り当て
require_once('config.php');


//セッションIDの更新
session_start();
session_regenerate_id(true);

if (isset($_POST['post'])) {
  $header = "投稿：";
} else {
  $header = "コメント：";
}

$parentId = h($_POST['parentId']);
$info = '';
?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>掲示板（投稿）</title>
 </head>
 <body>
   <div class="infoMessage"><?= $info ?></div>

   <h1><?= $header ?><?= $_SESSION['email'] ?></h1>
   <form action="regist.php" method="post" enctype="multipart/form-data" >
      <input type="hidden" name="email" value="<?= $_SESSION['email']?>">
      <input type="hidden" name="parentId" value="<?= $parentId ?>">
      <input type="text" name="message"><br>
      <input type="file" name="fileUpload"><br>
      <button type="submit" name ="regist">投稿</button>
   </form>
 </body>
</html>
