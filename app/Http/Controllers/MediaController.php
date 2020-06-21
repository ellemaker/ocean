<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MediaFile;
use App\MediaFolder;

class MediaController extends Controller
{
    public function index(){

    	return view('backend.media.index');

	}

	public function contents($id = 1){

		$files = MediaFile::where('file_category_id', $id)->get();

		$folderCurrent = $this->flatten(MediaFolder::where('id', $id)->with('childrenRecursive')->get()->toArray());


		$directories = [
			'folderLists' => MediaFolder::where('parent', $id)->get(),
			'folderCurrent' => $folderCurrent,
			'folderFiles' => $files			
		];

		$directories = json_encode($directories);

		return $directories;
	}


	public function media_destroy_files(Request $request){
		
		$file_lists = json_decode($request->input('files'), true);

		foreach ($file_lists as $file) {
			$query = MediaFile::find($file['id']);
			$query->delete();
		}

		return response()->json(['success' => true]);
	}

	protected function flatten($array) {
	    $result = [];
	    foreach ($array as $item) {
	        if (is_array($item)) {
	            $result[] = array_filter($item, function($array) {
	                return ! is_array($array);
	            });
	            $result = array_merge($result, $this->flatten($item));
	        } 
	    }
	    return array_filter($result);
	}


}
