<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $append = ['gallery'];


    // public function Category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function getGalleryAttribute()
    {
        return $this->getMedia('gallery');
    }



}
