<?php
mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['id'])){

    try{
        $pdo= new PDO("mysql:dbname=lesson01;host=localhost;","root","");
    }catch(PDOException $e){
        die("<p>申し訳ございません。現在サーバーが込み合っており一時的にアクセスができません。<br>しばらくしてから再度ログインをしてください。</p>
        <a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>"
        );
    }

    //prepared statementでSQL文の型を作る（DBとpostのデータを照合させる。）
    $stmt = $pdo -> prepare("select * from login_mypage where mail =? && password=?");


    //bindValueメソッドでパラメータをセット
    $stmt->bindValue(1,$_POST["mail"]);
    $stmt->bindValue(2,$_POST["password"]);


    //executeでクエリを実行
    $stmt->execute();

    //データベースを切断
    $pdo = NULL;

    //fetch.while文でデータ取得し、sessionに代入
    while($row = $stmt -> fetch()){
        $_SESSION['id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['mail'] = $row['mail'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['picture'] = $row['picture'];
        $_SESSION['comments'] = $row['comments'];
    }

    //データが取得できずに(emptyを使用して判断)sessionがなければ、リダイレクト(エラー画面へ)
    if(empty($_SESSION['id'])){
        header("Location:login_error.php");
    }
    //ログイン状態ならsessionにもloginkeepの値を保存
    if(!empty($_POST['login_keep'])){
        $_SESSION['login_keep']=$_POST['login_keep'];
    }

//cookieの設定
if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
}else if(empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
}


}

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="mypage.css">
    </head>
    <body>
    <header>
        <img src="4eachblog_logo.jpg">
        <div class="logout"><a href="log_out.php">ログアウト</a></div>
    </header>
    <main>
        <div class="form_contents">
            <h2>会員情報</h2>
            <div class="hello">
                <?php echo"こんにちは！" .$_SESSION['name']."さん"; ?>
            </div>
            <div class="info">
            <div class="profile_pic">
                <img src="<?php echo $_SESSION['picture']; ?>"> 
            </div>
            <div class="basic_info">
                <p>氏名:<?php echo $_SESSION['name']; ?></p>
                <p>メール:<?php echo $_SESSION['mail']; ?></p>
                <p>パスワード:<?php echo $_SESSION['password']; ?></p>
            </div>
            </div>
            <div class="comments">
                <?php echo $_SESSION['comments']; ?></label>
            </div>
            <form action="mypage_hansyu.php" method="post" class="form_center">
                <input type="hidden" value="<?php echo rand(1,10); ?>" name="form_mypage" >
                <div class="edit_button">
                    <input type="submit" class="hensyubutton" size="35" value="編集">
                </div>
            </form>
        </div>
        
    </main>

    <footer>
    <p>(c) 2018 InterNous.inc.All rights resrved</p>
    </footer>

    </body>

</html>