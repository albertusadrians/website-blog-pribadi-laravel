@extends('layouts.main')
@section('container')
    <h1 class="mb-5">Post Categories</h1>
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4">
                    <a href="posts?category={{ $category->category_slug }}">
                        <div class="card text-bg-dark text-white">
                            <img src="https://source.unsplash.com/500x400?{{ $category->category_name }}" class="card-img"
                                alt="{{ $category->category_name }}">
                            <div class="card-img-overlay d-flex align-items-center p-0">
                                <h5 class="card-title text-center flex-fill p-4" style="background-color: rgba(0,0,0,0.7)">
                                    {{ $category->category_name }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
