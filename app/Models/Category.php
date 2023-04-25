<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $table = 'category';
    protected $primaryKey = 'id_category';
    protected $guarded = ['id_category'];
    protected $casts = [];

    public static function rules(): array
    {
        return [
            'category_name' => 'required',
        ];
    }
}
