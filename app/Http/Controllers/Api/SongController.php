<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index(Request $request)
    {
        $query = Song::with('album.artist');

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        return response()->json($query->paginate(10));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'nullable|integer',
            'album_id' => 'required|exists:albums,id',
        ]);

        $song = Song::create($data);
        return response()->json($song, 201);
    }

    public function show(Song $song)
    {
        return response()->json($song->load('album.artist'));
    }

    public function update(Request $request, Song $song)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'duration' => 'nullable|integer',
            'album_id' => 'sometimes|exists:albums,id',
        ]);

        $song->update($data);
        return response()->json($song);
    }

    public function destroy(Song $song)
    {
        $song->delete();
        return response()->json(null, 204);
    }
}
