@if (count($errors) > 0 || session('message_post_max_size'))
    <ul class="alert alert-danger" role="alert">
        @foreach ( $errors->all() as $error )
            <li class="ml-4">{{ $error }}</li>
        @endforeach
        @if (session('message_post_max_size'))
            <li class="ml-4">{{ session('message_post_max_size') }}</li>
        @endif
    </ul>
@endif