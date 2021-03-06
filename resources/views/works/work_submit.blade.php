@extends('layouts.app')

@section('content')
    <div class="text-center mt-5 mb-5">
        <h3>作品を登録／<br id="work_submit_title">お気に入りに追加</h3>
    </div>

    <div class="container mb-5">
       <div class="row">
            <div id="work_submit" class="col-sm-8 offset-sm-2">
    
                <!-- ファイルのアップロード -->
                <!-- Laravel:Formファサード、「'files' => true」の指定 -->
                <!-- formタグにenctype="multipart/form-data"属性が追加される -->
                {!! Form::open(['route' => 'works.store', 'files' => true]) !!}
                    <div class="form-group row">
                        {!! Form::label('artwork_path', '作品画像：', ['class' => 'col-sm-4  col-form-label submit_label']) !!}
                        <div class="col-sm-8">
                            {!! Form::file('artwork_path', old('artwork_path'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
    
                    <div class="form-group row">
                        {!! Form::label('atist_name', 'アーティスト名：', ['class' => 'col-sm-4 col-form-label submit_label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('artist_name', old('artist_name'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
    
                    <div class="form-group row">
                        {!! Form::label('work_name', '作品名：', ['class' => 'col-sm-4 col-form-label submit_label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('work_name', old('work_name'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
    
                    <div class="form-group row">
                        {!! Form::label('release_age', '作成された年代：', ['class' => 'col-sm-4 col-form-label submit_label']) !!}
                        
                        <div class="col-sm-8">
                            <div>
                                <span class="radios">{{ Form::radio('release_age_key', '2020') }}　2020~</span>
                                <span class="radios">{{ Form::radio('release_age_key', '2010') }}　2010~</span>
                                <span class="radios">{{ Form::radio('release_age_key', '2000') }}　2000~</span>
                            </div>
                            <div>
                                <span class="radios">{{ Form::radio('release_age_key', '1990') }}　1990~</span>
                                <span class="radios">{{ Form::radio('release_age_key', '1980') }}　1980~</span>
                                <span class="radios">{{ Form::radio('release_age_key', '1970') }}　1970~</span>
                            </div>
                            <div>
                                <span class="radios">{{ Form::radio('release_age_key', '1960') }}　1960~</span>
                                <span class="radios">{{ Form::radio('release_age_key', '1950') }}　1950~</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        {!! Form::label('genre', 'ジャンル：', ['class' => 'col-sm-4 submit_label']) !!}
                        
                        <div class="col-sm-8 d-flex justify-content-start">
                        @for ($i = 0;$i < $genre_counts;$i++)
                            @if ($i == 0)
                            <ul class="list-unstyled">
                                <li class="droplist_first">{{ Form::checkbox('genre[]', $genres[$i]->id) }}　{{ $genres[$i]->genre_name }}</li> 
                                @elseif ($i >= 1 && $i <= 13)
                                <li class="droplist_first">{{ Form::checkbox('genre[]', $genres[$i]->id) }}　{{ $genres[$i]->genre_name }}</li>
                            @elseif ($i == 14)
                            </ul>
                            <ul class="list-unstyled">
                                <li>{{ Form::checkbox('genre[]', $genres[$i]->id) }}　{{ $genres[$i]->genre_name }}</li>
                                @elseif ($i >= 15 && $i < count($genres) - 1)
                                <li>{{ Form::checkbox('genre[]', $genres[$i]->id) }}　{{ $genres[$i]->genre_name }}</li>
                                @else
                            </ul>
                            @endif
                        @endfor 
                        </div>
                    </div>
                    
                    <div class="mt-2 text-center">
                        {!! Form::submit('登録する', ['class' => 'btn btn-primary d-inline-block submit_page_btns mr-3']) !!}
                        {!! link_to_route('users.show', '戻る', ['id' => Auth::id()], ['class' => 'btn btn-light submit_page_btns']) !!}
                    </div>
                        
                {!! Form::close() !!}
            </div>
        </div> 
    </div>
@endsection