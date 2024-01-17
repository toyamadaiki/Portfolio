<?php

try {
    
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'booksanta';
    
    // データベースに接続
    $mysqli = new mysqli($host, $username, $password, $database);

    // ログイン画面でセッションに保存した内容を変数に格納
    // session_start();
    // $name = $_POST["name"];

    // 条件指定したSQL文をセット
    $stmt = $mysqli->prepare('SELECT GENERATION, SUM(COUNT) as 集計 FROM bookdata GROUP BY GENERATION');

    // :nameと:passに対して取得した変数をセット
    // $stmt->bind_param('sss', $name, $pass, $type);

    // SQL実行
    $stmt->execute();

    // DEより取得した値を配列に代入
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    $_SESSION['list'] = $rows;

        $hoge1 = array_search( '乳児向け', array_column( $rows, 'GENERATION'));
        $hoge2 = array_search( '幼児向け', array_column( $rows, 'GENERATION'));
        $hoge3 = array_search( '小学校低~中学年', array_column( $rows, 'GENERATION'));
        $hoge4 = array_search( '小学校中~高学年', array_column( $rows, 'GENERATION'));
        $hoge5 = array_search( '中学生', array_column( $rows, 'GENERATION'));
        $hoge6 = array_search( '高校生', array_column( $rows, 'GENERATION'));

        if($hoge1 == ''){
            $nyuji = 0; 
        }else{
            $nyuji = $rows[$hoge1]['集計'];
        }
        
        if($hoge2 == ''){
            $youji = 0;
        }else{
            $youji = $rows[$hoge2]['集計'];
        }

        if($hoge3 == ''){
            $syougaku_tei = 0;
        }else{
            $syougaku_tei = $rows[$hoge3]['集計'];
        }

        if($hoge4 == ''){
            $syougaku_kou = 0;
        }else{
            $syougaku_kou = $rows[$hoge4]['集計'];
        }

        if($hoge5 == ''){
            $tyuugaku = 0;
        }else{
            $tyuugaku = $rows[$hoge5]['集計'];
        }

        if($hoge6 == ''){
            $koukou = 0;
        }else{
            $koukou = $rows[$hoge6]['集計'];
        }

    // 各取得値別にセッションに保存
    session_start();
    $_SESSION['nyuji'] = $nyuji;
    $_SESSION['youji'] = $youji;
    $_SESSION['syougaku_tei'] = $syougaku_tei;
    $_SESSION['syougaku_kou'] = $syougaku_kou;
    $_SESSION['tyuugaku'] = $tyuugaku;
    $_SESSION['koukou'] = $koukou;


    // // 取得した配列に値があるかの条件式
    

        // 値が入っているならerror画面へ偏移
        header('Location: graphpage.php');

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