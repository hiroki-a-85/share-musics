@extends('layouts.app')

@section('content')
   
   <div class="col-sm-5 offset-sm-1 mb-3">
       @if (Request::is('genres/*'))
           <p>{{ $genre->genre_name }}の作品：</p>
       @elseif (Request::is('release_age/*'))
           <p>{{ $year }}年代の作品：</p>
       @endif
       <hr>
       <ul class="list-unstyled">
           @foreach ($works as $work)
               <li>
                   @include('works.work_unit', ['work' => $work])
               </li>
           @endforeach
       </ul>
       
       <div class="d-inline-block mt-2">{{ $works->links('pagination::bootstrap-4') }}</div>
   </div>
   
@endsection