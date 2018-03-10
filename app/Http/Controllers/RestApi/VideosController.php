<?php

namespace App\Http\Controllers\RestApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Video;

class VideosController extends Controller
{
    /**
     * Display a listing of the Videos.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/videos",
     *     description="Returns listing of videos.",
     *     produces={"application/json"},
     *     tags={"videos"},
     *     @SWG\Parameter(
     *         name="limit",
     *         type="integer",
     *         in="query",
     *         description="limit"
     *     ),
     *     @SWG\Parameter(
     *         name="offset",
     *         type="integer",
     *         in="query",
     *         description="offset"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Videos list."
     *     )
     * )
     */
    public function index(Request $request)
    {
      $limit = $request->get('limit', 10);
      $offset = $request->get('offset', 0);

      return Video::with('Owner')->skip($offset)->take($limit)->get();//->limit($limit)->offset($offset);
    }

    /**
     * Detail of the Video.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/videos/{id}",
     *     description="Returns detail of video.",
     *     produces={"application/json"},
     *     tags={"videos"},
     *     @SWG\Parameter(
     *         name="id",
     *         type="integer",
     *         in="path",
     *         description="Video id",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Get Detail of the Video.",
     *         @SWG\Schema(ref="#/definitions/Video")
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Video not found."
     *     )
     * )
     */
    public function details($id)
    {
      return Video::with('Owner')->findOrFail($id);
    }

    /**
     * Add new Video.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *     path="/videos",
     *     description="Add new video.",
     *     tags={"video"},
     *     @SWG\Parameter(
     *         name="video",
     *         in="body",
     *         description="Video to add to the store",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Video")
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="Video created successful",
     *         @SWG\Schema(ref="#/definitions/Video")
     *     )
     * )
     */
    public function add(Request $request)
    {
      $data = $request->all();
      $video = new Video($data);
      $video->save();

      return response()->json($video, 201);
    }

    public function update(Request $request, Video $video)
    {
        $video->update($request->all());

        return response()->json($video, 200);
    }

    /**
     * Delete Video.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Delete(
     *     path="/videos/{id}",
     *     description="Delete video.",
     *     tags={"video"},
     *     @SWG\Parameter(
     *         name="id",
     *         type="integer",
     *         in="path",
     *         description="Video id",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="Video deleted"
     *     )
     * )
     */
    public function delete(Video $video)
    {
        $video->delete();

        return response()->json(null, 204);
    }
}
