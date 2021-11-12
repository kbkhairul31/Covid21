<?php

namespace App\Models;

use App\Scopes\BuyerScopes;
use App\Transformers\BuyerTransformer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends User
{
    use SoftDeletes;
    public $transformer = BuyerTransformer::class;

    protected $dates = ['deleted_at'];
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new BuyerScopes);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


 }
