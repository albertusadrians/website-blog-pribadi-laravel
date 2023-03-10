{{-- @dd($post) --}}
@extends('layouts.main')
@section('container')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <article class="mb-4">
                    <h2 class="mb-3">{{ $post->title }}</h2>
                    <h5>By. <a href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a> in <a
                            href="/posts?category={{ $post->category->category_slug }}">{{ $post->category->category_name }}</a>
                    </h5>
                    @if ($post->image)
                        <div style="max-height:350px; overflow:hidden">
                            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top mt-3"
                                alt="{{ $post->category->category_name }}">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/500x400?{{ $post->category->category_name }}"
                            class="card-img-top mt-3" alt="{{ $post->category->category_name }}">
                    @endif
                    <p> {!! $post->body !!}</p>
                </article>
                <a href="/posts">Back to Post</a>
            </div>
        </div>
    </div>
@endsection
