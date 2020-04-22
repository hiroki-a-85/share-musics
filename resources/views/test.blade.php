@extends('layouts.app')

@section('content')
    <p>this is {{ $work->artist_name }} - {{ $work->work_name }} update page.</p>

    <p>{{ var_dump($img_path) }}</p>
@endsection