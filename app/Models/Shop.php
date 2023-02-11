<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shop extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $table = 'products';

    public function getGalleryAttribute()
    {
        return $this->getMedia('gallery');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }

}
