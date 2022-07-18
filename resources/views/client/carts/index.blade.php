@extends('client.layouts.app')
@section('content')
@section('title','Carts')
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Sale</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                   
                    @foreach ($carts->products as $item)
                    <tr>
                        <td class="align-middle"><img src="{{$item->product->image_path}}" alt="" style="width: 50px;">{{$item->product->name}}t</td>
                        <td class="align-middle" >
                            <p style="{{ $item->product->sale ? 'text-decoration: line-through':"" }};"> ${{ $item->product->price }}

                            </p>
                            @if($item->product->sale)
                                
                            <p>${{ $item->product->sale_price }}</p>
                            @endif
                        </td>
                        <td class="align-middle">{{ $item->product_size }}</td>
                        <td class="align-middle">{{ $item->product->sale }}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <form action="{{url("cart?product_id=$item->id&decrease=1")}}" method="post">
                                
                                    <div class="input-group-btn">
                                        <input type="hidden" name="product_id" value="{{ $item->id }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button href="" class="btn btn-sm btn-primary btn-minus btn-update-quantity">
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </form>
                                <input type="text" class="form-control form-control-sm bg-secondary text-center" value="{{ $item->product_quantity }}" name="productQuantityInput">
                                <div class="input-group-btn">
                                    <a href="{{url("cart?product_id=$item->id&increment=1")}}" class="btn btn-sm btn-primary btn-plus btn-update-quantity">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            {{ $item->product->sale ? $item->product->sale_price * $item->product_quantity : $item->product->price * $item->product_quantity }}
                        </td>
                        <td class="align-middle"><button class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">$150</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">$160</h5>
                    </div>
                    <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const TIME_TO_UPDATE =1000;
    $(function(){
        $(document).on('click','.btn-update-quantity',_.debounce(function(e){
            let url=$(this).data('action')
            let id=$(this).data('id')
            let data={
                product_quanity: $(`#productQuantityInput-${id}`).val()
            }
            $.post(url,data,res =>{
                let cartProductId=res.product_cart_id;
                if(res.remove_product){
                    $(`#row-${cartProductId}`).remove();
                }
            })
        },TIME_TO_UPDATE))
    })
</script>
@endsection