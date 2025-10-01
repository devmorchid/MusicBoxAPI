<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
class SongsController extends Controller
{
    //
    /**
 * @OA\Get(
 *     path="/api/songs",
 *     summary="Get list of songs",
 *     tags={"Songs"},
 *     @OA\Response(
 *         response=200,
 *         description="List of songs"
 *     )
 * )
 */
public function index()
{
    return Song::all();
}

/**
 * @OA\Post(
 *     path="/api/songs",
 *     summary="Create new song",
 *     tags={"Songs"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "album_id"},
 *             @OA\Property(property="title", type="string", example="Billie Jean"),
 *             @OA\Property(property="album_id", type="integer", example=1),
 *             @OA\Property(property="duration", type="string", example="4:15")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Song created"
 *     )
 * )
 */
public function store(Request $request)
{
    $song = Song::create($request->all());
    return response()->json($song, 201);
}

/**
 * @OA\Get(
 *     path="/api/songs/{id}",
 *     summary="Get song by ID",
 *     tags={"Songs"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Song found"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Song not found"
 *     )
 * )
 */
public function show($id)
{
    return Song::findOrFail($id);
}

/**
 * @OA\Put(
 *     path="/api/songs/{id}",
 *     summary="Update song",
 *     tags={"Songs"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Beat It"),
 *             @OA\Property(property="album_id", type="integer", example=1),
 *             @OA\Property(property="duration", type="string", example="3:59")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Song updated"
 *     )
 * )
 */
public function update(Request $request, $id)
{
    $song = Song::findOrFail($id);
    $song->update($request->all());
    return $song;
}

/**
 * @OA\Delete(
 *     path="/api/songs/{id}",
 *     summary="Delete song",
 *     tags={"Songs"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Song deleted"
 *     )
 * )
 */
public function destroy($id)
{
    Song::destroy($id);
    return response()->json(null, 204);
}

}
