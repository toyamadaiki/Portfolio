<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>isbncheck</title>
</head>
<body>
<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'booksanta';

try {

	$isbn = $_POST['isbn'];

	// (1) データベースに接続
	$mysqli = new mysqli( $host, $user, $password, $db);

	// (2) データを登録するSQL
	$stmt = $mysqli->prepare('SELECT ISBN, STORAGE, TITLE, WRITER, PUBLISHER, KEYWORD, GENERATION, CATEGORY, GENRE, COUNT FROM bookdata where ISBN = ?');
	
	// (3) 値をセット
	$stmt->bind_param('s', $isbn);

	// (4) SQL実行
	$stmt->execute();

	// (5) 取得したデータをセットする変数を設定
	//$stmt->bind_result($isbn, $title);
	$result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

	session_start();
	$pref = $_SESSION['PREF'];

	$_SESSION['ISBN'] = $rows[0]['ISBN'];
    $_SESSION['TITLE'] = $rows[0]['TITLE'];
	$_SESSION['WRITER'] = $rows[0]['WRITER'];
    $_SESSION['PUBLISHER'] = $rows[0]['PUBLISHER'];
    $_SESSION['KEYWORD'] = $rows[0]['KEYWORD'];
	$_SESSION['GENERATION'] = $rows[0]['GENERATION'];
    $_SESSION['CATEGORY'] = $rows[0]['CATEGORY'];
    $_SESSION['GENRE'] = $rows[0]['GENRE'];
	$_SESSION['COUNT'] = $rows[0]['COUNT'];

	// (6) 結果を取得
	if (!empty($rows)) { 

		$hoge = array_search( $pref, array_column( $rows, 'STORAGE'));
		
		if($hoge == ''){
			$_SESSION['STORAGE'] = '';
		}else{
			$_SESSION['STORAGE'] = $rows[$hoge]['STORAGE'];
		}

		header('Location: confilm.php');
		
		$_SESSION['check'] ='0';

	}else{
		$_SESSION['ISBN'] =$isbn;
		$_SESSION['STORAGE'] = '';
		header('Location: storetop.php');
		
		$_SESSION['check'] ='1';
	}

    $mysqli->close();
} catch(Exception $e) {

	// (8) エラーメッセージを出力
	echo $e->getMessage();
}
?>
</body>
</html>