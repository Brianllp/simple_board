<h3>各ファイルの用途</h3>
<p>board_SQL.php : 投稿、削除、編集、パスワード機能付き掲示板本体</p>
<p>board_edit_SQL.php : 投稿編集用フォーム</p>
<p>login_form.php : ログイン用フォーム</p>
<p>login_judge.php : ログイン成功の可否</p>
<p>register.php :会員登録用フォーム</p>
<p>register_comfirmation :会員登録内容の確認ページ</p> 
<h3>nakazato</h3>

<h3>掲示板利用までの流れ</h3>
<ol>
  <li>会員登録フォームで名前、パスワードを設定</li>
  <li>会員登録が完了するとIDが発行される</li>
  <li>発行されたIDとパスワードを入力してログイン</li>
  <li>ログイン後に掲示板へ遷移</li>
</ol>
<p>1.で登録した名前は、セッションを利用し、掲示板の投稿時に名前欄に自動で入力される仕様となっている。</p>
