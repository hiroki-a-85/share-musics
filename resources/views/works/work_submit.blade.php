@extends('layouts.app')

@section('content')
    <div class="text-center mt-5 mb-5">
        <h3>作品を登録／お気に入りに追加</h3>
    </div>

    <div class="container">
       <div class="row">
            <div id="work_submit" class="col-sm-8 offset-sm-2">
    
                <!-- ファイルのアップロード -->
                <!-- Laravel:Formファサード、「'files' => true」の指定 -->
                <!-- formタグにenctype="multipart/form-data"属性が追加される -->
                {!! Form::open(['route' => 'works.store', 'files' => true]) !!}
                    <div class="form-group row">
                        {!! Form::label('artwork_path', '作品画像：', ['class' => 'col-3 col-sm-4 col-form-label submit_label']) !!}
                        <div class="col-9 col-sm-8">
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
                        {!! Form::label('release_age', '作成された年代：', ['class' => 'col-4 col-sm-4 col-form-label submit_label']) !!}
                        
                        <div class="col-8 col-sm-8">
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
                    
                    <div class="form-group row">
                        {!! Form::label('release_age', 'ジャンル：', ['class' => 'col-4 col-sm-4 col-form-label submit_label']) !!}
                        
                        <div class="dropdown col-8 col-sm-8">
                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">ジャンル</button>
                            
                            <!-- ドロップダウンの一行を２項目表示にするための記述 -->
                            <table class="dropdown-menu">
                                @for ($i = 0;$i < $genre_counts;$i++)
                                
                                    <!-- $genre_countsが奇数かつ$iが最後の数字の時、一行１項目にするため -->
                                    @if ($genre_counts % 2 == 1 && $i == $genre_counts - 1)
                                        <tr class="dropdown-item">
                                            
                                            <!-- name属性の文字列の末尾に[]をつける（今回は、「genre[]」）-->
                                            <!-- これにより複数選択した時、受け取りの変数を配列の形でそれぞれの値を取得できる -->
                                            <!-- 一つの選択でもやはり配列の形式 -->
                                            <td class="droplist_first">{{ Form::checkbox('genre[]', $genres[$i]->id) }}　{{ $genres[$i]->genre_name }}</td>
                                        </tr>
                                    @elseif ($i % 2 == 1)
                                        @continue
                                    @else
                                        <tr class="dropdown-item">
                                            <td class="droplist_first">{{ Form::checkbox('genre[]', $genres[$i]->id) }}　{{ $genres[$i]->genre_name }}</td>
                                            <td>{{ Form::checkbox('genre[]', $genres[$i+1]->id) }}　{{ $genres[$i+1]->genre_name }}</td>
                                        </tr>
                                    @endif
                                @endfor
                            </table>
                        </div>
                    </div>
                    
                    <div class="mt-5 text-center">
                        {!! Form::submit('登録する', ['class' => 'btn btn-primary d-inline-block submit_page_btns mr-3']) !!}
                        {!! link_to_route('users.show', '戻る', ['id' => Auth::id()], ['class' => 'btn btn-light submit_page_btns']) !!}
                    </div>
                        
                {!! Form::close() !!}
            </div>
        </div> 
    </div>
@endsection