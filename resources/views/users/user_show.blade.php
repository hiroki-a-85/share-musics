@extends('layouts.app')

@section('content')
   <div id="user_show_wrapper" class="container">
       <div class="row">
           <div id="side_user_area" class="col-sm-4 text-center">
               <div class="d-inline-block">
                   <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 280) }}" alt="">
                   <p class="user_name mt-3">{{ $user->name }}</p>
               </div>
               
               <!-- このページのログインユーザのみ表示 -->
               @if (Auth::id() == $user->id)
                   <div>
                       {!! link_to_route('works.create', '作品を登録する', [], ['class' => "btn btn-primary"]) !!}
                       <p class="mt-4">作品を探してお気に入りへ追加：</p>
                       <p>{!! link_to_route('toppage', 'トップページへ', []) !!}</p>
                   </div>
               @else
               @endif
           </div>
       
           <div id="favorites_index" class="col-sm-7 offset-sm-1">
               <ul class="nav nav-tabs nav-justified mb-3">
       
                   <!-- 「Request::is('users/' . $user->id) ? 'active' : '' 」 は、 /users/{id} というURLの場合には、activeのclassを付与するコード -->
                   <li class="nav-item"><a href="{{ route('users.show', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">お気に入り作品</a></li>
                   <li class="nav-item"><a href="{{ route('users.submit_index', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/submit') ? 'active' : '' }}">登録した作品</a></li>
               </ul>
               
               <!-- .list-untyled:先頭の・無し(bootstrap) -->
               <ul class="list-unstyled">
                   @foreach ($works as $work)
                       <li>
                           @include('works.work_unit', ['work' => $work])
                       </li>
                   @endforeach
               </ul>
               
               <div class="text-center"><div class="d-inline-block">{{ $works->links('pagination::bootstrap-4') }}</div></div>
           </div>
       </div>
   </div> 
@endsection