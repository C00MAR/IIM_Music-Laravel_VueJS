<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Playlists/Index');
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

        $extensionImage = $request->image->extension();
        $imagePath = $request->image->storeAs('playlists/images', $uuid . '.' . $extensionImage);

        Playlist::create([
            'uuid'=> 'pl-' . Str::uuid(),
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        //
    }
}
