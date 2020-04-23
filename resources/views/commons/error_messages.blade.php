@if (count($errors) > 0 || session('message_upload_max_filesize'))
    <ul class="alert alert-danger" role="alert">
        @foreach ( $errors->all() as $error )
            <li class="ml-4">{{ $error }}</li>
        @endforeach
        @if (session('message_upload_max_filesize'))
            <li class="ml-4">{{ session('message_upload_max_filesize') }}</li>
        @endif
    </ul>
@endif