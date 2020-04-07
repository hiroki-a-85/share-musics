@extends('layouts.app')

@section('content')
    
    <div id="user_show_wrapper">
        <div id="side_user_area">
            
        </div>
        
        <div id="favorites_index">
            <p>お気に入り：</p>
                
            <!-- .list-untyled:先頭の・無し(bootstrap) -->
            <ul class="list-unstyled">
                @foreach ($favorite_works as $work)
                    <li>
                        @include('commons.work_unit', ['work' => $work])
                
                        <!-- Auth::id() ログイン中のユーザのidが、今アクセスしているユーザの詳細画面のidと同じ時に表示 -->
                        @if (Auth::id() == $user->id)
                            {!! Form::open(['route' => ['favorites.unfavorite', $work->id], 'method' => 'delete']) !!}
                                {!! Form::submit('一覧から外す', ['class' => "btn btn-primary"]) !!}
                            {!! Form::close() !!}
                        @endif
                    </li>
                @endforeach
            </ul>
            
            {{ $favorite_works->links('pagination::bootstrap-4') }}
        </div>
    </div>
    
@endsection