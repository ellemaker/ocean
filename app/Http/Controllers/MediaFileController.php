<?php

namespace App\Http\Controllers;

use App\MediaFile;
use Illuminate\Http\Request;

class MediaFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function store(Request $request)
    {
        if ($request->has('file')) {

            $filenameWithExt = $request->file->getClientOriginalName();

            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename_ext = pathinfo($filenameWithExt, PATHINFO_EXTENSION);

            $checkingFile = MediaFile::where(['name' => $filename , 'file_category_id' => $request->category])->count();

            $newName = $filename.'-'.( $checkingFile + 1 );

            $filename = $checkingFile ? $newName : $filename;

            $file = new MediaFile;
            $file->name = $filename;
            $file->alt = $filename;
            $file->title = $filename;
            $file->extension = $filename_ext;
            $file->file_category_id = $request->category;
            $file->save();

            $file->addMedia($request->file)->preservingOriginal()->toMediaCollection($request->collection);

            return response()->json(['success'=>true]);
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MediaFile  $mediaFile
     * @return \Illuminate\Http\Response
     */
    public function show(MediaFile $mediaFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MediaFile  $mediaFile
     * @return \Illuminate\Http\Response
     */
    public function edit(MediaFile $mediaFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MediaFile  $mediaFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MediaFile $mediaFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MediaFile  $mediaFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(MediaFile $mediaFile)
    {
        //
    }
}
