<?php
/* セッションからログイン情報の集荷場所在県、前ページから本タイトルと最寄り集荷場を取ってくる */
session_start();
$pref = $_SESSION['PREF']; 
$title = $_POST['title'];
$neareststrg = $_POST['neareststrg']; 
$id = (int) $_POST['id'];
/* bookdataから配達完了になった（ログインしている集荷場にある）本の全要素を取得,INSERTの場合に使う*/
try {
    $link = new mysqli('localhost', 'root', '', 'booksanta');
    $stmt = $link->prepare('SELECT * FROM bookdata WHERE TITLE = ? AND STORAGE = ?');
    $stmt->bind_param('ss', $title, $pref);
    $stmt->execute();
    $stmt->bind_result($isbn, $storage,$title, $writer,$publisher, $kewword,$generation,$category,$genre,$count);
    $stmt->fetch();
} catch (Exception $e) {
    echo "リストの取得にエラーが発生しています";
}
/*集荷場内に2冊以上あるときは１冊減らす、１冊以下ならDBから削除 */
if ($count >= 2) {
    $link = new mysqli('localhost', 'root', '', 'booksanta');
    $decrease = $link->prepare('UPDATE bookdata SET COUNT = (?-1) WHERE ISBN = ? AND STORAGE =?');
    $decrease->bind_param('iss', $count, $isbn, $pref);
    $decrease->execute();

}else{
    $link = new mysqli('localhost', 'root', '', 'booksanta');
    $delete = $link->prepare('DELETE FROM bookdata WHERE ISBN = ? AND STORAGE =?');
    $delete->bind_param('ss',$isbn, $pref);
    $delete->execute();

}
/* 別の集荷場に送る場合の処理、送り先に同一の本はない前提でINSERT */
if($neareststrg != $pref){
        $link = new mysqli('localhost', 'root', '', 'booksanta');
        $insert = $link->prepare('INSERT INTO bookdata VALUES (?,?,?,?,?,?,?,?,?,1)');
        $insert->bind_param('sssssssss',$isbn, $neareststrg,$title, $writer,$publisher, $kewword,$generation,$category,$genre);
        $insert->execute();
/*その県の集荷場に該当する本はないはずなので↓は使わないはず、必要なら要条件分岐
*        $link = new mysqli('localhost', 'root', '', 'booksanta');
*        $increase = $link->prepare('UPDATE bookdata SET COUNT = ? WHERE ISBN = ? AND STORAGE =?');
*        $countinc = $count +1;
*        $increase->bind_param('iss', $countinc , $isbn, $neareststrg);
*        $increase->execute();
*/
/* 今ログインしている集荷場に来ている配達情報を送り先の集荷場に行くように変更 */
        $link = new mysqli('localhost', 'root', '', 'booksanta');        
        $ordrchange = $link->prepare('UPDATE ordr SET STORAGE=? WHERE ID = ?');
        $ordrchange->bind_param('si',$neareststrg, $id);
        $ordrchange->execute();

        header("Location: deliverylist.php");
        exit;
    }else{
/* 送り先がご家庭の場合、配達情報自体を削除 */
        $link = new mysqli('localhost', 'root', '', 'booksanta');
        $ordrdel = $link->prepare('DELETE FROM ordr WHERE ID = ?');
        $ordrdel->bind_param('i',$id);
        $ordrdel->execute();

        header("Location: deliverylist.php");
        exit;
    }
?>