<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Product extends Model {
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $guarded = ['id_product'];
    protected $casts = [
        'product_specification' => Json::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }

    public function photo(): MorphToMany
    {
        return $this->morphToMany(
            Photo::class,
            'photoable',
            'photoable',
            'photoable_id',
            'photo_id',
            'id_product',
            'id_photo',
        )->withTimestamps();
    }

    public static function rules()
    {
        return [
            'product_name' => 'required|string',
            'id_category' => 'required|integer',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|integer',
            'product_type' => 'required|string',
        ];
    }
}
