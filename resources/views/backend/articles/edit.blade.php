@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="p-2">
                    <a href="{{ route('article.index') }}" class="btn btn-sm btn-primary">Back</a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h2>Article Form Edit</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('Put')
                            <img width="150px" class="img-thumbnail" src="@if (empty($article->article_image))
                            {{url('img/default-image.png')}}
                            @else
                            {{url('')}}/articles/{{$article->article_image}}
                            @endif" alt="">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Article Image</label>
                                <input type="file" class="form-control" name="article_image" value="{{ old('article_image') }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ old('title', $article->title) }}" placeholder="Title">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Content</label>
                                <textarea name="content" id="" class="form-control">{!! old('content',$article->content) !!}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Article Creator</label>
                                <input type="text" name="article_creator" class="form-control" value="{{ old('article_creator',$article->article_creator) }}" placeholder="Article Creator">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection