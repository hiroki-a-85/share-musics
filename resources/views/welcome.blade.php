@extends('layouts.app')

@section('content')
    <div class="top-wrapper col-sm-10 offset-sm-1 mb-5">
        <p class="title">お気に入りの音楽を共有</p>
        <p class="title">新しい音楽の発見</p>
        @if (Auth::check())
        @else
            <div class="d-flex  justify-content-center mt-3">
                {!! link_to_route('signup.get', 'サインアップ', [], ['class' => 'btn btn-primary d-inline-block mr-3']) !!}
                {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-primary d-inline-block pl-4 pr-4 ml-3']) !!}
            </div>
        @endif
    </div>
    
    <div id="users_index">
        <ul class="list-unstyled container">
            <div class="row">
                @foreach ($users as $user)
                    <li class="d-inline-block col-sm-6">
                        @include('users.user_unit', ['user' => $user, 'works' => $works[$user->id]])
                    </li>
                @endforeach
            </div>
        </ul>
        
        <div class="text-center"><div class="d-inline-block">{{ $users->links('pagination::bootstrap-4') }}</div></div>
    
    </div>
    
    <div id="filter_ages_and_genres" class="col-sm-6 offset-sm-3 mt-3 mb-5">
        <ul class="nav nav-tabs nav-justified mb-4">
           <li class="nav-item"><a id="age" class="nav-link active">年代</a></li>
           <li class="nav-item"><a id="genre" class="nav-link">ジャンル</a></li>
       </ul>
       
       <div class="d-flex justify-content-center">
           <div id="year_links">
               @for ($i = 0;(1950 + (10 * $i)) <= 2020;$i++)
                   <div class="d-inline-block mr-2">
                       {!! link_to_route('works.by_release_age_index', (1950 + (10 * $i)) . '~', ['year' => (1950 + (10 * $i))]) !!}
                   </div>
               @endfor
           </div>
       </div>
       
       
       <div id="genres_links">
           genres
       </div>
    </div>
@endsection