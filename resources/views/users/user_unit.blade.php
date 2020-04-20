<div id="user_unit" class="media mb-3">
    <a href="{{ route('users.show', ['id' => $user->id]) }}"><img id="user_photo" class="mr-2 rounded" src="{{ Gravatar::src($user->email) }}" alt="{{ $user->name }}"></a>
    <div id="username_and_workphotos" class="media-body">
        <div>
            {{ $user->name }}
        </div>
        <div id="workphotos_area">
            @foreach ($works as $work)
                @if ($work->s3_artwork_url == "No Photo")
                    <a href="/works/{{ $work->id }}">
                        <div id="work_mini_photo_false" class="rounded d-inline-block">
                            <i class="fas fa-compact-disc my-grey my-small"></i>
                        </div>
                    </a>
                @else
                    <a href="/works/{{ $work->id }}">
                        <div id="work_mini_photo" class="rounded d-inline-block">
                            <img class="img-fluid" src="{{ $work->s3_artwork_url }}">
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>