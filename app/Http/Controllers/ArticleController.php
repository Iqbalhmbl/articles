<?php

namespace App\Http\Controllers;

use App\Events\RebuildArticleCache;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = Article::paginate(10);

        return view('backend.articles.index', compact('article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'article_creator' => 'required',
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->article_creator = $request->article_creator;

        if ($request->article_image) {
            $this->validate($request, [
                'article_image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $file = $request->file('article_image');
            $image_name = time() . '_' . $file->getClientOriginalName();

            $img = Image::make($file->getRealPath());
            $img->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save('articles/thumbnail/' . $image_name);

            $file->move('articles', $image_name);

            $article->article_image = $image_name;
        }
        $article->save();
        event(new RebuildArticleCache());

        return redirect(route('article.index'))->with('message', 'Article data successfully entered!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        return view('backend.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        return view('backend.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'article_creator' => 'required',
        ]);

        $article = Article::find($id);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->article_creator = $request->article_creator;

        if ($request->article_image) {
            $this->validate($request, [
                'article_image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $file = $request->file('article_image');
            $image_name = time() . '_' . $file->getClientOriginalName();

            if ($article->article_image) {
                if (File::exists(public_path() .'/articles/' . $article->article_image)) {
                    delete(public_path() . '/articles/' . $article->article_image);
                }

                if (File::exists('/articles/thumbnail/' . $article->article_image)) {
                    delete(public_path() . '/articles/thumbnail/' . $article->article_image);
                }
            }

            $img = Image::make($file->getRealPath());
            $img->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save('articles/thumbnail/' . $image_name);

            $file->move('articles', $image_name);

            $article->article_image = $image_name;
        }
        $article->save();
        event(new RebuildArticleCache());

        return redirect(route('article.index'))->with('message','Article data successfully changed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article->article_image) {
            if (File::exists(public_path() .'/articles/' . $article->article_image)) {
                unlink(public_path() . '/articles/' . $article->article_image);
            }

            if (File::exists('/articles/thumbnail/' . $article->article_image)) {
                unlink(public_path() . '/articles/thumbnail/' . $article->article_image);
            }
        }
        $article->delete();

        return redirect(route('article.index'))->with('message','Article data successfully deleted!');
    }
}
