<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $guarded = ['id_product'];
    protected $casts = [
        'product_specification' => Json::class,
    ];
}
