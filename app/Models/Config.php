<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model {
    protected $table = 'config';
    protected $primaryKey = 'id_config';
    protected $guarded = ['id_config'];
    protected $casts = [];
}
