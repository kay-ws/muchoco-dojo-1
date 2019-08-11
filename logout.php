<?php
session_start();
session_regenerate_id(TRUE);

if (isset($_SESSION["EMAIL"])) {
  $info = 'Logoutしました。';
} else {
  $info = 'SessionがTimeoutしました。';
}
//セッション変数のクリア
$_SESSION = array();
//セッションクッキーも削除
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
//セッションクリア
@session_destroy();

require_once('index.php');
?>
