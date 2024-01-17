<?php

// try-catch関数で処理
try {

    // DB接続に必要な項目を変数化
    $host = 'localhost';//ホスト
    $username = 'root';//ユーザー名
    $password = '';//パスワード
    $database = 'booksanta';//データベース名
    
    // データベースに接続
    $mysqli = new mysqli($host, $username, $password, $database);

    // 新規登録画面でセッションに保存した内容を変数に格納
    session_start();
    $name = $_POST["name"];
    $pref = $_POST["pref"];
    $address = $_POST["address"];
    $type = $_POST["type"];
    $pass = $_POST["pass"];

    // 条件指定したSQL文をセット
    $stmt = $mysqli->prepare('INSERT INTO address (NAME, PREF, ADDR, TYPE, PASS) VALUES(?, ?, ?, ?, ?);');

    // 住所が未入力の場合nullを変数に代入
    if($address == ''){
        $address = null;
    }

    // sql文に対して取得した変数をセット
    $stmt->bind_param('sssss', $name, $pref, $address, $type, $pass);

    // SQL実行
    $stmt->execute();

    //登録後ログイン画面へ偏移
    header('Location: signupresult.html');

} catch (PDOException $e) {
    // エラー発生
    echo $e->getMessage();

} finally {
    // DBを閉じる
    $pdo = null;
}

?>