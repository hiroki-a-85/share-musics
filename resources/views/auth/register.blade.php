@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>サインアップ</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'ユーザ名：') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'メール：') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード：') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワードをもう一度入力：') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>
                
                <div class="text-center">
                    {!! Form::submit('サインアップ', ['class' => 'btn btn-primary d-inline-block pl-4 pr-4']) !!}
                </div>
                    
            {!! Form::close() !!}
            
            <div class="mt-4 text-center">
                {!! link_to_route('login', 'ログイン', [], ['class' => 'd-inline-block mr-5']) !!}
                {!! link_to('/', 'トップページ', ['class' => 'd-inline-block ml-5']) !!}
            </div>
        </div>
    </div>
@endsection