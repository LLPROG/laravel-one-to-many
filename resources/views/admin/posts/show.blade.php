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
            <div class="col">
                <h1>
                    {{ $post->title }}
                </h1>
                <p>
                    {{ $post->content }}
                </p>
            </div>
        </div>

        {{-- edit button --}}
        <div>
            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->id) }}">Edit</a>
        </div>

        {{-- delete button --}}
        <div class="row">
            <div class="col">
                <form method="POST" action="{{  route('admin.posts.destroy', $post->id) }}" >
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-delete">
                        Delete
                    </button>
                </form>
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
