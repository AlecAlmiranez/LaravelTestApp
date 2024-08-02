@extends('layout.layout')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left_side_bar')
            </div>
            <div class="col-6">
                @include('shared.success_message')
                <div class="mt-3">
                    @include('users.shared.user_edit_card')
                </div>

                @forelse ($ideas as $idea)
                    @include('idea.shared.idea_card')
                    @empty
                        <p class="text-center my-3 mt-3">No results found</p>
                @endforelse
                <div class="mt-3">
                    {{ $ideas->withQueryString()->links() }}
                </div>

            </div>
            <div class="col-3">
                @include('shared.search_bar')
                @include('shared.follow_box')
            </div>
        </div>
    </div>
@endsection
