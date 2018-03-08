<?php

namespace App\Http\Controllers\RestApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host="rest-api.efimov.life",
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="REST API Sample",
 *         description="Laravel 5.2 Rest Api.",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="efimov82@gmail.com"
 *         )
 *     )
 * )
 */
class ArticleController extends Controller
{
    /**
     * Display a listing of the Articles.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/articles",
     *     description="Returns listing of articles.",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"dashboard"},
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */
    public function index()
    {
        return Article::all();
    }

    /**
     * Detail of the Article.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/articles/{id}",
     *     description="Returns detail of article.",
     *     operationId="api.dashboard.index",
     *     produces={"application/json"},
     *     tags={"dashboard"},
     *     @SWG\Response(
     *         response=200,
     *         description="Dashboard overview."
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */
    public function details(Article $article)
    {
        return $article;
    }

    public function save(Request $request)
    {
        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    public function delete(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}
