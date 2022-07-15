<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    protected $product;
    protected $cartProduct;
    protected $coupon;
    protected $order;
    public function __construct(Cart $cart,Product $product,CartProduct $cartProduct,Coupon $coupon,Order $order)
    {
        $this->cart=$cart;
        $this->product=$product;
        $this->cartProduct=$cartProduct;
        $this->coupon=$coupon;
        $this->order=$order;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // lấy thông tin của cart
        $carts=$this->cart->firtOrCreateBy(auth()->user()->id)->load('products');
        return view('client.carts.index',['carts'=>$carts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if($request->product_size){
            $product=$this->product->findOrFail($request->product_id);
            $user_id=auth()->user()->id;
            // sự dụng hàm kiểm tra có user_id chưa , có sẽ lấy ra không có thì tạo mới
            $cart=$this->cart->firtOrCreateBy($user_id);
            $cartProduct=$this->cartProduct->getBy($cart->id,$product->id,$request->product_size);
            // dd($cartProduct);
            if($cartProduct){
                $quantity=$cartProduct->product_quantity;
                $cartProduct->update(['product_quantity'=>($quantity + $request->product_quantity)]);
            }else{
                $dataCreate['cart_id']=$cart->id;
                $dataCreate['product_id']=$request->product_id;
                $dataCreate['product_quantity']=$request->product_quantity ?? 1;
                $dataCreate['product_price']=$product->price;
                $dataCreate['product_size']=$request->product_size;
                $this->cartProduct->create($dataCreate);
            }
            return back()->with(['message'=>'Thêm thành công']);
        } else {
            return back()->with(['message'=>'Bạn chưa thêm size']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
