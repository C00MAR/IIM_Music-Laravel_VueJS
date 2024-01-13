<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Models\ApiKey;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();
        
        if ($user->is_admin) {
            $playlists = Playlist::withCount('tracks')->get();
        } else {
            $playlists = $user->playlists()->withCount('tracks')->get();
        }

        return Inertia::render('Playlists/Index', [
            'playlists' => $playlists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tracks = Track::where('display', true)->orderBy('title')->get();

        return Inertia::render('Playlists/Create', [
            'tracks' => $tracks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=> ['string','required','max:255'],
            'tracks'=> ['array','required'],
            'image'=> ['image','required'],
            'tracks.*'=> ['string', 'required'],
        ]);

        $tracks = Track::whereIn('uuid', $request->tracks)->where('display', true)->get();
        if ($tracks->count() !== count($request->tracks)) {
            throw ValidationException::withMessages([
                'tracks' => 'One or more tracks are invalid.',
            ]);
        }

        $uuid = Str::uuid();

        $extensionImage = $request->image->extension();
        $imagePath = $request->image->storeAs('playlists/images', $uuid . '.' . $extensionImage);

        Playlist::create([
            'uuid'=> 'pl-' . $uuid,
            'user_id'=> $request->user()->id,
            'title'=> $request->title,
            'image'=> $imagePath,
        ])->tracks()->attach($tracks->pluck('id'));

        return redirect()->route('playlists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        return Inertia::render('Playlists/Show', [
            'playlist' => $playlist->load('tracks'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        return Inertia::render('Playlists/Edit', [
            'playlist' => $playlist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        $request->validate([
            'title'=> ['string','required','max:255'],
            'image'=> ['image','required'],
            'tracks'=> ['array','required'],
        ]);

        $tracks = Track::whereIn('uuid', $request->tracks)->where('display', true)->get();
        $playlist->title = $request->title;

        if ($tracks->count() !== count($request->tracks)) {
            throw ValidationException::withMessages([
                'tracks' => 'One or more tracks are invalid.',
            ]);
        }

        if ($request->hasFile('image')) {
            $extensionImage = $request->image->extension();
            $imagePath = $request->image->storeAs('playlists/images', $playlist->uuid . '.' . $extensionImage);
            $playlist->image = $imagePath;
        }

        $playlist->save();

        return redirect()->route('playlists.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        $playlist->tracks()->detach();
        $playlist->delete();

        return redirect()->route('playlists.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function apikey(Request $request)
    {
        $apiKey = $request->all();
        $user = ApiKey::where('key', $apiKey)->first();
        $data = Playlist::where('user_id', $user->user_id)->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
