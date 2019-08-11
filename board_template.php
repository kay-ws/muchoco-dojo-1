<?php
  require_once('config.php');
?>

<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>掲示板</title>
 </head>
 <body>
    <div class="infoMessage"><?= $info ?></div>

    <form action="post.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value="">
      <input type="hidden" name="parentId" value="0">
      <button type="submit" name="post">新規投稿</button>
    </form>
    <form action="logout.php" method="post">
      <button type="submit" name="logout">ログアウト</button>
    </form>
    <h1>最新の投稿10件とコメント最大10件を表示します。</h1>
<?php
    try {
      $pdo = new PDO(DSN, DB_USER, DB_PASS);
      $stmt = $pdo->prepare('select * from posts where parentId = 0 order by id DESC Limit 10');
      $stmt->execute();
    } catch (\Exception $e) {
      $info = '投稿がよみこめませんでした。';
    }
    foreach ($stmt as $row) {
?>
      <div class="post">
        <form action="post.php" method="post">
          <input type="hidden" name="parentId" value="<?= $row['id'] ?>">
          
          <h2>投稿：<?= $row['email'] ?></h2>
          <p>message:<?= $row['message'] ?></p>
          <p><img src="<?= $row['imagePath'] ?>"></p>
         <button type="submit" name="commentPost">コメントする</button>
        </form>
        <form action="delete.php" method="post">
          <input type='hidden' name="id" value="<?= $row['id'] ?>">
          <button type="submit" name="deletePost">削除</button>
        </form>
<?php
        try {
          $stmt2 = $pdo->prepare('select * from posts where parentId = ? order by id DESC');
          $stmt2->execute([ $row['id'] ]);
        } catch (\Exception $e) {
          $info = '投稿がよみこめませんでした。';
        }
        foreach ($stmt2 as $row2) {
?>
          <form action="post.php" method="post">
            <input type="hidden" name="parentId" value="<?= $row['id'] ?>">
            
            <h4>コメント：<?= $row2['email'] ?></h4>
          <p>message:<?= $row2['message'] ?></p>
          <p><img src="<?= $row2['imagePath'] ?>"></p>
            <button type="submit" name="commentPost">コメントする</button>
          </form>
          <form action="delete.php" method="post">
            <input type='hidden' name="id" value="<?= $row2['id'] ?>">
            <button type="submit" name="deletePost">削除</button>
          </form>
<?php
        }
?>        
        <hr>
      </div>
<?php
    }
?>    
</body>
</html>
