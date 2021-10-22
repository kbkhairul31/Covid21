<?php

namespace App\Models;

use App\Scopes\ProductScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends User
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ProductScopes);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
