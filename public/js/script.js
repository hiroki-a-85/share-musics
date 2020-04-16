$(function() {
  // 以下に、jQueryオブジェクトの指定とメソッドを記入
  
  
  //$('セレクタ').イベント名(function(){
  //  イベント発生時に実行したい処理
  //});
  //セレクタはCSSセレクタと同じ
  //clickイベント:セレクタの要素がクリックされた時に処理する
  
  $('#filter_ages_and_genres #age').click(function() {

    //変数の定義 var 変数名 = 値;
    //$(this)でクリックされた要素を取得
    //$ageに代入
    var $age = $(this);
    var $genre = $('#filter_ages_and_genres #genre');

    //hasClassメソッド、引数に指定されたクラスを持っていればtrue,そうでなければfalse
    if(!$age.hasClass('active')) {
        $age.addClass('active');
        $genre.removeClass('active');
        
        $('#year_links').show();
        $('#genres_links').hide();
    }
  });
  
  $('#filter_ages_and_genres #genre').click(function() {

    var $age = $('#filter_ages_and_genres #age');
    var $genre = $(this);

    if(!$genre.hasClass('active')) {
        $genre.addClass('active');
        $age.removeClass('active');
        
        $('#genres_links').show();
        $('#year_links').hide();
    }
  });
  
});