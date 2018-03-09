<?php

namespace App\Http\Controllers\RestApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Article;

/**
 * @SWG\Swagger(
 *     schemes={"http","https"},
 *     host=API_HOST,
 *     basePath="/",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Articles Api",
 *         description="Laravel 5.2 Rest Api.",
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
     *     tags={"articles"},
     *     @SWG\Response(
     *         response=200,
     *         description="Articles list.",
     *         @SWG\Schema(ref="#/definitions/Article")
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
     *     produces={"application/json"},
     *     tags={"articles"},
     *     @SWG\Parameter(
     *         name="id",
     *         type="integer",
     *         in="path",
     *         description="Article id",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Get Detail of the Article.",
     *         @SWG\Schema(ref="#/definitions/Article")
     *     )
     * )
     */
    public function details(Article $article)
    {
        return $article;
    }

    /**
     * Add new Article.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *     path="/articles",
     *     description="Add new article.",
     *     tags={"articles"},
     *     @SWG\Parameter(
     *         name="article",
     *         in="body",
     *         description="Article to add to the store",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Article")
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="Article created successful",
     *         @SWG\Schema(ref="#/definitions/Article")
     *     )
     * )
     */
    public function add(Request $request)
    {
        $article = Article::create($request->all());

        return response()->json($article, 201);
    }

    /**
     * Update exist Article.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Put(
     *     path="/articles/{id}",
     *     description="Update article.",
     *     tags={"articles"},
     *     @SWG\Parameter(
     *         name="id",
     *         type="integer",
     *         in="path",
     *         description="Article id",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="article",
     *         in="body",
     *         description="Article to add to the store",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Article")
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="Article update successful",
     *         @SWG\Schema(ref="#/definitions/Article")
     *     )
     * )
     */
    public function update(Request $request, Article $article)
    {
        $article->update($request->all());

        return response()->json($article, 200);
    }

    /**
     * Delete Article.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Delete(
     *     path="/articles/{id}",
     *     description="Delete article.",
     *     tags={"articles"},
     *     @SWG\Parameter(
     *         name="id",
     *         type="integer",
     *         in="path",
     *         description="Article id",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="Article deleted"
     *     )
     * )
     */
    public function delete(Article $article)
    {
        $article->delete();

        return response()->json(null, 204);
    }
}
