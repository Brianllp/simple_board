<!--登録情報の確認-->
<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">

	<title>ログイン確認</title>
	</head>

	<body>

    <?php

    $login_id = $_POST["login_id"];
    $login_pass = $_POST["login_pass"];

    //IDとパスワードをDBから参照し、呼び出す
    try{
        $dbh = new PDO("mysql:dbname=XXXXX", "XXXXX", "XXXXX");
        $st = $dbh->prepare("SELECT * FROM user_data WHERE id = ? AND password = ?");

        $st -> execute(array($login_id, $login_pass));

        $row = $st->fetch();
    }catch(PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }

    //ログイン情報が正しければ掲示板へ遷移
    if (isset($_POST[login_send]) && $row[0] !=null && $row[2] != null):
    
        session_start();
        $_SESSION["username"] = $row[1];
    ?>
        <p>ログインに成功しました</p>
        <form action="board_SQL.php" method="POST">
        <input type="submit" name="move_from_login_correct" value="掲示板へ" />
        </form>
    
    <?php else: ?>

        <p>IDまたはパスワードが違います。</p>
        <form action="login_form.php" method="POST">
        <input type="submit" name="move_from_login_wrong" value="再度ログインする" />
        </form>

    <?php endif; ?>

	</body>
</html>