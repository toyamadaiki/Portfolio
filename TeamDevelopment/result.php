<?php
session_start();
if (isset($_POST['destroy_session'])) {
    session_destroy();
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="result.css">
    <title>登録完了</title>
</head>
<body>
    <h1>登録が完了しました</h1>
        <button onclick="location.href='isbncheck.html'">戻る</button>
        <form method="post">
            <button type="submit" name="destroy_session">閉じる</button>
        </form>
</body>
</html>