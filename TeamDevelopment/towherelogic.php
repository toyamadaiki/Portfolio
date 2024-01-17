<?php
session_start();

$title = $_POST['title'];
$pref = $_POST['pref'];
$address = $_POST['pref'].$_POST['address'];


$preflocation = [
    ['pref'=>'北海道','hokui'=>43.06431,'toukei'=>141.346879],
    ['pref'=>'青森県','hokui'=>40.824589,'toukei'=>140.740548],
    ['pref'=>'岩手県','hokui'=>39.703526,'toukei'=>141.152696],
    ['pref'=>'宮城県','hokui'=>38.268579,'toukei'=>140.872072],
    ['pref'=>'秋田県','hokui'=>39.718626,'toukei'=>140.102381],
    ['pref'=>'山形県','hokui'=>38.240434,'toukei'=>140.36369],
    ['pref'=>'福島県','hokui'=>37.750029,'toukei'=>140.467771],
    ['pref'=>'茨城県','hokui'=>36.341737,'toukei'=>140.446824],
    ['pref'=>'栃木県','hokui'=>36.565912,'toukei'=>139.883592],
    ['pref'=>'群馬県','hokui'=>36.390688,'toukei'=>139.060453],
    ['pref'=>'埼玉県','hokui'=>35.857033,'toukei'=>139.649012],
    ['pref'=>'千葉県','hokui'=>35.60456,'toukei'=>140.123154],
    ['pref'=>'東京都','hokui'=>35.689501,'toukei'=>139.691722],
    ['pref'=>'神奈川県','hokui'=>35.447734,'toukei'=>139.642537],
    ['pref'=>'新潟県','hokui'=>37.902451,'toukei'=>139.023245],
    ['pref'=>'富山県','hokui'=>36.695265,'toukei'=>137.211305],
    ['pref'=>'石川県','hokui'=>36.594606,'toukei'=>136.625669],
    ['pref'=>'福井県','hokui'=>36.065209,'toukei'=>136.22172],
    ['pref'=>'山梨県','hokui'=>35.664108,'toukei'=>138.568455],
    ['pref'=>'長野県','hokui'=>36.651306,'toukei'=>138.180904],
    ['pref'=>'岐阜県','hokui'=>35.391174,'toukei'=>136.723657],
    ['pref'=>'静岡県','hokui'=>34.976944,'toukei'=>138.383056],
    ['pref'=>'愛知県','hokui'=>35.180209,'toukei'=>136.906582],
    ['pref'=>'三重県','hokui'=>34.730278,'toukei'=>136.508611],
    ['pref'=>'滋賀県','hokui'=>35.004513,'toukei'=>135.868568],
    ['pref'=>'京都府','hokui'=>35.021242,'toukei'=>135.755613],
    ['pref'=>'大阪府','hokui'=>34.686344,'toukei'=>135.520037],
    ['pref'=>'兵庫県','hokui'=>34.691257,'toukei'=>135.183078],
    ['pref'=>'奈良県','hokui'=>34.685274,'toukei'=>135.832861],
    ['pref'=>'和歌山県','hokui'=>34.226111,'toukei'=>135.1675],
    ['pref'=>'鳥取県','hokui'=>35.503449,'toukei'=>134.238261],
    ['pref'=>'島根県','hokui'=>35.472297,'toukei'=>133.050499],
    ['pref'=>'岡山県','hokui'=>34.661772,'toukei'=>133.93481],
    ['pref'=>'広島県','hokui'=>34.396557,'toukei'=>132.459622],
    ['pref'=>'山口県','hokui'=>34.185956,'toukei'=>131.47138],
    ['pref'=>'徳島県','hokui'=>34.06577,'toukei'=>134.559303],
    ['pref'=>'香川県','hokui'=>34.340149,'toukei'=>134.043444],
    ['pref'=>'愛媛県','hokui'=>33.841624,'toukei'=>132.765362],
    ['pref'=>'高知県','hokui'=>33.559705,'toukei'=>133.53108],
    ['pref'=>'福岡県','hokui'=>33.606785,'toukei'=>130.418314],
    ['pref'=>'佐賀県','hokui'=>33.249973,'toukei'=>130.298822],
    ['pref'=>'長崎県','hokui'=>32.744839,'toukei'=>129.873756],
    ['pref'=>'熊本県','hokui'=>32.789828,'toukei'=>130.741667],
    ['pref'=>'大分県','hokui'=>33.238171,'toukei'=>131.612591],
    ['pref'=>'宮崎県','hokui'=>31.91109,'toukei'=>131.423855],
    ['pref'=>'鹿児島県','hokui'=>31.560148,'toukei'=>130.557981],
    ['pref'=>'沖縄県','hokui'=>26.212445,'toukei'=>127.680922],
    
];


$link = new mysqli('localhost', 'root', '', 'booksanta');
$stmt = $link->prepare('SELECT STORAGE FROM bookdata WHERE TITLE = ?');
$stmt->bind_param('s', $title);
$stmt->execute();
$stmt->bind_result($storage);
$comparelist =array();
while ($stmt->fetch()) {
    $departure = array_search( $storage, array_column( $preflocation, 'pref'));
    $destination = array_search( $pref, array_column( $preflocation, 'pref'));
    $distance = pow($preflocation[$departure]['hokui']-$preflocation[$destination]['hokui'],2)+pow($preflocation[$departure]['toukei']-$preflocation[$destination]['toukei'],2);
    $compareelement =[$preflocation[$departure]['pref'],$distance];
    array_push($comparelist,$compareelement);
}

$min=$comparelist[0][1];
$flag = 0;
for($i = 0; $i < count($comparelist); $i++){
    if($comparelist[$i][1]<$min){
        $min=$comparelist[$i][1];
        $flag =$i;
    }}
echo $comparelist[$flag][0].'//'.$comparelist[$flag][1];

$link = new mysqli('localhost', 'root', '', 'booksanta');
$stmt = $link->prepare('INSERT INTO ordr (TITLE,STORAGE,NEARESTSTRG,DESTINATION) VALUES(?,?,?,?)');
$stmt->bind_param('ssss', $title,$comparelist[$flag][0],$pref,$address);
$stmt->execute();

    unset($_SESSION['check']);
    unset($_SESSION['ISBN']);
    unset($_SESSION['STORAGE']);
    unset($_SESSION['TITLE']);
    unset($_SESSION['WRITER']);
    unset($_SESSION['PUBLISHER']);
    unset($_SESSION['KEYWORD']);
    unset($_SESSION['GENERATION']);
    unset($_SESSION['CATEGORY']);
    unset($_SESSION['GENRE']);
    unset($_SESSION['COUNT']);

header("Location: sendresult.php");
exit;