<?php
//DBへ接続
$register_name = $_POST["register_name"];
$register_pass = $_POST["register_pass"];

try{
	$dbh = new PDO("mysql:dbname=XXXXX", "XXXXX", "XXXXX");
}catch(PDOException $e){
	print('Error:'.$e->getMessage());
    die();
}


//DBにユーザー情報を格納する
if (isset($_POST["register_send"])){

	$stmt = $dbh -> prepare("INSERT INTO user_data (name, password) VALUES (:name, :password)");
	$stmt->bindParam(':name', $register_name, PDO::PARAM_STR);
	$stmt->bindParam(':password', $register_pass, PDO::PARAM_STR);

    $stmt->execute();

    $stmt->closeCursor();

   //DBのユーザー情報を呼び出す
    try{
        $dbh = new PDO("mysql:dbname=XXXXX", "XXXXX", "XXXXX");
        $st = $dbh->prepare("SELECT * FROM user_data WHERE name = ? AND password = ?");

        $st -> execute(array($register_name, $register_pass));

        $row = $st->fetch();
    }catch(PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }

}

?>

<!--登録情報の確認-->
<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">

	<title>登録が完了しました</title>
	</head>

	<body>

    <p>登録が完了しました</p>
	<form action="login_form.php" method="POST">
    id：<?php echo $row[0]; ?><br />
	名前：<?php echo $row[1]; ?><br />
	<input type="submit" name="move" value="ログインする" />
	</form>

	</body>
</html>