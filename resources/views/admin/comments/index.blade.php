@extends('layout.layout')

@section('title', 'Comments|Admin Dashboard')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include ('admin.shared.left_side_bar')
            </div>
            <div class="col-9">
                <h1> Comments Dashboard </h1>
                @include('shared.success_message')
                <table class ="table table-striped mt-4">
                    <thead class = "table-dark">
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Idea</th>
                            <th>Content</th>
                            <th>Created at</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td>
                                    <a href="{{ route('users.show', $comment->user) }}">{{ $comment->user->name }}</a>
                                </td>
                                <td>
                                    <a href="{{route('idea.show', $comment->idea) }}">{{ $comment->idea->id }}</a>
                                </td>
                                <td>{{ $comment->content }}</td>
                                <td>{{ $comment->created_at->toDateString() }}</td>
                                <td>
                                    <form action = "{{ route('admin.comments.destroy', $comment) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        {{-- Alternative (Needs tuning) --}}
                                        {{-- <a href="#" onclick="$(this).closest('form').submit(); return false;">Delete</a> --}}
                                        <button type ="submit"> Delete </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
