<?php

try {
    
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'booksanta';
    
    // データベースに接続
    $mysqli = new mysqli($host, $username, $password, $database);

    // ログイン画面でセッションに保存した内容を変数に格納
    session_start();
    $type = $_SESSION['TYPE'];

    $name = $_POST["name"];

    // 条件指定したSQL文をセット
    $stmt = $mysqli->prepare('SELECT ID, QUESTION, ANSWER FROM contact WHERE NAME like ?');

    // (3) 値をセット
	if($name == '') {
		$name = "%";
	}

    // :nameと:passに対して取得した変数をセット
    $stmt->bind_param('s', $name);

    // SQL実行
    $stmt->execute();

    // DEより取得した値を配列に代入
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // 各取得値別にセッションに保存
    $_SESSION['qlist'] = $rows;

    if($_SESSION['TYPE'] == "本部"){
        
        // 値が入っているなら本部用テストページ画面へ偏移
        header('Location: contacta.php');

    }else if($_SESSION['TYPE'] == "店舗"){

        // 値が入っているなら店舗用テストページ画面へ偏移
        header('Location: contactq.php');
    
    }

    // 動作を終了
    exit;

} catch (PDOException $e) {
    // エラー発生
    echo $e->getMessage();

} finally {
    // DBを閉じる
    $pdo = null;
}

?>