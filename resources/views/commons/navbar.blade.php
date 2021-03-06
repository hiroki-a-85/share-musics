<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-light bg-light"> 
    
        <a id="site_title" class="navbar-brand" href="/">Share-Musics</a>
        
        <!-- 折り畳み時のボタン -->
        <!-- 現在のURLが、signup.get(サインアップページ)またはlogin(ログインページ)の時は表示しない -->
        @if (\Request::fullUrl() == route('signup.get') || \Request::fullUrl() == route('login'))
        @else
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        @endif
                
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav">
                
                @if (Auth::check())
                    <li class="nav-item">{!! link_to_route('users.show', 'マイページ', ['id' => Auth::id()], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('logout.get', 'ログアウト', [], ['class' => 'nav-link']) !!}</li>
                
                <!-- \Request::fullUrl() : 現在のURLを取得 -->
                <!-- route('...') : 指定された名前付きルートへのURLを生成 -->
                <!-- 現在のURLが、signup.get(サインアップページ)またはlogin(ログインページ)の時は何も表示しない -->
                @elseif (\Request::fullUrl() == route('signup.get') || \Request::fullUrl() == route('login'))
                @else
                    <li class="nav-item">{!! link_to_route('signup.get', 'アカウントを作る', [], ['class' => 'nav-link']) !!}</li>
                    <li class="nav-item">{!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}</li>
                @endif
            </ul>
        </div>
        
    </nav>
</header>