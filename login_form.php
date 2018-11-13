<!--登録情報の確認-->
<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">

	<title>ログインフォーム</title>
	</head>

	<body>

    <p>IDとパスワードを入力してください</p>

    <form action="login_judge.php" method="POST">
	ID：<br />
	<input type="text" name="login_id" ><br />
	パスワード：<br/>
	<input type="text" name="login_pass"><br/>
	<input type="submit" name="login_send" value="送信" />
	</form>

	</body>
</html>