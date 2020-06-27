<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;

use App\MediaFolder;
use Illuminate\Http\Request;
use App\Http\Requests\Media\FolderStoreRequest;
use App\Http\Requests\Media\FolderUpdateRequest;

class MediaFolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FolderStoreRequest $request)
    {

        $validated = $request->validated();

        $folder = MediaFolder::create([
            'name' => $request->name,
            'slug' => Str::random(6),
            'parent' => $request->parent
        ]);
 
        return response()->json(['success' => true, 'folder' => $folder]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MediaFolder  $mediaFolder
     * @return \Illuminate\Http\Response
     */
    public function show(MediaFolder $mediaFolder)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MediaFolder  $mediaFolder
     * @return \Illuminate\Http\Response
     */
    public function edit(MediaFolder $mediaFolder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MediaFolder  $mediaFolder
     * @return \Illuminate\Http\Response
     */
    public function update(FolderUpdateRequest $request, MediaFolder $mediaFolder)
    {

        $mediaFolder->name = $request->name;
        $mediaFolder->save();

        return response()->json(['success' => true, 'folder' => $mediaFolder]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MediaFolder  $mediaFolder
     * @return \Illuminate\Http\Response
     */
    public function destroy(MediaFolder $mediaFolder)
    {
        $mediaFolder->delete();

        return response()->json(['success' => true, 'folder' => $mediaFolder]);
    }
}
