<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="confilm.css">
    <title>寄贈図書登録確認画面</title>
    <?php
    session_start();
    $received_name = $_SESSION['NAME'];
    $received_pref = $_SESSION['PREF'];
    $received_type = $_SESSION['TYPE'];

    $isbn = $_SESSION['ISBN'];
    $storage = $_SESSION['STORAGE'];
    $title = $_SESSION['TITLE'];
    $writer = $_SESSION['WRITER'];
    $publisher = $_SESSION['PUBLISHER'];
    $keyword = $_SESSION['KEYWORD'];
    $generation = $_SESSION['GENERATION'];
    $category = $_SESSION['CATEGORY'];
    $genre = $_SESSION['GENRE'];
    $count = $_SESSION['COUNT'];
    ?>
  </head>
  <body>
 <!-- formからデータを受け取る -->
    
    <table border="1">
    <form action="librarylogic.php" method="post">
      <tr>
        <td>ISBN</td>
        <td><input type ="hidden" name="isbn"
                value = "<?php if(!empty($_POST['isbn'])){
                    $isbn = $_POST['isbn'];
                    echo $isbn;
                  }else{
                    $isbn = $_SESSION['ISBN'];
                    echo $isbn;
                  }  ?>">
            <?php echo $isbn; ?>
        </td>
      </tr>
      <tr>
        <td>タイトル</td>
        <td><input type ="hidden" name="title"
            value = "<?php if(!empty($_POST['title'])){
                    $title = $_POST['title'];
                    echo $title;
                  }else{
                    $title = $_SESSION['TITLE'];
                    echo $title;
                  } ?>">
            <?php echo $title; ?>
        </td>
      </tr>
      <tr>
        <td>著者名</td>
        <td><input type ="hidden" name="writer"
            value = "<?php if(!empty($_POST['writer'])){
                    $writer = $_POST['writer'];
                    echo $writer;
                  }else{
                    $writer = $_SESSION['WRITER'];
                    echo $writer;
                  } ?>">
            <?php echo $writer; ?>
        </td>
      </tr>
        <td>出版社</td>
        <td><input type ="hidden" name="publisher"
            value = "<?php if(!empty($_POST['publisher'])){
                    $publisher = $_POST['publisher'];
                    echo $publisher;
                  }else{
                    $publisher = $_SESSION['PUBLISHER'];
                    echo $publisher;
                  } ?>">
            <?php echo $publisher; ?>
        </td>
      </tr>
      <tr>
        <td>キーワード</td>
        <td><input type ="hidden" name="keyword"
            value = "<?php if(!empty($_POST['keyword'])){
                    $keyword = $_POST['keyword'];
                    echo $keyword;
                  }else{
                    $keyword = $_SESSION['KEYWORD'];
                    echo $keyword;
                  } ?>">
            <?php echo $keyword; ?>
        </td>
      </tr>
      <tr>
        <td>年齢層</td>
        <td><input type ="hidden" name="generation"
            value = "<?php if(!empty($_POST['generation'])){
                    $generation = $_POST['generation'];
                    echo $generation;
                  }else{
                    $generation = $_SESSION['GENERATION'];
                    echo $generation;
                  } ?>">
            <?php echo $generation; ?>
        </td>
      </tr>
      <tr>
        <td>カテゴリー</td>
        <td><input type ="hidden" name="category"
            value = "<?php if(!empty($_POST['category'])){
                    $category = $_POST['category'];
                    echo $category;
                  }else{
                    $category = $_SESSION['CATEGORY'];
                    echo $category;
                  } ?>">
            <?php echo $category; ?>
        </td>
      </tr>
      <tr>
        <td>ジャンル</td>
        <input type ="hidden" name="genre"
        value = "<?php 
        if (!empty($_POST['genre1'])) {
          $genre = $_POST['genre1'];
          echo $genre;
        } else if (!empty($_POST['genre2'])) {
          $genre = $_POST['genre2'];
          echo $genre;
        } else if (!empty($_POST['genre3'])) {
          $genre = $_POST['genre3'];
          echo $genre;
        } else {
          $genre = $_SESSION['GENRE'];
          echo $genre;
        }
        ?>">
        <td><?php echo $genre; ?></td>
      </tr>
      
    </table>


    寄贈冊数<br>
      <input type="number" name="count" min="1" value="1"><br>

    
    <input type="submit" name="add" value="確定">
    
    </form>
    <button type="button" onclick="history.back()">戻る</button>
    
  </body>
</html>