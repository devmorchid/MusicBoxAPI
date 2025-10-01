<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
class AlbumsController extends Controller
{
    //
    /**
 * @OA\Get(
 *     path="/api/albums",
 *     summary="Get list of albums",
 *     tags={"Albums"},
 *     @OA\Response(
 *         response=200,
 *         description="List of albums"
 *     )
 * )
 */
public function index()
{
    return Album::all();
}

/**
 * @OA\Post(
 *     path="/api/albums",
 *     summary="Create new album",
 *     tags={"Albums"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "artist_id"},
 *             @OA\Property(property="title", type="string", example="Thriller"),
 *             @OA\Property(property="artist_id", type="integer", example=1)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Album created"
 *     )
 * )
 */
public function store(Request $request)
{
    $album = Album::create($request->all());
    return response()->json($album, 201);
}

/**
 * @OA\Get(
 *     path="/api/albums/{id}",
 *     summary="Get album by ID",
 *     tags={"Albums"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Album found"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Album not found"
 *     )
 * )
 */
public function show($id)
{
    return Album::findOrFail($id);
}

/**
 * @OA\Put(
 *     path="/api/albums/{id}",
 *     summary="Update album",
 *     tags={"Albums"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="title", type="string", example="Bad"),
 *             @OA\Property(property="artist_id", type="integer", example=1)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Album updated"
 *     )
 * )
 */
public function update(Request $request, $id)
{
    $album = Album::findOrFail($id);
    $album->update($request->all());
    return $album;
}

/**
 * @OA\Delete(
 *     path="/api/albums/{id}",
 *     summary="Delete album",
 *     tags={"Albums"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Album deleted"
 *     )
 * )
 */
public function destroy($id)
{
    Album::destroy($id);
    return response()->json(null, 204);
}

}
