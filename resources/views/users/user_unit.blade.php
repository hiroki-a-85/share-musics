<li class="d-inline-block col-sm-6">
    <div id="user_unit" class="media mb-3">
        <a href="/users/{{ $user->id }}"><img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 120) }}" alt="{{ $user->name }}"></a>
        <div id="username_and_workphotos" class="media-body">
            <div>
                {{ $user->name }}
            </div>
            <div id="workphotos_area">
                @foreach ($s3_artwork_urls as $s3_artwork_url)
                    @if ($s3_artwork_url == "No Photo")
                        <div id="work_mini_photo_false" class="rounded d-inline-block">
                            <i class="fas fa-compact-disc my-grey my-small"></i>
                        </div>
                    @else
                        <div id="work_mini_photo" class="rounded d-inline-block">
                            <img class="img-fluid" src="{{ $s3_artwork_url }}">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</li>