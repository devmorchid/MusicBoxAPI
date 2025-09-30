<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $query = Album::with('artist');

        if ($request->has('year')) {
            $query->where('year', $request->year);
        }

        return response()->json($query->paginate(10));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'nullable|integer',
            'artist_id' => 'required|exists:artists,id',
        ]);

        $album = Album::create($data);
        return response()->json($album, 201);
    }

    public function show(Album $album)
    {
        return response()->json($album->load('songs'));
    }

    public function update(Request $request, Album $album)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'year' => 'nullable|integer',
            'artist_id' => 'sometimes|exists:artists,id',
        ]);

        $album->update($data);
        return response()->json($album);
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return response()->json(null, 204);
    }
}
