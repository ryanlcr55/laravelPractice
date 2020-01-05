@extends('layouts.app') 

@section('content')
    <div class="container">      
        <div class="card text-center">
            <div class="card-header">
                標題：{{ $post->title }}
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    作者：{{ $post->user->name }}
                </h5>
                <p class="card-text">
                    {{ $post->content }}
                </p>
            </div>
            <div class="card-footer text-muted">
                發文日期：{{ $post->created_at }}
            </div>
            <div align="center">
                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">編輯</a>

                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">刪除</button>
                </form>
            </div>
        </div>
    </div>
@endsection