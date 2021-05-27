<?php
mb_internal_encoding("utf8");

$temp_pic_name = $_FILES['picture']['tmp_name'];

$original_pic_name = $_FILES['picture']['name'];
$path_filename = './image/'.$original_pic_name;

move_uploaded_file($temp_pic_name,'./image/'.$original_pic_name);

?>

<!doctype html>
<html lang="jp">
    <head>
        <title>マイページ登録</title>
        <link rel ="stylesheet" type="text/css" href="register_confirm.css">
    </head>
    <body>
    <header>
        <img src="4eachblog_logo.jpg">
    </header>
    <main>
        <div class="form_contents">
            <h2>会員登録確認</h2>
            <p>こちらの内容で登録しても宜しいでしょうか？</p>

            <div class="name">
                <label>氏名:<?php echo $_POST['name']; ?></label><br>
                   
            </div>

            <div class="mail">
                <label>メールアドレス:<?php echo $_POST['mail']; ?></label><br>
                   
            </div>

            <div class="password">
                <label>パスワード:<?php echo $_POST['password']; ?></label><br>
            </div>
            
            <div class="picture">
                <label>プロフィール写真:<img src="<?php echo $path_filename; ?>"> </label> <br>
            </div>
            
            <div class="comments">
                <label>コメント:<?php echo $_POST['comments']; ?></label><br>
                    
            </div>

            <div class="toroku">

                <form action="register.php">
                    <input type="submit" class="fix_button" size="35" value="戻って修正する">
                </form>

                <form action="register_insert.php" method="post" >
                    <input type="submit" class="submit_button" size="35" value="登録する">
                    <input type="hidden" value="<?php echo $_POST['name']; ?>" name="name">
                    <input type="hidden" value="<?php echo $_POST['mail']; ?>" name="mail">
                    <input type="hidden" value="<?php echo $_POST['password']; ?>" name="password">
                    <input type="hidden" value="<?php echo $path_filename ?>" name="path_filename">
                    <input type="hidden" value="<?php echo $_POST['comments']; ?>" name="comments">
                </form>
            </toroku>

        </div>
        
    </main>
    <footer>
    <p>(c) 2018 InterNous.inc.All rights resrved</p>
    </footer>
    </body>

</html>