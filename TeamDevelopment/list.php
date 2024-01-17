<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="list.css">
    <title>検索結果表示画面</title>
</head>
<body>
<table border="1">
  <thead>
    <tr>
      <th>タイトル</th>
      <th>年齢層</th>
      <th>カテゴリー</th>
      <th>ジャンル</th>
      <th>選択</th>
    </tr>
  </thead>
  <tbody>
  <form action="searchlogic.php" method="post">
    <?php
    session_start();
    $rows=$_SESSION['list'];
    
    foreach($rows as $rows){
        echo "<tr><td>".$rows['TITLE']."</td><td>".$rows['GENERATION']."</td><td>".$rows['CATEGORY']."</td><td>".$rows['GENRE'].
        "</td><td><button type='submit' formaction='towhere.php' name='title' value='".$rows['TITLE']."'>これにする</button></td></tr>";
    }
    ?>
  </tbody>
</table>
  </form>

<form action="searchlogic.php" method="post">
タイトル<br>
<input type="text" placeholder="タイトル名を入力" name="title"><br>

著者名<br>
<input type="text" placeholder="著者名を入力" name="writer"><br>

キーワード<br>
<textarea name="keyword" placeholder="キーワード 例:竜、電車など"rows="6" cols="80"></textarea><br>

年齢層<br>
<select name="generation">
  <option value="">対象年齢を選択</option>
  <option value="乳児向け">乳児向け</option>
  <option value="幼児向け">幼児向け</option>
  <option value="小学校低~中学年">小学校低~中学年</option>
  <option value="小学校中~高学年">小学校中~高学年</option>
  <option value="中学生">中学生</option>
  <option value="高校生">高校生</option>
</select><br>

カテゴリー<br>
<select name="categoly">
  <option value="">カテゴリーを選択</option>
  <option value="picture book">絵本</option>
  <option value="novel">小説</option>
  <option value="illust book">図鑑</option>
</select><br>

ジャンル<br>
<select name="genre">
  <option value="">ジャンルを選択</option>
  <option value="hogehoge">ほにゃらら</option>
  <option value="booboo">ぶーぶー</option>
  <option value="dumdum">だんだん</option>
</select><br>

<input type="submit" value="検索">
</form>

</body>
</html>