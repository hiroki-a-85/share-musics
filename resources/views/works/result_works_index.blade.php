@extends('layouts.app')

@section('content')
   
   <div class="col-sm-5 offset-sm-1 mb-5">
       
       <p>{{ $year }}年代の作品：</p>
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