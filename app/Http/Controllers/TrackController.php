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
}