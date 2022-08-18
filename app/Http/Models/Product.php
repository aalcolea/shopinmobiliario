<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deteled_at'];
    protected $table = 'products';
    
    protected $hidden = ['created_at', 'updated_at'];

    public function cat(){
        return $this->hasOne(Category::class, 'id', 'category_id'); //relacionar base de datos categoria con base de datos products
    }
    public function ase(){
        return $this->hasOne(Asesor::class, 'id', 'asesor_id');
    }
    public function aseDel(){
        return $this->hasOne(Asesor::withTrashed()->get());
    }
    public function getGallery(){ //retornar muchos objetos a uno solo
        return $this->hasMany(PGallery::class,'product_id', 'id');
    }
}
