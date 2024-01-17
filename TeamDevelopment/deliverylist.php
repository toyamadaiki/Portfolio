<?php
session_start();
$pref = $_SESSION['PREF'];
/*
* DBから受け取った内容を別のformに区別するための変数$i
*/
$i = 0;
try {
    /*
    * DBに接続する$link
    * $stmtにSQL文でordrテーブルからタイトル、届け先の最寄り集荷場、届け先を取得準備
    * 集荷場の所在県$prefに一致する物のみを取得
    */
    $link = new mysqli('localhost', 'root', '', 'booksanta');
    $stmt = $link->prepare('SELECT ID,TITLE,NEARESTSTRG, DESTINATION FROM ordr WHERE STORAGE = ?');
    $stmt->bind_param('s', $pref);
    $stmt->execute();
    $stmt->bind_result($id,$title, $neareststrg, $destination);
} catch (Exception $e) {
    echo "エラーが発生しています、システム管理者にお問い合わせください";
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="deliverylist.css">
    <title>配送リスト</title>
</head>

<body>
    <?php while ($stmt->fetch()) {
/* DBから取得した各行に対して、
*  届け先最寄りの集荷場がログインしている集荷場なら、本タイトルと届け先を表示
*  そうでなければ、本タイトルと届け先最寄りの集荷場を表示
*  formタグでのpostをaタグで行っています。nameが同じformが複数あると正常に動作しないのでdata$iとしています
*/
    ?>
        
            <?php if ($pref == $neareststrg) { ?>
                <form action="deliverydetail.php" method="post" name="<?php echo 'data', $i; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="title" value="<?php echo $title; ?>">
                    <input type="hidden" name="neareststrg" value="">
                    <input type="hidden" name="destination" value="<?php echo $destination; ?>">
                    <a onclick="document.<?php echo 'data', $i; ?>.submit();"><?php echo 'タイトル：', $title.'　場所：',$destination; ?></a>
                </form>
            <?php } else { ?>
                <form action="deliverydetail.php" method="post" name="<?php echo 'data', $i; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="title" value="<?php echo $title; ?>">
                    <input type="hidden" name="neareststrg" value="<?php echo $neareststrg; ?>">
                    <input type="hidden" name="destination" value="">
                    <a onclick="document.<?php echo 'data', $i; ?>.submit();"><?php echo 'タイトル：', $title.'　場所：',$neareststrg,'集荷場';?></a>
                </form>
                <br>

<?php }
            $i++;
        }
$link->close(); ?>
<button type="button" onclick="location.href='opelog.html'">閉じる</button>
</body>



</html>