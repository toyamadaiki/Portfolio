<?php
/*  
*  deliverylistから受け取ったneareststrgが空かどうかで配達したのか集荷場間の移動かを判断しています
*  DB操作に必要なタイトルと最寄り集荷場情報をdeliverylogicに送信
*/
    session_start();
    $pref = $_SESSION['PREF']; 

    $title = $_POST['title'];
    $neareststrg =$_POST['neareststrg'];
    $destination = $_POST['destination'];
    $id = $_POST['id'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="deliverydetail.css">
    <title>配送完了確認画面</title>
</head>
<body>
    <p>配送が完了したら送信ボタンを押してください</p>
    <div><?php echo '書籍タイトル:  '.$title; ?></div>
    <?php if($neareststrg==""){ ?>
        <div><?php echo 'プレゼントしたご家庭:  '.$destination;?></div>
        <form action="deliverylogic.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="title" value="<?php echo $title;?>">
            <input type="hidden" name="neareststrg" value="<?php echo $pref;?>">
            <input type="submit" value="送信">
        </form>
        <button type="button" onclick="history.back()">前のページへ戻る</button>
    <?php }else{ ?>
        <div><?php echo '移送先集荷場:  '.$neareststrg. '集荷場';?></div>
        <form action="deliverylogic.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="title" value="<?php echo $title;?>">
            <input type="hidden" name="neareststrg" value="<?php echo $neareststrg;?>">
            <input type="submit" value="送信">
        </form>
        <button type="button" onclick="history.back()">前のページへ戻る</button>
    <?php }?>

</body>
</html>