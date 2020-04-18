$(function() {
  // 以下に、jQueryオブジェクトの指定とメソッドを記入
  
  //$('セレクタ').イベント名(function(){
  //  イベント発生時に実行したい処理
  //});
  //セレクタはCSSセレクタと同じ
  //clickイベント:セレクタの要素がクリックされた時に処理する
  
  //変数の定義 var 変数名 = 値;
  
  //submit()メソッドを使うと、ユーザーが送信ボタンをクリックした際に実行する処理を記述できる
  //Formの内容をサーバーへ送信する前に正しい入力がされているかを確認するような処理も実行できる
  $('#search_form').submit(function() {
    
      //文字列の先頭と末尾から空白を除去する$.trim()
      //セレクタ.val():セレクタで指定したタグのvalueの値を取得
      if ($.trim($("#search_form_input").val()) === "" ) {
        
          //submit()メソッドは返り値に「false」を指定すると実行を中止する
          return false;
      }
  });
  
  //$(window):jQueryのwindowオブジェクト
  //.resize():ブラウザのウィンドウサイズをマウスで変更した際に特定の処理を実行することができるメソッド
  $(window).resize(function(){
    
      //JavaScript「window.innerWidth」メソッド
      //スクロールバーを含んでウィンドウサイズの値を取得する
      //cssのメディアクエリもスクロールバーを含んだウィンドウサイズで判定
      var width = window.innerWidth;
      
      //Javascript(jQuery)では、変数名は基本キャメルケース
      var breakPoint = 576;
      
      if (width <= breakPoint) {
          $('.topwrapper_btn').addClass('btn-sm');
      } else {
          $('.topwrapper_btn').removeClass('btn-sm');
      }
  });
  
});