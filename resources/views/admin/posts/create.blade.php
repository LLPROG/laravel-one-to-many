@extends('layouts.admin')

@section('title', 'Create')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">

            {{-- collect errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.posts.store') }}">

                @csrf
                <div class="mb-3">
                  <label for="title" class="form-label">title</label>
                  <input type="text" class="form-control" id="title" name="title">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea type="text" class="form-control" id="content" name="content"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>

            <div class="row">
                <div class="col">
                    <a href="{{  url()->previous() }}">Back</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
