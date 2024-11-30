<?php

namespace App\Http\Controllers;

use App\Models\Comnet;
use App\Models\Post;
use Illuminate\Http\Request;

class ComnetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Post $post)
    {
        $data = $request->validate([
            'body' => 'required'
        ]);
        $post->comnet()->create([
            'body' => $request['body'],
            'user_id' =>  auth()->id()
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comnet $comnet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comnet $comnet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comnet $comnet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comnet $comnet)
    {
        //
    }
}
