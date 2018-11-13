<?php
session_start();

//DBへ接続
date_default_timezone_set('Asia/Tokyo'); //タイムゾーンの指定
$name = $_POST["name"];
$comment = $_POST["comment"];
$date = date("Y/m/d H:i:s");
$toukoupass = $_POST["toukou_pass"];
$toukou_file = $_FILES["file_upload"];
try{
	$dbh = new PDO("mysql:dbname=XXXXX", "XXXXX", "XXXXX");
}catch(PDOException $e){
	print('Error:'.$e->getMessage());
    die();
}


//DBに投稿内容を格納する
if (isset($_POST["word_send"])){

	$stmt = $dbh -> prepare("INSERT INTO toukou (name, comment, date, password, file) VALUES (:name, :comment, :date, :password, :file)");
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':date', $date, PDO::PARAM_STR);
	$stmt->bindParam(':password', $toukoupass, PDO::PARAM_STR);
	$stmt->bindParam(':file', $toukou_file, PDO::PARAM_STR);

	$stmt->execute();
}

//削除処理
//DB中の投稿データを取得する
$delete_num = $_POST["delete_num"];
$delete_pass = $_POST["delete_pass"];

if (isset($_POST["delete_send"])) {

	try{
		$dbh = new PDO("mysql:dbname=XXXXX", "XXXXX", "XXXXX");
		$st = $dbh->query("SELECT * FROM toukou WHERE id = $delete_num");
		$row = $st->fetch();
	}catch(PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}

	if ($delete_pass == $row[4]){
		$sql = 'DELETE FROM toukou where id = :delete_num';
		$stmt = $dbh -> prepare($sql);
		$stmt -> bindParam(':delete_num', $delete_num, PDO::PARAM_INT);
		$stmt -> execute();
	}
}

//編集処理
if (isset($_POST["edit_word_send"] , $_POST["edit_pass"])){

	$edit_num = $_POST["edit_contents"];  
	$edit_pass = $_POST["edit_pass"]; 
	$name = $_POST["edit_name"];
	$comment2 = $_POST["edit_comment"];

	try{
		$dbh = new PDO("mysql:dbname=XXXXX", "XXXXX", "XXXXX");
		$st = $dbh->query("SELECT * FROM toukou WHERE id = $edit_num");
		$row = $st->fetch();
	}catch(PDOException $e){
		print('Error:'.$e->getMessage());
		die();
	}

	if ($edit_pass == $row[4]){
		$sql = 'UPDATE toukou SET name =:name2 WHERE id = :edit_num';
		$stmt_name = $dbh -> prepare($sql);
		$stmt_name -> bindParam(':edit_num', $edit_num, PDO::PARAM_INT);
		$stmt_name -> bindParam(':name2', $name, PDO::PARAM_STR);
		$stmt_name -> execute();

		$sql2 = 'UPDATE toukou SET comment =:comment2 WHERE id = :edit_num2';
		$stmt_comment = $dbh -> prepare($sql2);
		$stmt_comment -> bindParam(':edit_num2', $edit_num, PDO::PARAM_INT);
		$stmt_comment -> bindParam(':comment2', $comment2, PDO::PARAM_STR);
		$stmt_comment -> execute();
	}
}

?>

<!--掲示板の送信フォーム-->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">

	<title>簡易掲示板</title>
	</head>

	<body>
	<h2>簡易掲示板</h2>
	<form action=""  method="POST">
	名前：<br />
	<input type="text" name="name" value = <?php echo $_SESSION["username"] ; ?>><br />
	コメント：<br />
	<textarea name="comment" rows="5"></textarea><br />
	パスワード：<br/>
	<input type="text" name="toukou_pass"><br/>
	<input type="submit" name="word_send" value="送信" />
	</form>

    <form action="" method="POST"> 
    <br/>削除対象番号：<input type="text" name="delete_num"> 
	<br/>パスワード：<input type="text" name="delete_pass"><br/>
    <input type="submit" name="delete_send" value="削除">
    </form>

	<form action="board_edit_SQL.php" method="POST"> 
    <br/>編集対象番号：<input type="text" name="edit_num">
    <input type="submit" name="edit_send" value="編集">
    </form>


	</body>
</html>



<?php
//DB中の投稿データを取得し、表示させる
try{
	$dbh = new PDO("mysql:dbname=XXXXX", "XXXXX", "XXXXX");
	$st = $dbh->query("SELECT * FROM toukou");
	while ($row = $st->fetch()) {
	  $id = htmlspecialchars($row['id']);
	  $name = htmlspecialchars($row['name']);
	  $comment = htmlspecialchars($row['comment']);
	  $date = htmlspecialchars($row['date']);
	  $password = htmlspecialchars($row['password']);
	  echo "$id</br>$name</br>$comment</br>$date</br>";
	}

}catch(PDOException $e){
	print('Error:'.$e->getMessage());
    die();
}
?>