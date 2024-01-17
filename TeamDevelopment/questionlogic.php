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
    $name = $_POST["name"];
    $question = $_POST["question"];


    // 条件指定したSQL文をセット
    $stmt = $mysqli->prepare('INSERT INTO contact(NAME, QUESTION) VALUES(?, ?)');

    // :nameと:passに対して取得した変数をセット
    $stmt->bind_param('ss', $name, $question);

    // SQL実行
    $stmt->execute();

    // DEより取得した値を配列に代入
    // $result = $stmt->get_result();
    // $rows = $result->fetch_all(MYSQLI_ASSOC);

    // 各取得値別にセッションに保存
    // $_SESSION['qlist'] = $rows;


    header('Location: viewlogic.php');

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