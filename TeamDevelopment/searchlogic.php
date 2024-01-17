<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'booksanta';
$isbn = ' ';
$storage = ' ';
$count = ' ';
$publisher = ' ';




try {

	$title = $_POST['title'];
	$writer = $_POST['writer'];
	$keyword = $_POST['keyword'];
	$generation = $_POST['generation'];
	$category = $_POST['category'];
	$genre = $_POST['genre'];
    

	// (1) データベースに接続
	$mysqli = new mysqli( $host, $user, $password, $db);

	 //for($i = 1; $i < 3; $i++){
	
	// (2) データを登録するSQL
	$stmt = $mysqli->prepare('SELECT * FROM bookdata where TITLE LIKE ? AND WRITER LIKE ? AND KEYWORD LIKE ? 
	AND GENERATION LIKE ? AND CATEGORY LIKE ? AND GENRE LIKE ? ');

	// (3) 値をセット
	if($title == '') {
		$title = "%";
	}
	if($writer == '') {
		$writer = "%";
	}
	if($keyword == '') {
		$keyword = "%";
	}
	if($generation == '') {
		$generation = "%";
	}
	if($category == '') {
		$category = "%";
	}
	if($genre == '') {
		$genre = "%";
	}

	$stmt->bind_param( 'ssssss', $title, $writer, $keyword, $generation, $category, $genre);

	// (4) SQL実行
	$stmt->execute();

	// (5) 取得したデータをセットする変数を設定
	$result = $stmt->get_result();
	$rows = $result->fetch_all(MYSQLI_ASSOC);

	// (6) 結果をlist.phpに受け渡す
	$_SESSION['list'] = $rows;
	header("Location: list.php");
	// (7) データベースの接続解除
	
    $mysqli->close();
} catch(Exception $e) {

	// (8) エラーメッセージを出力
	echo $e->getMessage();
}
?>
</body>
</html>