<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Share-Musics</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        
        <!-- Google Fontsの読み込み -->
        <link href="https://fonts.googleapis.com/css2?family=GFS+Neohellenic&display=swap" rel="stylesheet">
        
        <!-- asset('ファイルパス')はpublicディレクトリのパス（アセットへのURL）を返すヘルパー関数 -->
        <!-- css, js, 画像などの読み込みはassetを使う -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
        <!-- jQueryの読み込み -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>

    <body>

        @include('commons.navbar')
        
        <div class="wrapper">
            @include('commons.error_messages')
            
            @yield('content')
        </div>
        
        <!-- script.jsの読み込み -->
        <script src="{{ asset('js/script.js') }}"></script>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>