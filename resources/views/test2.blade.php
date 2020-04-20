@extends('layouts.app')

@section('content')
    <div class="top-wrapper mt-5">
        <p class="title">お気に入りの音楽を共有</p>
        <p class="title">新しい音楽の発見</p>
        @if (Auth::check())
        @else
            <div class="d-flex justify-content-center mt-3">
                {!! link_to_route('signup.get', 'アカウントを作る', [], ['class' => 'topwrapper_btn btn btn-primary d-inline-block mr-2']) !!}
                {!! link_to_route('login', 'ログイン', [], ['class' => 'topwrapper_btn btn btn-primary d-inline-block pl-3 pr-3 ml-2']) !!}
            </div>
        @endif
    </div>
    
    <div id="users_index_and_search" class="mt-5">
       <div id="users_index">
           <p>ユーザーの一覧</p>
           <hr class="mb-4">
           
           <ul class="list-unstyled">
              @foreach ($users as $user)
                 <li>
                    @include('users.user_unit', ['user' => $user, 'works' => $works[$user->id]])
                 </li>
              @endforeach
           </ul>
           
           <div class="text-center"><div class="d-inline-block">{{ $users->links('pagination::bootstrap-4') }}</div></div>
       </div>
    
       <div id="search_area" class="bg-light">
            <p>作品を探す</p>
            <hr>
            <div id="search_box" class="mt-4">
                {!! Form::open(['route' => 'search', 'method' => 'get', 'id' => 'search_form', 'class' => 'nav-item']) !!}
                    {!! Form::text('keyword', null, ['id' => 'search_form_input', 'class' => 'form-control', 'placeholder' => '作品名、アーティスト名で検索']) !!}
                    {{ Form::button('<i class="fas fa-search"></i>', ['type' => 'submit', 'id' => 'search_form_btn']) }}
                {!! Form::close() !!}
            </div>
            
            <details class="mt-4">
                <summary>年代から探す</summary>
                <ul class="list-unstyled">
                    @for ($i = 0;(1950 + (10 * $i)) <= 2020;$i++)
                        @php
                            $age = (1950 + (10 * $i));
                        @endphp
                        <li class="year_links">{!! link_to_route('works.by_release_age_index', "{$age} ({$counts_of_works_by_age[$age]})", ['year' => $age]) !!}</li>
                    @endfor
                </ul>
            </details>
           
            <details class="mt-4 mb-3">
                <summary>ジャンルから探す</summary>
                <div class="d-flex justify-content-start">
                @for ($i = 0;$i < count($genres);$i++)
                    @php
                        $genre_name = $genres[$i]->genre_name;
                        $genre_id = $genres[$i]->id;
                        $work_count = $counts_of_works_by_genre[$genre_id];
                    @endphp
                    @if ($i == 0)
                    <ul class="list-unstyled mr-5">
                        <li class="genre_links">{!! link_to_route('works.by_genre_index', "{$genre_name} ({$work_count})", ['genreId' => $genre_id]) !!}</li> 
                        @elseif ($i >= 1 && $i <= 13)
                        <li class="genre_links">{!! link_to_route('works.by_genre_index', "{$genre_name} ({$work_count})", ['genreId' => $genre_id]) !!}</li>
                    @elseif ($i == 14)
                    </ul>
                    <ul class="list-unstyled">
                        <li class="genre_links">{!! link_to_route('works.by_genre_index', "{$genre_name} ({$work_count})", ['genreId' => $genre_id]) !!}</li>
                        @elseif ($i >= 15 && $i < count($genres) - 1)
                        <li class="genre_links">{!! link_to_route('works.by_genre_index', "{$genre_name} ({$work_count})", ['genreId' => $genre_id]) !!}</li>
                        @else
                    </ul>
                    @endif
                @endfor 
                </div>
            </details>
       </div>
    </div>

   
@endsection