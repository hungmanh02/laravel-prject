<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
    ];
    public function products(){
        return $this->hasMany(CartProduct::class,'cart_id');
    }
    // lấy ra cart của user id
    public function getBy($userId){
        return Cart::whereUserId($userId)->first();
    }
    // user id có cart rồi thì return cart chưa có thì thêm mới user id cart
    public function firtOrCreateBy($userId){
        $cart=$this->getBy($userId);
        if(!$cart){
            $cart=Cart::create(['user_id'=>$userId]);
        }
        return $cart;
    }

}
