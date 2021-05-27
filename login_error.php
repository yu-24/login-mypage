<?php
session_start();
if(isset($_SESSION['id'])){
    header("Location:mypage.php");
}
?>

<!doctype html>
<html lang= "ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページログイン</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="register.php">新規登録</a></div>
        </header>
        <main>
            <form action="mypage.php" method="post" enctype="multipart/form-data">
                <div class="form_contents">
                    <div class="error">
                        <label>メールアドレスまたはパスワードが間違っています</label>
                    </div>
                    <div class="mail">
                        <label>メールアドレス</label><br>
                            <input type="text" class="formbox" size="40" name="mail">
                    </div>

                    <div class="password">
                        <label>パスワード</label><br>
                            <input type="text" class="formbox" size="40" name="password">
                    </div>

                    <div class="login_keep">
                        <label><input type="checkbox" class="formbox" size="40" name="login_keep" value="login_keep">ログイン状態を保持する</label>
                    </div>

                    <div class="login_mypage">
                        <input type="submit" class="login_button" size="35" value="ログイン">
                        
                    </div>
                </div>
            </form>
        </main>
        <footer>
        (c) 2018 InterNous.inc.All rights resrved
        </footer>

    </body>
</html>