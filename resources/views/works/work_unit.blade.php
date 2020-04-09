<div id="work_unit" class="media mb-3">
    <div id="artwork"><span>{{ $work->artwork_path }}</span></div>
    <div id="work_unit_detail" class="media-body ml-2">
        <p id="artist_name">{{ $work->artist_name }}</p>
        <p id="title">{{ $work->work_name }}</p>
        
        <!-- 「Request::is('users/*/submit')現在のURLが、「.../users/*/submit」かどうか判別 -->
        <!-- 「.../users/*/submit」ではなく、かつログイン中ユーザとページのユーザが一致している時 -->
        @if (!Request::is('users/*/submit') && Auth::id() == $user->id)
       
           <!-- 「お気に入り」の一覧から外すボタン -->
           <div id="remove_btn" class="d-inline-block mb-0">
               {!! Form::open(['route' => ['favorites.unfavorite', $work->id], 'method' => 'delete']) !!}
                   {!! Form::submit('一覧から外す', ['class' => "btn btn-light btn-sm"]) !!}
               {!! Form::close() !!}
           </div>
        @else
        @endif
    </div>
</div>