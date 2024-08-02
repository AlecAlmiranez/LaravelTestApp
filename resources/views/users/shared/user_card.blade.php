<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                    alt="{{ $user->name }} Avatar">
                <div>
                    @if ($editing ?? false)
                        <input name ="name" value ="{{ $user->name }}" type="text" class="form-control">
                        @error('name')
                            <span class="text-danget fs-6">{{ $message }} </span>
                        @enderror
                    @else
                        <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                            </a></h3>
                        <span class="fs-6 text-muted">{{ $user->email }} </span>
                    @endif
                </div>
            </div>
            <div>
                @auth
                    @if (Auth::id() == $user->id)
                        <a href="{{ route('users.edit', $user->id) }}"> Edit </a>
                    @endif
                @endauth
            </div>
        </div>

        <div class="px-2 mt-4">
            <h5 class="fs-5"> Bio: </h5>
            <p class="fs-6 fw-light">
                {{ $user->bio }}
            </p>
            @include('users.shared.user_stats')
            @auth
                @if (Auth::id() !== $user->id)
                    @if (Auth::user()->follows($user))
                        <form method="POST" action = "{{ route('users.unfollow', $user->id) }}">
                            @csrf
                            <div class="mt-3">
                                <button type ="submit" class="btn btn-danger btn-sm"> Unfollow </button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action = "{{ route('users.follow', $user->id) }}">
                            @csrf
                            <div class="mt-3">
                                <button type ="submit" class="btn btn-primary btn-sm"> Follow </button>
                            </div>
                        </form>
                    @endif
                @endif
            @endauth
        </div>
    </div>
</div>
<hr>
