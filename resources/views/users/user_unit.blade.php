<div id="user_unit" class="media mb-3">
    <a href="/users/{{ $user->id }}"><img id="user_photo" class="mr-2 rounded" src="{{ Gravatar::src($user->email) }}" alt="{{ $user->name }}"></a>
    <div id="username_and_workphotos" class="media-body">
        <div>
            {{ $user->name }}
        </div>
        <div id="workphotos_area">
            @foreach ($works as $work)
                @if ($work->s3_artwork_url == "No Photo")
                    <div id="work_mini_photo_false" class="rounded d-inline-block">
                        <a href="works/{{ $work->id }}"><i class="fas fa-compact-disc my-grey my-small"></i></a>
                    </div>
                @else
                    <div id="work_mini_photo" class="rounded d-inline-block">
                        <a href="works/{{ $work->id }}"><img class="img-fluid" src="{{ $work->s3_artwork_url }}"></a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>