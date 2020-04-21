<div id="work_unit" class="media mb-3">
    
    <!-- 「$work->s3_artwork_url」 Laravel:Eloquent「アクセサ」の機能によるもの -->
    <!-- Workモデルにて定義 -->
    @if ($work->s3_artwork_url == "No Photo")
        <div id="artwork_false"><a href="/works/{{ $work->id }}"><i class="fas fa-compact-disc my-grey my-big"></i></a></div>
    @else
        <div id="artwork"><a href="/works/{{ $work->id }}"><img class="img-fluid" src="{{ $work->s3_artwork_url }}"></a></div>
    @endif
        <div id="work_unit_detail" class="media-body ml-2">
            <p id="artist_name">{{ $work->artist_name }}</p>
            <p id="title">{{ $work->work_name }}</p>
            
            @if (Request::is('users/*'))
                <!-- 「Request::is('users/*/submit')現在のURLが、「.../users/*/submit」かどうか判別 -->
                <!-- 「.../users/*/submit」ではなく、かつログイン中ユーザとページのユーザが一致している時 -->
                @if (!Request::is('users/*/submit') && Auth::id() == $user->id)
               
                   <!-- 「お気に入り」の一覧から外すボタン -->
                   <div class="d-inline-block mb-0">
                       {!! Form::open(['route' => ['favorites.unfavorite', $work->id], 'method' => 'delete']) !!}
                           {!! Form::submit('一覧から外す', ['class' => "btn btn-light btn-sm"]) !!}
                       {!! Form::close() !!}
                   </div>
                @endif
                
                @if (Request::is('users/*/submit') && Auth::id() == $user->id)
               
                   <!-- 「登録した作品」の一覧から外すボタン -->
                   <div class="d-inline-block mb-0">
                       {!! Form::open(['route' => ['works.destroy', $work->id], 'method' => 'delete']) !!}
                           {!! Form::submit('削除する', ['class' => "btn btn-dark btn-sm"]) !!}
                       {!! Form::close() !!}
                   </div>
                @endif
            @endif
    </div>
</div>