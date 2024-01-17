<?php session_start();
?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="storetop.css">
    <title>寄贈図書登録画面</title>
  </head>
  <body>
 
    <form action="confilm.php" method="post">
      
      ISBN<br>
      <input type="text" name="isbn" value=<?php echo $_SESSION['ISBN']; ?> readonly><br>

      タイトル<br>
      <input type="text" placeholder="タイトル名を入力" name="title" required><br>
      
      著者名<br>
      <input type="text" placeholder="著者名を入力" name="writer" required><br>

      出版社<br>
      <input type="text" placeholder="出版社名を入力" name="publisher" required><br>
 
      キーワード<br>
      <textarea name="keyword" placeholder="キーワード 例:竜、電車など"rows="6" cols="80"></textarea><br>

      年齢層<br>
      <select name="generation">
        <option value="乳児向け">乳児向け</option>
        <option value="幼児向け">幼児向け</option>
        <option value="小学校低~中学年">小学校低~中学年</option>
        <option value="小学校中~高学年">小学校中~高学年</option>
        <option value="中学生">中学生</option>
        <option value="高校生">高校生</option>
      </select><br>

      <!-- ▼2段階プルダウンメニューの例（市を選択すると区が出てくる） -->
      <div class="pulldownset">

      <!-- プルダウンメニュー -->
      ■本のカテゴリー、ジャンルを選択：<br>
      <select class="mainselect"name="category">
        <option value="">カテゴリーを選択</option>
        <option value="絵本">絵本</option>
        <option value="小説">小説</option>
        <option value="図鑑">図鑑</option>
      </select>

      <!--サブボックス-->
        <select id="絵本" class="subbox" name="genre1">
          <option value="">絵本のジャンルを選択</option>
          <option value="ほにゃらら">ほにゃらら</option>
          <option value="ぶーぶー">ぶーぶー</option>
          <option value="だんだん">だんだん</option>
        </select>
        <select id="小説" class="subbox" name="genre2">
          <option value="">小説のジャンルを選択</option>
          <option value="へにゃらら">へにゃらら</option>
          <option value="べーべー">べーべー</option>
          <option value="でんでん">でんでん</option>
        </select>
        <select id="図鑑" class="subbox" name="genre3">
          <option value="">図鑑のジャンルを選択</option>
          <option value="ふにゃらら">ふにゃらら</option>
          <option value="ぼーぼー">ぼーぼー</option>
          <option value="どんどん">どんどん</option>
        </select><br>
      
      <script type="text/javascript">
      // ▼HTMLの読み込み直後に実行：
      document.addEventListener('DOMContentLoaded', function() {

        // ▼2階層目の要素を全て非表示にする
        var allSubBoxes = document.getElementsByClassName("subbox");
        for( var i=0 ; i<allSubBoxes.length ; i++) {
            allSubBoxes[i].style.display = 'none';
        }

      });
      </script>
      <script type="text/javascript">
      // ▼HTMLの読み込み直後に実行：
      document.addEventListener('DOMContentLoaded', function() {

        // ▼全てのプルダウンメニューセットごとに処理
        var mainBoxes = document.getElementsByClassName('pulldownset');
        for( var i=0 ; i<mainBoxes.length ; i++) {
        
            var mainSelect = mainBoxes[i].getElementsByClassName("mainselect");   // 1階層目(メイン)のプルダウンメニュー（※後でvalue属性値を参照するので、select要素である必要があります。）
            mainSelect[0].onchange = function () {
              // ▼同じ親要素に含まれているすべての2階層目(サブ)要素を消す
              var subBox = this.parentNode.getElementsByClassName("subbox");   // 同じ親要素に含まれる.subbox（※select要素に限らず、どんな要素でも構いません。）
              for( var j=0 ; j<subBox.length ; j++) {
                  subBox[j].style.display = 'none';
              }
        
              // ▼指定された2階層目(サブ)要素だけを表示する
              if( this.value ) {
                  var targetSub = document.getElementById( this.value );   // 「1階層目のプルダウンメニューで選択されている項目のvalue属性値」と同じ文字列をid属性値に持つ要素を得る
                  targetSub.style.display = 'inline';
              }
            }
        
        }

      });
    </script>
    
 
      <input type="submit" value="送信">
    </form>
    <button type="button" onclick="history.back()">前のページへ戻る</button>
 
  </body>
</html>