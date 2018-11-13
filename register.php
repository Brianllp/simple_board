<!--ユーザー情報の登録フォーム-->
<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">

	<title>登録フォーム</title>
	</head>

	<body>

	<h2>登録フォーム</h2>
    <p>名前とパスワードを登録して下さい</p>
	<form action="register_confirmation.php" method="POST">
	名前：<br />
	<input type="text" name="register_name" /><br />
	パスワード：<br/>
	<input type="text" name="register_pass"><br/>
	<input type="submit" name="register_send" value="登録" />
	</form>

	</body>
</html>