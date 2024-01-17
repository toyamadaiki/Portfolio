<?php
    session_start();
    $qlist = $_SESSION['qlist'];
    ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="contacta.css">
    <title>店舗からの質問一覧</title>
</head>
<body>
    <ul>
<?php    
    foreach($qlist as $rows){
        if($rows['ANSWER']=="未回答"){ ?>
            <li><form action="answer.php" method="post">
                <?php echo "Q".$rows['ID'].":".$rows['QUESTION'];?>
                <input type="hidden" name="id" value="<?php echo $rows['ID']; ?>">
                <input type="hidden" name="question" value="<?php echo $rows['QUESTION']; ?>">
                <input type='submit' name="<?php echo 'name'.$rows['ID']; ?>" value="この質問に回答する">
            </form></li>


    <?php
        }
    }
    ?>
    </ul>
    <button type="button" onclick="location.href='opebranch.html'">検索へ戻る</button>
</body>
</html>