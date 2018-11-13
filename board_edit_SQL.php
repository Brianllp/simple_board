<?php
//編集番号のDB中の投稿データを取得する
$edit_num = $_POST["edit_num"];

try{
	$dbh = new PDO("mysql:dbname=XXXXX", "XXXXX.", "XXXXX");
	$st = $dbh->query("SELECT * FROM toukou WHERE id = $edit_num");
    $row = $st->fetch();
}catch(PDOException $e){
	print('Error:'.$e->getMessage());
    die();
}
?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">

	<title>編集フォーム</title>
</head>

<body>
    <p>名前とコメントを編集してください。</p>

    <form action="board_SQL.php" method="POST">

    名前：<br />
    <input type="text" name="edit_name" value = <?php echo $row[1]; ?>><br />
    コメント：<br />
    <textarea name="edit_comment" rows="5"><?php echo $row[2]; ?></textarea><br />
    パスワード：<input type="text" name="edit_pass"><br/>
    <input type="hidden" name="edit_contents" value = <?php echo $row[0]; ?> />
    <input type="submit" name="edit_word_send" value = "送信" />

    </form>

</body>
</html>