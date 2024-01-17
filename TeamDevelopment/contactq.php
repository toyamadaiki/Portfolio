<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="contactq.css">
    <title>お問い合わせフォーム</title>
</head>
<?php
    session_start();
    $name=$_SESSION['NAME'];
    $rows=$_SESSION['qlist'];
    
    
?>
<body>
<form  action="questionlogic.php" method="post">
  <label for="message">お問い合わせ内容:</label><br>
  <input type="hidden" name="name" value="<?php echo $name ?>">
  <textarea id="message" name="question" rows="4" cols="40" required></textarea>
  <input type="submit" value="送信">
</form>


質問履歴
<table border="1">
  <thead>
    <tr>
      <th>質問</th>
      <th>回答</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
    foreach($rows as $rows){
        echo "<tr><td>".$rows['QUESTION']."</td><td>".$rows['ANSWER']."</td></tr>";
    }
    ?>
  </tbody>
</table>
<form  action="viewlogic.php" method="post">

<button type='submit' name='name'>全件</button>
  <button type='submit' name='name' value="<?php echo $name ?>">自店舗</button>
</form>
<button type="button" onclick="location.href='isbncheck.html'">ISBN検索へ戻る</button>

</body>
</html>