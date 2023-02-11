<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model implements HasMedia
{
    use HasFactory, Sluggable, InteractsWithMedia;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $append = ['gallery'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }

    // public function Category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function getGalleryAttribute()
    {
        return $this->getMedia('gallery');
    }

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }

}
