<?php
//HTMLのエスケープ
function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

//セッション開始とid再割り当て
session_start();
session_regenerate_id(TRUE);

//ログイン済みの場合
if (isset($_SESSION['EMAIL'])) {
  echo h($_SESSION['EMAIL']) . 'さん<br>';
  echo "<a href='logout.php'>ログアウトはこちら。</a>";
  exit;
}

$info ='';

require_once('index_template.php');
?>
