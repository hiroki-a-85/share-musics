@extends('layouts.app')

@section('content')
    <div class="text-center mt-5 mb-5">
        <h3>「{{ $work->artist_name }} - {{ $work->work_name }}」を編集する</h3>
    </div>

    <div class="container mb-5">
       <div class="row">
            <div id="work_submit" class="col-sm-8 offset-sm-2">
    
                <p>作品の画像</p>
                <hr>
                <div class="col-sm-6 offset-sm-3 mb-3">
                    <p>現在の画像：</p>
                    <img class="rounded img-fluid" src="{{ $work->s3_artwork_url }}">
                </div>
    
                {!! Form::open(['route' => ['works.update', $work->id], 'method' => 'put', 'files' => true]) !!}
                    <div class="form-group row">
                        {!! Form::label('artwork_path', '作品の画像を変更する：', ['class' => 'col-sm-4  col-form-label submit_label']) !!}
                        <div class="col-sm-8">
                            {!! Form::file('artwork_path', old('artwork_path'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('', '', ['class' => 'col-sm-4  col-form-label submit_label']) !!}
                        <div class="col-sm-8">
                            <p>※現在の画像を使用する時は選択不要です。</p>
                        </div>
                    </div>
    
                    <p>作品の情報</p>
                    <hr>
    
                    <div class="form-group row">
                        {!! Form::label('atist_name', 'アーティスト名：', ['class' => 'col-sm-4 col-form-label submit_label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('artist_name', $work->artist_name, ['class' => 'form-control']) !!}
                        </div>
                    </div>
    
                    <div class="form-group row">
                        {!! Form::label('work_name', '作品名：', ['class' => 'col-sm-4 col-form-label submit_label']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('work_name', $work->work_name, ['class' => 'form-control']) !!}
                        </div>
                    </div>
    
                    <div class="form-group row">
                        {!! Form::label('release_age', '作成された年代：', ['class' => 'col-sm-4 col-form-label submit_label']) !!}
                        
                        <div class="col-sm-8">
                            <div>
                                <span class="radios"><input type="radio" value="2020" name="release_age_key" {{ $work->release_age_key == 2020 ? 'checked' : '' }}>　2020~</span>
                                <span class="radios"><input type="radio" value="2010" name="release_age_key" {{ $work->release_age_key == 2010 ? 'checked' : '' }}>　2010~</span>
                                <span class="radios"><input type="radio" value="2000" name="release_age_key" {{ $work->release_age_key == 2000 ? 'checked' : '' }}>　2000~</span>
                            </div>
                            <div>
                                <span class="radios"><input type="radio" value="1990" name="release_age_key" {{ $work->release_age_key == 1990 ? 'checked' : '' }}>　1990~</span>
                                <span class="radios"><input type="radio" value="1980" name="release_age_key" {{ $work->release_age_key == 1980 ? 'checked' : '' }}>　1980~</span>
                                <span class="radios"><input type="radio" value="1970" name="release_age_key" {{ $work->release_age_key == 1970 ? 'checked' : '' }}>　1970~</span>
                            </div>
                            <div>
                                <span class="radios"><input type="radio" value="1960" name="release_age_key" {{ $work->release_age_key == 1960 ? 'checked' : '' }}>　1960~</span>
                                <span class="radios"><input type="radio" value="1950" name="release_age_key" {{ $work->release_age_key == 1950 ? 'checked' : '' }}>　1950~</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        {!! Form::label('genre', 'ジャンル：', ['class' => 'col-sm-4 submit_label']) !!}
                        
                        <div class="col-sm-8 d-flex justify-content-start">
                        @for ($i = 0;$i < $genre_counts;$i++)
                            @if ($i == 0)
                            <ul class="list-unstyled">
                                <li class="droplist_first"><input type="checkbox" name="genre[]" value="{{ $genres[$i]->id }}" {{ in_array($genres[$i]->id, $work_genres_ids) ? 'checked' : '' }}>　{{ $genres[$i]->genre_name }}</li> 
                                @elseif ($i >= 1 && $i <= 13)
                                <li class="droplist_first"><input type="checkbox" name="genre[]" value="{{ $genres[$i]->id }}" {{ in_array($genres[$i]->id, $work_genres_ids) ? 'checked' : '' }}>　{{ $genres[$i]->genre_name }}</li> 
                            @elseif ($i == 14)
                            </ul>
                            <ul class="list-unstyled">
                                <li class="droplist_first"><input type="checkbox" name="genre[]" value="{{ $genres[$i]->id }}" {{ in_array($genres[$i]->id, $work_genres_ids) ? 'checked' : '' }}>　{{ $genres[$i]->genre_name }}</li> 
                                @elseif ($i >= 15 && $i < count($genres) - 1)
                                <li class="droplist_first"><input type="checkbox" name="genre[]" value="{{ $genres[$i]->id }}" {{ in_array($genres[$i]->id, $work_genres_ids) ? 'checked' : '' }}>　{{ $genres[$i]->genre_name }}</li> 
                                @else
                            </ul>
                            @endif
                        @endfor 
                        </div>
                    </div>
                    
                    <div class="mt-2 text-center">
                        {!! Form::submit('編集する', ['class' => 'btn btn-primary d-inline-block submit_page_btns mr-3']) !!}
                        {!! link_to(url()->previous(), '戻る', ['class' => 'btn btn-light submit_page_btns']) !!}
                    </div>
                        
                {!! Form::close() !!}
            </div>
        </div> 
    </div>
@endsection