<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product , User $buyer)
    {

        $rules = [
         'quantity' => 'required|integer|min:1'
        ];
        if($buyer->id == $product->seller_id){
            return $this->errorResponser('The buyer must be diffrent from the seller', 409);
        }
        if(!$buyer->isVerified()){
            return $this->errorResponser('The buyer must be a verified user', 409);
        }

        if(!$product->seller->isVerified()){
            return $this->errorResponser('The seller must be a verified user', 409);
        }


        if($product->isAvailable()){
            return $this->errorResponser('The product is not available', 409);
        }

        if($product->quantity < $request->quantity){
            return $this->errorResponser('The product does not have enough units for this transaction', 409);
        }

        return DB::transaction(function() use ($request, $product, $buyer){
            $product->quatity -= $request->quantity;
            $product->save();


            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);

            return $this->showOne($transaction, 201);
        });
    }

}
