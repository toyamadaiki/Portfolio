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
    <link rel="stylesheet" type="text/css" href="sendresult.css">
    <title>送信完了画面</title>
</head>
<body>
    <p>集荷場に情報を送信しました</p>
    <button onclick="location.href='operationtop.html'">OK</button>
    <form method="post">
        <button type="submit" name="destroy_session">閉じる</button>
    </form>
</body>
</html>