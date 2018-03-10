<?php

namespace App\Http\Controllers\RestApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Video;
use App\Models\Owner;

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
     *         name="token",
     *         type="string",
     *         in="query",
     *         description="auth token"
     *     ),
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

        return Video::with('Owner')->skip($offset)->take($limit)->get();
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
     *         name="token",
     *         type="string",
     *         in="query",
     *         description="auth token"
     *     ),
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
     * @SWG\Post(
     *     path="/videos",
     *     description="Add new video.",
     *     tags={"video"},
     *     @SWG\Parameter(
     *         name="token",
     *         type="string",
     *         in="query",
     *         description="auth token"
     *     ),
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $data = $request->all();
        $owner = Owner::where('api_token', $request->get('token'))->first();

        $video = new Video($data);

        $video->owner_id = $owner->id;
        // TODO replace to Enum state
        $video->status = 1;

        $video->save();

        return response()->json($video, 201);
    }

    /**
     * @SWG\Put(
     *     path="/videos/{id}",
     *     description="Update video.",
     *     tags={"video"},
     *     @SWG\Parameter(
     *         name="token",
     *         type="string",
     *         in="query",
     *         description="auth token"
     *     ),
     *     @SWG\Parameter(
     *         name="video",
     *         in="body",
     *         description="Video to add to the store",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Video")
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="Video updated"
     *     )
     * )
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Video $video)
    {
        if (!$this->checkRightsOwnerVideo($request, $video)) {
            return response()->json('Forbiden.', 403);
        }

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
     *         name="token",
     *         type="string",
     *         in="query",
     *         description="auth token"
     *     ),
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
     *     ),
     *     @SWG\Response(
     *         response=403,
     *         description="Forbiden"
     *     )
     * )
     */
    public function delete(Request $request, Video $video)
    {
        if (!$this->checkRightsOwnerVideo($request, $video)) {
            return response()->json('Forbiden.', 403);
        }

        $video->delete();

        return response()->json(null, 204);
    }

    /**
     *
     * @param Request $request
     * @param Video $video
     * @return boolean
     */
    protected function checkRightsOwnerVideo(Request $request, Video $video)
    {
        $token = $request->get('token');
        $owner = Owner::where('api_token', $token)->first();

        return ($owner->id == $video->owner_id);
    }
}
