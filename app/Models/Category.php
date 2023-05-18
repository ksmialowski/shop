<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model {
    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    protected $guarded = ['id_category'];
    protected $casts = [];

    public function photo(): MorphToMany
    {
        return $this->morphToMany(
            Photo::class,
            'photoable',
            'photoable',
            'photoable_id',
            'photo_id',
            'id_category',
            'id_photo',
        )->withTimestamps();
    }

    public static function rules(): array
    {
        return [
            'category_name' => 'required',
        ];
    }
}
