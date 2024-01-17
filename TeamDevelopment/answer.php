<?php
    $question = $_POST['question'];
    $ID = $_POST['id'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="answer.css">
    <title>回答フォーム</title>
</head>
<body>
    <?php echo "Q".$ID.":".$question;?>
    <form action="updatecontact.php" method="post">
        <input type="hidden" name="id" value="<?php echo $ID; ?>">
        <input type="text" name = "answer" placeholder="400文字以内" required>
        <input type="submit" value="回答を送信する">
    </form>

    <button type="button" onclick="history.back()">質問一覧に戻る</button>
</body>
</html>