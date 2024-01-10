<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::all();

        return Inertia::render('Tracks/Index', [
            'tracks' => $tracks,
    ]);
    }

    public function create()
    {
        return Inertia::render('Tracks/Create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=> ['string','required','max:255'],
            'artist'=> ['string','required','max:255'],
            'display'=> ['boolean','required'],
            'image'=> ['image','required'],
            'music'=> ['file','required','extensions:mp3,wav'],
        ]);

        $uuid = Str::uuid();

        $extensionImage = $request->image->extension();
        $imagePath = $request->image->storeAs('tracks/images', $uuid . '.' . $extensionImage);

        $extensionMusic = $request->music->extension();
        $musicPath = $request->music->storeAs('tracks/musics', $uuid . '.' . $extensionMusic);

        Track::create([
            'uuid'=> 'trk-' . $uuid,
            'title'=> $request->title,
            'artist'=> $request->artist,
            'display'=> $request->display,
            'image'=> $imagePath,
            'music'=> $musicPath,
        ]);

        return redirect()->route('tracks.index');
    }

    public function edit(Track $track)
    {
        return Inertia::render('Tracks/Edit', [
            'track' => $track,
        ]);
    }

    public function update(Request $request, Track $track)
    {
        $request->validate([
            'title'=> ['string','required','max:255'],
            'artist'=> ['string','required','max:255'],
            'display'=> ['boolean','required'],
        ]);

        $track->title = $request->title;
        $track->artist = $request->artist;
        $track->display = $request->display;
        $track->save();

        return redirect()->route('tracks.index');
    }

    public function destroy(Track $track)
    {
        $track->delete();

        return redirect()->route('tracks.index');
    }
}
