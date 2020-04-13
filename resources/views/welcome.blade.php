@extends('layouts.app')

@section('content')
    <div class="top-wrapper col-sm-10 offset-sm-1 mb-5">
        <h3>お気に入りの音楽を共有<br>新しい音楽の発見</h3>
        @if (Auth::check())
        @else
            <div class="d-flex  justify-content-center mt-3">
                {!! link_to_route('signup.get', 'サインアップ', [], ['class' => 'btn btn-primary d-inline-block mr-5']) !!}
                {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-primary d-inline-block pl-4 pr-4 ml-5']) !!}
            </div>
        @endif
    </div>
    
    <div id="users_index">
        <ul class="list-unstyled container">
            <div class="row">
                @foreach ($users as $user)
                    @include('users.user_unit', ['user' => $user, 's3_artwork_urls' => $s3_artwork_urls[$user->id]])
                @endforeach
            </div>
        </ul>
        
        <div class="text-center"><div class="d-inline-block">{{ $users->links('pagination::bootstrap-4') }}</div></div>
    </div>
@endsection