<li class="d-inline-block col-sm-6">
    <div id="user_unit" class="media mb-3">
        <a href="/users/{{ $user->id }}"><img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 120) }}" alt="{{ $user->name }}"></a>
        <div class="media-body">
            <div>
                {{ $user->name }}
            </div>
            <div>
                @foreach ($artwork_paths as $artwork_path)
                    <div id="work_mini_photo" class="rounded d-inline-block">
                        <span>{{ $artwork_path }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</li>