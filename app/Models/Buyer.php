<?php

namespace App\Models;

use App\Scopes\BuyerScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends User
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected static function boot(){
        parent::boot();

        static::addGlobalScope(new BuyerScopes);

    }

    public function transcations(){
        return $this->hasMany(Transaction::class);
    }

}
