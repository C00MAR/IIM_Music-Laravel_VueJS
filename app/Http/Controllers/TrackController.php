<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        Track::create([
            'uuid' => 'trk'.Str::uuid(),
            'title' => $this->faker->sentence(3),
            'artist' => $this->faker->name,
            'image' => '',
            'music' => '',
            'display' => true,
            'nb_stream' => 0,
        ]);

        return redirect()->route('tracks.index');
    }
}
