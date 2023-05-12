@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="p-2">
            <a href="{{ route('article.index') }}" class="btn btn-sm btn-primary">Back</a>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 mb-3">
                <div class="card">
                    <img src="@if (empty($article->article_image))
                        {{url('img/default-image.png')}}
                    @else
                        {{url('')}}/articles/{{$article->article_image}}
                    @endif" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>{{ $article->title }}</h2>
                        <p>{!! $article->content !!}</p>
                        <p>Creator : {{ $article->article_creator }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection