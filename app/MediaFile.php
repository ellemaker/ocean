<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class MediaFile extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
             ->width(150)
             ->height(150)
             ->keepOriginalImageFormat();


        $this->addMediaConversion('medium')
             ->width(300)
             ->height(300)
             ->keepOriginalImageFormat();

        $this->addMediaConversion('medium_large')
             ->width(768)
             ->keepOriginalImageFormat();

        $this->addMediaConversion('large')
             ->width(1024)
             ->keepOriginalImageFormat();
    }


    protected $appends = ['original','thumbnail','medium','medium_large','large'];

    public function getOriginalAttribute()
    {
        if ($this->media->isEmpty()) {
            return 'default.jpg';
        } else {
            return $this->media->first()->getUrl();
        }  
    }

    public function getThumbnailAttribute()
    {
        //Check if media has collection and return default.jpg if false
        if ($this->media->isEmpty()) {
            return 'default.jpg';
        } else {
            return $this->media->first()->getUrl('thumbnail');
        }  
    }

    public function getMediumAttribute(){
        //Check if media has collection and return default.jpg if false
        if ($this->media->isEmpty()) {
            return 'default.jpg';
        } else {
            return $this->media->first()->getUrl('medium');
        }
    }

    public function getMediumLargeAttribute(){
        if ($this->media->isEmpty()) {
            return 'default.jpg';
        } else {
            return $this->media->first()->getUrl('medium_large');
        }
    }

    public function getLargeAttribute(){
        //Check if media has collection and return default.jpg if false
        if ($this->media->isEmpty()) {
            return 'default.jpg';
        } else {
            return $this->media->first()->getUrl('large');
        }
    }
}
