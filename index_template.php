<!DOCTYPE html>
<html lang="ja">
 <head>
   <meta charset="utf-8">
   <title>掲示板（ログイン・新規登録）</title>
 </head>
 <body>
   <div class="infoMessage"><?= $info ?></div>

   <h1>ログイン</h1>
   <form action="board.php" method="post">
     <label for="email">email</label>
     <input type="email" name="email">
     <label for="password">password</label>
     <input type="password" name="password">
     <button type="submit" name ="login">ログイン</button>
   </form>
   <h1>新規登録</h1>
   <form action="signUp.php" method="post">
     <label for="email">email</label>
     <input type="email" name="email">
     <label for="password">password</label>
     <input type="password" name="password">
     <button type="submit" name="signUp">新規登録</button>
   </form>
 </body>
</html>
