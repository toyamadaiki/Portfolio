<?php
session_start();
$ID = $_POST['id'];
$answer = $_POST['answer'];

try {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'booksanta';

    $mysqli = new mysqli($host, $username, $password, $database);

    $stmt = $mysqli->prepare('UPDATE contact SET ANSWER = ? WHERE ID =?');
    $stmt->bind_param('si', $answer, $ID);
    $stmt->execute();
} catch (PDOException $e) {
    // エラー発生
    echo $e->getMessage();
} finally {
    // DBを閉じる
    $pdo = null;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>回答完了</title>
</head>
<body>
    <p>回答を送信しました</p>
    <button onclick="location.href='viewlogic.php'">OK</button>
</body>
</html>