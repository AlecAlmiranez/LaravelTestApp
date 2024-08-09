@extends('layout.layout')

@section('title','Admin Dashboard')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include ('admin.shared.left_side_bar')
            </div>
            <div class="col-9">
                <h1> Admin Dashboard </h1>
            </div>
        </div>
    </div>
@endsection
