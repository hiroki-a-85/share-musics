@extends('layouts.app')

@section('content')
    <p>this is {{ $work->artist_name }} - {{ $work->work_name }} page.</p>

    @foreach ($users as $user)
        <p>user_name:{{ $user->name }}</p>
        @foreach ($three_fav_works[$user->id] as $work)
            <div><img style="width:80px; height:80px;" src="{{ $work->s3_artwork_url }}"></div>
        @endforeach
    @endforeach
@endsection