@extends('layouts.admin')

@section('title', 'show')

@section('content')
    <div class="container">

        {{-- route for index --}}
        <div class="row">
            <div class="col py-3 text-uppercase">
                <a href="{{ route('admin.posts.index') }}">
                    Go to the list-post
                </a>
            </div>
        </div>

        {{-- post details --}}
        <div class="row">
            <div class="col text-center">
                <h1 class="text-uppercase py-2">
                    {{ $post->title }}
                </h1>
                <p class="author">
                    Post by: {{ $post->user->name }} - {{ $post->user->userInfo->phone_number }}
                </p>
                <p class="category">
                    {{ $post->category->name }}
                </p>
                <p class="content pt-3">
                    {{ $post->content }}
                </p>
            </div>
        </div>

        {{-- link for back page --}}
        <div class="row">
            <div class="col">
                <a href="{{  url()->previous() }}">Back</a>
            </div>
        </div>
    </div>
@endsection
