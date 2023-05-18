<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Photo extends Model {
    protected $table = 'photos';
    protected $primaryKey = 'id_photo';
    protected $guarded = ['id_photo'];
    protected $casts = [];

    public function products()
    {
        return $this->morphedByMany(
            Product::class,
            'photoable',
            'photoable',
            'photo_id',
            'photoable_id',
            'id_photo',
            'id_product',
        )->withTimestamps();
    }

    public function categories()
    {
        return $this->morphedByMany(
            Category::class,
            'photoable',
            'photoable',
            'photo_id',
            'photoable_id',
            'id_photo',
            'id_category',
        )->withTimestamps();
    }
}
