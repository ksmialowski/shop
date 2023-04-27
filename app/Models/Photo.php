<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Photo extends Model {
    protected $table = 'photos';
    protected $primaryKey = 'id_photo';
    protected $guarded = ['id_photo'];
    protected $casts = [];
}
