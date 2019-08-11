<?php
//HTMLのエスケープ
function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

//セッション開始とid再割り当て
session_start();
session_regenerate_id(true);
require_once('config.php');

$info ='';
//該当idのレコードを削除
try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
  $stmt = $pdo->prepare('delete from board.posts where id = ?');
  $stmt->execute([$_POST['id']]);
  $stmt2 = $pdo->prepare('delete from board.posts where parentId = ?');
  $stmt2->execute([$_POST['id']]);
  $info = "削除に成功しました。";
} catch (\Exception $e) {
  $info = "削除に失敗しました。";
}

require_once('board_template.php');
?>
