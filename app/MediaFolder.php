<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\MediaFile;

class MediaFolder extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'color', 'parent'];

   	public function files(){
    	return $this->hasMany(File::class);
    }

    public function parent()
    {
        return $this->belongsTo('App\MediaFolder' , 'parent');
    }

    public function children()
    {
        return $this->hasMany('App\MediaFile' , 'file_category_id');
    }

   	public function childrenRecursive()
	{
	   return $this->parent()->with('childrenRecursive');
	}

}
