@extends('layouts.app')
@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">Blog
                @can('role-create')
                    <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('blogs.index') }}">Back</a>
                    </span>
                @endcan
            </div>
            <div class="card-body">
                <div class="lead">
                    <strong>Title:</strong>
                    {{ $blog->title }}
                </div>
                <div class="lead">
                    <strong>Description:</strong>
                    {{ $blog->description }}
                </div>
                <div class="lead">
                    <strong>Content:</strong>
                    {{ $blog->content }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
