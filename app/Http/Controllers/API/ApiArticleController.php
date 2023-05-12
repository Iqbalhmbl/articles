<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ApiArticleController extends Controller
{
    public $successStatus = 200;

    public function article()
    {
        $article = Article::all();

        if (!$article) {
            return response()->json([
                'status' => 'Not Found',
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'data' => $article,
        ], 200);
    }

    public function detailarticle($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'Not Found',
                'message' => 'Article with ID ' . $id . ' Not Found',
            ], 404);
        }

        return response()->json($article);
    }
}
