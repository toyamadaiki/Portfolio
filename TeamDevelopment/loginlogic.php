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
    $pass = $_POST["pass"];
    $type = $_POST["type"];

    // 条件指定したSQL文をセット
    $stmt = $mysqli->prepare('SELECT NAME, PREF, TYPE FROM address WHERE NAME = ? AND PASS = ? AND TYPE = ?');

    // :nameと:passに対して取得した変数をセット
    $stmt->bind_param('sss', $name, $pass, $type);

    // SQL実行
    $stmt->execute();

    // DEより取得した値を配列に代入
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    // 各取得値別にセッションに保存
    $_SESSION['NAME'] = $rows[0]['NAME'];
    $_SESSION['PREF'] = $rows[0]['PREF'];
    $_SESSION['TYPE'] = $rows[0]['TYPE'];

    // 取得した配列に値があるかの条件式
    if (!empty($rows)) { 

        if($_SESSION['TYPE'] == "本部"){
        
            // 値が入っているなら本部用テストページ画面へ偏移
            header('Location: opebranch.html');

        }else if($_SESSION['TYPE'] == "集荷場"){

            // 値が入っているなら集荷場用テストページ画面へ偏移
            header('Location: deliverylist.php');

        }else if($_SESSION['TYPE'] == "店舗"){

            // 値が入っているなら店舗用テストページ画面へ偏移
            header('Location: isbncheck.html');
        
        }
    
    } else {

        // 値が入っているならerror画面へ偏移
        header('Location: error.php');
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