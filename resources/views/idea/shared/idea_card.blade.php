<div class="card mb-3">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $idea->user->getImageURL() }}"
                    alt="{{ $idea->user->name }} Avatar">
                <div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}">
                            {{ $idea->user->name }}
                        </a></h5>
                </div>
            </div>
            <div>
                @auth()
                    @can('update', $idea)
                        <form method ="POST" action ="{{ route('idea.destroy', $idea->id) }}">
                            @csrf
                            @method('delete')
                            <button>
                                <a href ="{{ route('idea.edit', $idea->id) }}">
                                    Edit
                                </a>
                            </button>
                            <button>
                                <a href ="{{ route('idea.show', $idea->id) }}">
                                    View
                                </a>
                            </button>
                                <button class = "ms-1 btn btn-danger btn-sm"> X </button>
                        </form>
                    @endcan
                @endauth
            </div>
        </div>
    </div>
    {{-- PRINT OUT IDEA --}}
    <div class="card-body">
        @if ($editing ?? false)
            <form action="{{ route('idea.update', $idea->id) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <textarea name ="content" class="form-control" id="content" rows="3">{{ $idea->content }}</textarea>
                    @error('content')
                        <span class = "d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                    @enderror
                </div>
                <div class="">
                    <button type ="submit" class="btn btn-dark btn-sm"> Update </button>
                </div>
            </form>
        @else
            <p class="fs-6 fw-light text-muted">
                {{ $idea->content }}
            </p>
        @endif
        <div class="d-flex justify-content-between">
            {{-- Ideas Here --}}
            @include('idea.shared.like_button')
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at->toDateString() }} </span>
            </div>
        </div>
        @include('idea.shared.comments_box')
    </div>
</div>
