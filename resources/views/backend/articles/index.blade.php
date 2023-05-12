@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row p-2 mb-3">
                            <div class="col">
                                <h2>Articles</h2>
                            </div>
                            <div class="col text-end">
                                <a href="{{ route('article.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Data</a>
                            </div>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Article Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Article Creator</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($article as $art)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td><img width="90px" class="img-thumbnail" src="@if (empty($art->article_image))
                                    {{url('img/default-image.png')}}
                                    @else
                                    {{url('')}}/articles/thumbnail/{{$art->article_image}}
                                    @endif" alt=""></td>
                                <td>{{ $art->title }}</td>
                                <td>{{ $art->article_creator }}</td>
                                <td><a href="{{ route('article.show', $art->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" title="show data"></i></a>
                                    <a href="{{ route('article.edit', $art->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit" title="edit data"></i></a>
                                    <a href="{{ route('article.destroy', $art->id) }}" onclick="return confirm('are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash" title="delete data"></i></a></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $article->links('pagination::bootstrap-4') }}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection