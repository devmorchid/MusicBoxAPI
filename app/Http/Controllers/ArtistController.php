<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
   /**
 * @OA\Get(
 *     path="/api/artists",
 *     summary="Get list of artists",
 *     tags={"Artists"},
 *     @OA\Response(
 *         response=200,
 *         description="List of artists"
 *     )
 * )
 */

   /**
 * @OA\Get(
 *     path="/api/artists",
 *     summary="Get list of artists",
 *     tags={"Artists"},
 *     @OA\Parameter(
 *         name="genre",
 *         in="query",
 *         description="Filter by genre",
 *         required=false,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     )
 * )
 */
public function index()
{
    return Artist::all();
}

/**
 * @OA\Post(
 *     path="/api/artists",
 *     summary="Create new artist",
 *     tags={"Artists"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name"},
 *             @OA\Property(property="name", type="string", example="Michael Jackson")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Artist created"
 *     )
 * )
 */
public function store(Request $request)
{
    $artist = Artist::create($request->all());
    return response()->json($artist, 201);
}

/**
 * @OA\Get(
 *     path="/api/artists/{id}",
 *     summary="Get artist by ID",
 *     tags={"Artists"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Artist found"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Artist not found"
 *     )
 * )
 */
public function show($id)
{
    return Artist::findOrFail($id);
}

/**
 * @OA\Put(
 *     path="/api/artists/{id}",
 *     summary="Update artist",
 *     tags={"Artists"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="New Artist Name")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Artist updated"
 *     )
 * )
 */
public function update(Request $request, $id)
{
    $artist = Artist::findOrFail($id);
    $artist->update($request->all());
    return $artist;
}

/**
 * @OA\Delete(
 *     path="/api/artists/{id}",
 *     summary="Delete artist",
 *     tags={"Artists"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Artist deleted"
 *     )
 * )
 */
public function destroy($id)
{
    Artist::destroy($id);
    return response()->json(null, 204);
}

}
