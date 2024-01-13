<?php

namespace App\Http\Controllers;

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apiKeys = ApiKey::all();

        return Inertia::render('ApiKeys/Index', [
            'apiKeys' => $apiKeys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('ApiKeys/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> ['string','required','max:255'],
        ]);

        $uuid = Str::uuid();

        ApiKey::create([
            'uuid'=> 'api-' . $uuid,
            'user_id'=> $request->user()->id,
            'name'=> $request->name,
            'key'=> Str::uuid(),
        ]);

        return redirect()->route('apikeys.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ApiKey $apikey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ApiKey $apikey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ApiKey $apikey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApiKey $apikey)
    {
        $apikey->delete();

        return redirect()->route('apikeys.index');
    }
}
