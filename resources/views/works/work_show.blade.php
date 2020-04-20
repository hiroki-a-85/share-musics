@extends('layouts.app')

@section('content')
    <div id="work_show_wrapper">
        <div id="side_work_area">
            <div class="d-inline-block text-center">
                <img id="artwork" class="rounded img-fluid" src="{{ $work->s3_artwork_url }}" alt="">
                <p id="artist_name" class="mt-3 mb-2">{{ $work->artist_name }}</p>
                <p id="work_name" class="mt-1 mb-2">{{ $work->work_name }}</p>
                <p id="release_age" class="mt-1 mb-2">{{ $work->release_age_key }}-{{ ($work->release_age_key + 10) }}</p>
                <div id="genres">
                   @foreach ($genres as $genre)
                       @if ($loop->last)
                           <span>{{ $genre->genre_name }}</span>
                       @else
                           <span>{{ $genre->genre_name }}, </span>
                       @endif
                   @endforeach
                </div>
                <div class="d-inline-block mt-4 mb-5">
                  @if (Auth::check())
                     @if (Auth::user()->is_in_favorites($work->id))
                     @else
                        {!! Form::open(['route' => ['favorites.favorite', $work->id], 'method' => 'post']) !!}
                            {!! Form::submit('お気に入りに追加', ['class' => "btn btn-primary"]) !!}
                        {!! Form::close() !!}  
                     @endif
                  @endif
                </div>
            </div>
        </div>
        
        <div id="work_show_users_index">
            <p>お気に入りに追加しているユーザー</p>
            <hr class="mb-4">
            
            <ul class="list-unstyled">
              @foreach ($users as $user)
                 <li>
                    @include('users.user_unit', ['user' => $user, 'works' => $three_fav_works[$user->id]])
                 </li>
              @endforeach
            </ul>
            
            <div class="text-center"><div class="d-inline-block">{{ $users->links('pagination::bootstrap-4') }}</div></div>
        </div>
    </div>
@endsection