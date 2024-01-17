<?php

// try-catch関数で処理
try {

    // DB接続
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'booksanta';
    
    // データベースに接続
    $mysqli = new mysqli($host, $username, $password, $database);


    // 新規登録画面でセッションに保存した内容を変数に格納
    session_start();
    $pref = $_SESSION['PREF'];
    $storage = $_SESSION['STORAGE'];
    $check = $_SESSION['check'];

    $isbn = $_POST["isbn"];
    $title = $_POST["title"];
    $writer = $_POST["writer"];
    $publisher = $_POST["publisher"];
    $keyword = $_POST["keyword"];
    $generation = $_POST["generation"];
    $category = $_POST["category"];
    $genre = $_POST["genre"];
    $count = $_POST["count"];

    // データ受け取り確認用表示欄
    // echo $pref;
    // echo $check;
    // echo $storage;
    // echo $isbn;
    // echo $title;
    // echo $writer;
    // echo $publisher;
    // echo $keyword;
    // echo $generation;
    // echo $category;
    // echo $genre;
    // echo $count;

    // 条件指定したSQL文をセット
    if( $pref == $storage && $check =='0'){

        $stmt = $mysqli->prepare('UPDATE bookdata SET COUNT = COUNT + ? WHERE ISBN = ? AND STORAGE = ?');

        $stmt->bind_param('iss', $count, $isbn, $storage);
        // SQL実行

    }else{
    
        $stmt = $mysqli->prepare('INSERT INTO bookdata (ISBN, STORAGE, TITLE, WRITER, PUBLISHER, KEYWORD, GENERATION, CATEGORY, GENRE, COUNT) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
    
        $stmt->bind_param('sssssssssi', $isbn, $pref, $title, $writer, $publisher, $keyword, $generation, $category, $genre, $count);

    }

    // sql文に対して取得した変数をセット

    // SQL実行
    $stmt->execute();
    unset($_SESSION['check']);
    unset($_SESSION['ISBN']);
    unset($_SESSION['STORAGE']);
    unset($_SESSION['TITLE']);
    unset($_SESSION['WRITER']);
    unset($_SESSION['PUBLISHER']);
    unset($_SESSION['KEYWORD']);
    unset($_SESSION['GENERATION']);
    unset($_SESSION['CATEGORY']);
    unset($_SESSION['GENRE']);
    unset($_SESSION['COUNT']);

    //登録後ログイン画面へ偏移
    header('Location: result.php');
    exit;
} catch (PDOException $e) {
    // エラー発生
    echo $e->getMessage();

} finally {
    // DBを閉じる
    $pdo = null;
}

?>