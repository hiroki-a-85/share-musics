<li class="media mb-3">
    <img class="mr-2 rounded" src="{{ Gravatar::src($user->email, 120) }}" alt="">
    <div class="media-body">
        <div>
            {{ $user->name }}
        </div>
        <div>
            @foreach ( $user->favorites()->limit(3)->get() as $work)
                <div id="work_mini_photo" class="rounded d-inline-block">
                    <span>{{ $work->artwork_path }}</span>
                </div>
            @endforeach
        </div>
    </div>
</li>