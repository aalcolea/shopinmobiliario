<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asesor extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table =  'asesores';
    protected $hidden = ['created_at', 'updated_at'];

}