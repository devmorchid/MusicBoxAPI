<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index(Request $request)
    {
        $query = Artist::query();

        // Filtre genre
        if ($request->has('genre')) {
            $query->where('genre', $request->genre);
        }

        return response()->json($query->paginate(10));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'genre' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $artist = Artist::create($data);
        return response()->json($artist, 201);
    }

    public function show(Artist $artist)
    {
        return response()->json($artist->load('albums'));
    }

    public function update(Request $request, Artist $artist)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'genre' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $artist->update($data);
        return response()->json($artist);
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();
        return response()->json(null, 204);
    }
}
